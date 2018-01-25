<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 23/01/2018
 * Time: 2:34 PM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;

class CiudadRepositorio
{

    public function obtenerCiudades($idDepartamento)//este metodo se tiene que mover  de esta clase
    {
        $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        return $ciudades;
    }

    public function obtenerDepartamentos()//este metodo se tiene que mover  de esta clase
    {
        return Departamento::all();
    }
}