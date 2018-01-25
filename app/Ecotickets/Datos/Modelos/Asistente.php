<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    protected $table = 'tbl_asistentes';
    protected $fillable =['Nombres','Apellidos','Identificacion','telefono','Email','Edad','Dirección','Ciudad_id'];

    public function ciudad(){
        return $this->belongsTo('Ciudad');
    }

    public function asistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','Evento_id','id');
    }

}
