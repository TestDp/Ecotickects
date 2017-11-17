<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'Tbl_Departamentos';

    public function ciudades(){
        return $this->hasMany('Ciudad');
    }
}
