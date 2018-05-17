<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 16/05/2018
 * Time: 1:06 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Producto;
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
}