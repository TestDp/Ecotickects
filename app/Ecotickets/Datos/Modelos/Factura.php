<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'Tbl_Factura';
    protected $fillable =['PrecioTotal','TotalIva','CorreoComprador','Evento_id','Cancelada'];

    public function evento(){
        return $this->belongsTo('Evento');
    }

    public function productosDetalleFactura(){
        return $this->hasMany('Eco\Datos\Modelos\DetalleFactura','Factura_id','id');
    }

}
