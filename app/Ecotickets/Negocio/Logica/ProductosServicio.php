<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 16/05/2018
 * Time: 1:05 PM
 */

namespace Eco\Negocio\Logica;


use Eco\Datos\Repositorio\EventosRepositorio;
use Eco\Datos\Repositorio\ProductosRepositorio;

class ProductosServicio
{

    protected $productosRepor;
    protected $eventoRepor;
    public function __construct(ProductosRepositorio $productosRepor,EventosRepositorio $eventoRepor)
    {
        $this->productosRepor = $productosRepor;
        $this->eventoRepor = $eventoRepor;
    }

    public function crearProducto($EdProducto)
    {
        return $this->productosRepor->crearProducto($EdProducto);
    }

    public  function  ObtenerMisProductos($idUsuario)
    {
        return $this->productosRepor->ObtenerMisProductos($idUsuario);
    }

    public function ObtenerProducto($idProducto)
    {
        return $this->productosRepor->ObtenerProducto($idProducto);
    }

    public  function  agregarProductoXEventos($idProducto,$idEvento)
    {
        return $this->productosRepor->agregarProductoXEventos($idProducto,$idEvento);
    }

    public  function  eliminarProductoXEventos($idProducto,$idEvento)
    {
        return $this->productosRepor->eliminarProductoXEventos($idProducto,$idEvento);
    }

    public function ObtenerProductosXeventos($idProducto)
    {
        return $this->productosRepor->ObtenerProductosXeventos($idProducto);
    }

    public  function ObtenerListaDesplegable($idProducto,$idUsuario)
    {
        $arrayEventosLista = array();
        $eventosProductos = $this->productosRepor->ObtenerProductosXeventos($idProducto);
        $eventosUsuario = $this->eventoRepor->ObtenerMisEventos($idUsuario);
        foreach ($eventosUsuario as $eventoUsuario)
        {
            $flag = 0;
            foreach ($eventosProductos as $eventoProducto)
            {
                if($eventoProducto->id == $eventoUsuario->id)
                    $flag = 1;
            }
            if($flag ==0)
                $arrayEventosLista[]=$eventoUsuario;
        }
        return $arrayEventosLista;
    }

    public function  obtenerProductosXEvento($idEvento)
    {
        return $this->productosRepor->obtenerProductosXEvento($idEvento);
    }
}