<?php

namespace Ecotickets\Http\Controllers\Recurso;

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
    public function obtenerCiudadesWS($idDepartamento)
    {
        $ciudades = $this->ciudadServicio->obtenerCiudades($idDepartamento);
        $ciudadesArray=['ciudades'=>$ciudades];
        return response()->json($ciudadesArray);
    }

    public function obtenerListaCiudades(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $ciudades = $this->ciudadServicio->obtenerListaCiudades();
        return view('Recurso/ListaCiudades',['listaCiudades' =>$ciudades]);
    }

}
