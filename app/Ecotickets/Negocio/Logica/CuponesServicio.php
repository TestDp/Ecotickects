<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 8/05/2018
 * Time: 1:51 PM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Repositorio\CuponesRepositorio;


class CuponesServicio
{

    protected $cuponesRepor;
    public function __construct(CuponesRepositorio $cuponesRepor)
    {
        $this->cuponesRepor = $cuponesRepor;
    }

    public  function  ObtenerMisCupones($idUsuario)
    {
        return $this->cuponesRepor->ObtenerMisCupones($idUsuario);
    }
}