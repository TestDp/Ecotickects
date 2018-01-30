<?php
/**
 * Created by PhpStorm.
 * User: Diego Flórez
 * Date: 24/01/2018
 * Time: 9:29 PM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Repositorio\CiudadRepositorio;

class CiudadServicio
{
    protected $ciudadRepor;
    public function __construct(CiudadRepositorio $ciudadRepor)
    {
        $this->ciudadRepor = $ciudadRepor;
    }

    public function obtenerCiudades($idDepartamento)
    {

        return $this->ciudadRepor->obtenerCiudades($idDepartamento);
    }

}