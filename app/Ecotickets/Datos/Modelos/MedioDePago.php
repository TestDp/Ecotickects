<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class MedioDePago extends Model
{
    protected $table = 'Tbl_MediosDePago';
    protected $fillable =['Codigo','Nombre','Descripcion'];

    public function InformacionDePagos(){
        return $this->hasMany('InfoPago','InfoPago_id','id');
    }
}
