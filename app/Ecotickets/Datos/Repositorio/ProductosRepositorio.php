<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 16/05/2018
 * Time: 1:06 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Producto;
use Eco\Datos\Modelos\ProductosXevento;
use Illuminate\Support\Facades\DB;
class ProductosRepositorio
{

    public function crearProducto($EdProducto)
    {
        DB::beginTransaction();
        try{
            $producto = new Producto($EdProducto->all());
            if($EdProducto->Imagen_Producto != null){
                $producto->Imagen_Producto  = 'imagenProducto_'.$EdProducto->Nombre_Producto.'.jpg';
            }
            $producto->save();
            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public  function  ObtenerMisProductos($idUsuario)
    {
        $Productos = Producto::where('user_id','=',$idUsuario)->get();
        return $Productos;
    }

    public function ObtenerProducto($idProducto)
    {
        $Producto = Producto::where('id','=',$idProducto)->get()->first();
        return $Producto;
    }

    public  function  agregarProductoXEventos($idProducto,$idEvento)
    {
        DB::beginTransaction();
        try{
            $productoxevento= new ProductosXevento();
            $productoxevento->Producto_id = $idProducto;
            $productoxevento->Evento_id = $idEvento;
            $productoxevento->save();

            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public  function  eliminarProductoXEventos($idProducto,$idEvento)
    {
        DB::beginTransaction();
        try{
            $productoxevento = ProductosXevento::where('Producto_id','=',$idProducto)->where('Evento_id','=',$idEvento)->get()->first();
            $productoxevento->delete();
            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public function ObtenerProductosXeventos($idProducto)
    {
        $arrayeventos = array();
        $productosxeventos = ProductosXevento::where('Producto_id','=',$idProducto)->get();
        foreach ($productosxeventos as $productoXEvento) {
            $evento = Evento::where('id','=', $productoXEvento->Evento_id)->first();
            $arrayeventos[] = $evento;
        }
        return $arrayeventos;//Lista de Eventos que que tiene productos por evento
    }

}