<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'Tbl_Productos';
    protected $fillable =['Codigo','Nombre_Producto','precio','cantidad','Imagen_Producto','user_id'];

    public function user(){
        return $this->belongsTo('User');
    }

    public function prodcutosEventos(){
        return $this->hasMany('Eco\Datos\Modelos\ProductosXevento','Producto_id','id');
    }

}
