<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'Tbl_DetalleFactura';
    protected $fillable =['subTotal','cantidad','Producto_id','Factura_id'];

    public function producto(){
        return $this->belongsTo('Eco\Datos\Modelos\Producto','Producto_id','id');
    }
}
