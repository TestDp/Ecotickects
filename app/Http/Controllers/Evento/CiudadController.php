<?php

namespace Ecotickets\Http\Controllers;

use Illuminate\Http\Request;

class CiudadController extends Controller
{
    protected $ciudadServicio;
    public function _construct(CiudadServicio $ciudadServicio)
    {
        $this->ciudadServicio =$ciudadServicio;
    }
    public function obtenerCiudades($idDepartamento)
    {
        $ciudades = $this->ciudadServicio->obtenerCiudades($idDepartamento);
        return response()->json($ciudades);
    }
}
