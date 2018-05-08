<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'Tbl_Departamentos';
    protected $fillable =['id','Codigo_Departamento','Nombre_Departamento'];
    public function ciudades(){
        return $this->hasMany('Ciudad');
    }
}
