<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'Tbl_Ciudades';

    public function eventos(){
        return $this->hasMany('Evento');
    }

    public function departamento(){
        return $this->belongsTo('Departamento');
    }
}