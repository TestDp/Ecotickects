<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class AsistenteXEvento extends Model
{
    protected $table = 'tbl_asistentesXeventos';
    protected $fillable =['ComentarioEvento','Asistente_id','Evento_id'];

    public function evento(){
        return $this->belongsTo('Evento');
    }

    public function asistente(){
        return $this->belongsTo('Asistente');
    }

    public function respuestasAsistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','AsistenteXEvento_id','id');
    }
}
