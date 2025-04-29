<?php

namespace Ecotickets\Http\Controllers\Convenio;

use Eco\Negocio\Logica\ConvenioServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;

class ConvenioController extends Controller
{
    protected $convenioServicio;
    protected $eventoServicio;

    public function __construct(ConvenioServicio $convenioServicio, EventosServicio $eventoServicio)
    {
        $this->convenioServicio = $convenioServicio;
        $this->eventoServicio = $eventoServicio;
    }

    public function verificarAfiliacion($idEvento, $identificacion)
    {
        $evento = $this->eventoServicio->obtenerEvento($idEvento);
        $convenios = $this->convenioServicio->obtenerConveniosPorEvento($idEvento);
        
        foreach ($convenios as $convenio) {
            $resultado = $this->convenioServicio->consultarAfiliacion($identificacion, $convenio->id);
            
            if (isset($resultado['esAfiliado']) && $resultado['esAfiliado']) {
                // Encontramos una afiliación, ahora vamos a buscar el código promocional
                if (isset($resultado['codigoPromocional']) && $resultado['codigoPromocional']) {
                    // Retorna el resultado incluyendo el código promocional
                    return response()->json([
                        'esAfiliado' => true,
                        'categoria' => $resultado['categoria'],
                        'codigoPromocional' => $resultado['codigoPromocional'],
                        'mensaje' => 'Beneficio aplicado automáticamente: ' . $resultado['categoria']
                    ]);
                }
            }
        }
        
        // Si llegamos aquí, no hay afiliación o códigos promocionales
        return response()->json([
            'esAfiliado' => false,
            'mensaje' => 'No se encontró afiliación para esta identificación'
        ]);
    }
}