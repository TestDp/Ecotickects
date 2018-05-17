<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 16/05/2018
 * Time: 1:05 PM
 */

namespace Eco\Negocio\Logica;


use Eco\Datos\Repositorio\ProductosRepositorio;

class ProductosServicio
{

    protected $productosRepor;
    public function __construct(ProductosRepositorio $productosRepor)
    {
        $this->productosRepor = $productosRepor;
    }

    public function crearProducto($EdProducto)
    {
        return $this->productosRepor->crearProducto($EdProducto);

    }

    public  function  ObtenerMisProductos($idUsuario)
    {
        return $this->productosRepor->ObtenerMisProductos($idUsuario);
    }

}