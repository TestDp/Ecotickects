<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class ProductosXevento extends Model
{
    protected $table = 'Tbl_ProductosXevento';
    protected $fillable =['Evento_id','Producto_id',];

    public function evento(){
        return $this->belongsTo('Evento');
    }

    public function producto(){
        return $this->belongsTo('Producto');
    }
}
