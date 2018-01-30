<?php
/**
 * Created by PhpStorm.
 * User: Diego Flórez
 * Date: 24/01/2018
 * Time: 9:28 PM
 */

namespace Eco\Negocio\Logica;


use Eco\Datos\Repositorio\DepartamentoRepositorio;

class DepartamentoServicio
{
    protected $departamentoRepo;
    public function __construct(DepartamentoRepositorio $departamentoRepo)
    {
        $this->departamentoRepo = $departamentoRepo;
    }

    public function obtenerDepartamento()
    {

        return $this->departamentoRepo->obtenerDepartamentos();
    }
}