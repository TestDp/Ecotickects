<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\CiudadServicio;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CiudadController extends Controller
{
    protected $ciudadServicio;

    public function __construct(CiudadServicio $ciudadServicio)
    {
        $this->ciudadServicio = $ciudadServicio;
    }
    public function obtenerCiudades($idDepartamento)
    {
       $ciudades = $this->ciudadServicio->obtenerCiudades($idDepartamento);
        return response()->json($ciudades);
    }

}
