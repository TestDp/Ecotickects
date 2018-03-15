<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class EstadoTransaccion extends Model
{
    protected $table = 'Tbl_EstadosTransaccion';
    protected $fillable =['Codigo','Nombre','Descripcion'];

    public function InformacionDePagos(){
        return $this->hasMany('InfoPago','InfoPago_id','id');
    }
}
