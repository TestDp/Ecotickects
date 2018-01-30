<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 23/01/2018
 * Time: 2:34 PM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\Ciudad;


class CiudadRepositorio
{

    public function obtenerCiudades($idDepartamento)
    {
        $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        return $ciudades;
    }

}