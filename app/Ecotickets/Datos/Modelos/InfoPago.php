<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class InfoPago extends Model
{
    protected $table = 'Tbl_InfoPagos';
    protected $fillable =['NumeroFactura','CantidadBoletas','PrecioTotal','TotalIva','Ganancia','Fecha_Compra','AsistenteXEvento_id'];

    public function asistenteXevento(){
        return $this->belongsTo('AsistenteXEvento');
    }

    public function MedioDePago(){
        return $this->belongsTo('MedioDePago');
    }

    public function EstadoTransaccion(){
        return $this->belongsTo('EstadoTransaccion');
    }

}
