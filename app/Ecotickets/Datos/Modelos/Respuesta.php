<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Pregunta;

class Respuesta extends Model
{
    protected $table = 'Tbl_Respuestas';
    protected $fillable =['EnunciadoRespuesta','Pregunta_id'];

    public function pregunta(){
        return $this->belongsTo('Pregunta');
    }

    public function respuestasAsistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','Respuesta_id','id');
    }
}
