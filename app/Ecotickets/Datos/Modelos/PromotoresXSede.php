<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Eco\Datos\Modelos\Asistente;

class PromotoresXSede extends Model
{
    protected $table = 'Tbl_PromotoresXSedes';
    protected $fillable =['Asistente_id','Sede_id', 'esActivo'];

    public function sede(){
        return $this->hasMany('Sede', 'Sede_id', 'id');
    }


    public function asistente(){
        return $this->hasMany('Asistente', 'Asistente_id', 'id');
    }
}
