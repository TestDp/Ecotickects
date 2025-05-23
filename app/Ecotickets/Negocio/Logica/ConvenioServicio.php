<?php

namespace Eco\Negocio\Logica;

use Eco\Datos\Repositorio\EventosRepositorio;
use GuzzleHttp\Client;
use Eco\Datos\Repositorio\ConveniosRepositorio;


class ConvenioServicio
{
    protected $convenioRepositorio;
    protected $client;
    protected $eventosRepositorio;

    public function __construct(ConveniosRepositorio $convenioRepositorio,EventosRepositorio $eventosRepositorio)
    {
        $this->convenioRepositorio = $convenioRepositorio;
        $this->eventosRepositorio = $eventosRepositorio;
        $this->client = new Client();
    }

    public function obtenerConveniosPorEvento($eventoId)
    {
        return $this->convenioRepositorio->obtenerConveniosPorEvento($eventoId);
    }

    /**
     * Obtener token de autenticación para el web service
     */
    private function obtenerToken($convenio)
    {
        try {
           $response = $this->client->post($convenio->URL . '/OAuthServer', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('services.comfenalco.client_id'),
                    'client_secret' => config('services.comfenalco.client_secret'),
                ],
               'timeout' => 10
            ]);
            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            \Log::error('Error al obtener token: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Consultar si un usuario está afiliado a la caja de compensación
     */
    public function consultarAfiliacion($identificacion, $convenio)
    {
        $token = $this->obtenerToken($convenio);
        if (!$token) {
            return [
                'error' => true,
                'mensaje' => 'No se pudo obtener el token de autenticación'
            ];
        }

        try {
            $response = $this->client->get($convenio->URL . '/wsAfiliadoExterno', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Calculator_Operation'=>'datosAfiliado',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'parametros' => [
                        'usuario' => [
                            'tipoDocumento'     => 'CC',
                            'nroDocumento'      => $identificacion,
                            'usuarioAplicativo' => 'POECOTICKETS',
                        ]
                    ]
                ]
            ]);
            $data = json_decode($response->getBody(), true);
            return json_decode(json_encode($data['usuario']));
        } catch (\Exception $e) {
            \Log::error('Error al consultar afiliación: ' . $e->getMessage());
            return [
                'error' => true,
                'mensaje' => 'Error al consultar la afiliación: ' . $e->getMessage()
            ];
        }
    }

    //Se generan los precios de las boletas de acuerdo a la tarifa
    public function generarPreciosBoletasDesc($datosAfiliado,$idEvento){
       //$preciosBoletas =  $this->eventosRepositorio->obtenerLocalidadesEventoOtroRol($idEvento);

       $preciosBoletasConvenio =  $this->eventosRepositorio->obtenerLocalidadesConvenio($idEvento,$datosAfiliado->datosBasicos->nomTarifa);
       //$preciosCombinados = $preciosBoletas->merge($preciosBoletasConvenio);
       return $preciosBoletasConvenio;
    }

    public function yaTieneCompraConvenio($idEvento,$cc){
        return count($this->convenioRepositorio->yaTieneCompraConvenio($idEvento,$cc));
    }
}