<?php

namespace Eco\Negocio\Logica;

use GuzzleHttp\Client;
use Eco\Datos\Repositorio\ConveniosRepositorio;

class ConvenioServicio
{
    protected $convenioRepositorio;
    protected $client;

    public function __construct(ConveniosRepositorio $convenioRepositorio)
    {
        $this->convenioRepositorio = $convenioRepositorio;
        $this->client = new Client();
    }

    /**
     * Obtener token de autenticación para el web service
     */
    public function obtenerToken($convenioId)
    {
        $convenio = $this->convenioRepositorio->obtenerConvenio($convenioId);
        
        try {
            $response = $this->client->post($convenio->URL . '/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $convenio->client_id,
                    'client_secret' => $convenio->client_secret,
                ]
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
    public function consultarAfiliacion($identificacion, $convenioId)
    {
        $token = $this->obtenerToken($convenioId);
        if (!$token) {
            return [
                'error' => true,
                'mensaje' => 'No se pudo obtener el token de autenticación'
            ];
        }
        
        $convenio = $this->convenioRepositorio->obtenerConvenio($convenioId);
        
        try {
            $response = $this->client->get($convenio->URL . '/afiliados/' . $identificacion, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            if (isset($data['esAfiliado']) && $data['esAfiliado']) {
                // Obtener código promocional basado en la categoría del afiliado
                $codigoPromocional = $this->obtenerCodigoPromocional($convenio->id, $data['categoria']);
                
                return [
                    'esAfiliado' => true,
                    'categoria' => $data['categoria'],
                    'codigoPromocional' => $codigoPromocional
                ];
            }
            
            return [
                'esAfiliado' => false
            ];
        } catch (\Exception $e) {
            \Log::error('Error al consultar afiliación: ' . $e->getMessage());
            return [
                'error' => true,
                'mensaje' => 'Error al consultar la afiliación: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Obtener código promocional basado en la categoría
     */
    private function obtenerCodigoPromocional($convenioId, $categoria)
    {
        return $this->convenioRepositorio->obtenerCodigoPromocional($convenioId, $categoria);
    }
}