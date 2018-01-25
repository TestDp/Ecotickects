<?php
/**
 * Created by PhpStorm.
 * User: Diego Flórez
 * Date: 24/01/2018
 * Time: 9:38 PM
 */

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\CiudadServicio;
use Ecotickets\Http\Controllers\Controller;

class CiudadController extends Controller
{
    protected $ciudadServicio;
    public function _construct(CiudadServicio $ciudadServicio)
    {
        $this->ciudadServicio =$ciudadServicio;
    }
    public function obtenerCiudades($idDepartamento)//este metodo se tiene que mover  de esta clase
    {
        $ciudades = $this->ciudadServicio->obtenerCiudades($idDepartamento);
        // $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        //  dd($ciudades);
        return response()->json($ciudades);
    }
}