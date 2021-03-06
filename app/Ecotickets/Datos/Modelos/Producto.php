<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'Tbl_Productos';
    protected $fillable =['Codigo','Nombre_Producto','precio','cantidad','Imagen_Producto','user_id'];

    public function user(){
        return $this->belongsTo('Ecotickets\User','user_id');
    }

    public function prodcutosEventos(){
        return $this->hasMany('Eco\Datos\Modelos\ProductosXevento','Producto_id','id');
    }

    public function productosDetalleFactura(){
        return $this->hasMany('Eco\Datos\Modelos\DetalleFactura','Producto_id','id');
    }

}
