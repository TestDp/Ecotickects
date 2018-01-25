<?php
/**
 * Created by PhpStorm.
 * User: Diego Flórez
 * Date: 24/01/2018
 * Time: 9:27 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Departamento;

class DepartamentoRepositorio
{
    public function obtenerDepartamentos()//este metodo se tiene que mover  de esta clase
    {
        return Departamento::all();
    }
}