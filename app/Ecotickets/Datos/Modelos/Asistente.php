<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Eco\Datos\Modelos\AsistenteXEvento;

class Asistente extends Model
{
    protected $table = 'tbl_asistentes';
    protected $fillable =['Nombres','Apellidos','Identificacion','telefono','Email','Edad','Dirección','Ciudad_id','fechaNacimiento'];

    public function ciudad(){
        return $this->belongsTo('Ciudad');
    }

    public function asistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','Asistente_id','id');
    }

}
