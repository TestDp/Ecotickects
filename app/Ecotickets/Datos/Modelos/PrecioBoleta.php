<?php

namespace Eco\Datos\Modelos;
use Illuminate\Database\Eloquent\Model;

class PrecioBoleta extends Model
{
    protected $table = 'Tbl_PreciosBoletas';
    protected $fillable =['localidad','Evento_id','precio','cantidad','esActiva','esCodigoPromo','Codigo','Porcentaje',
        'PrecioBoletaPadre_Id','esConvenio'];

    public function evento(){
        return $this->belongsTo('Evento');
    }

}
