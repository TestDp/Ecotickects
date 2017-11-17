<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Evento;

class Pregunta extends Model
{
    protected $table = 'Tbl_Preguntas';
    protected $fillable =['Enunciado','Evento_id','TipoPregunta_id'];

    public function evento(){
        return $this->belongsTo('Evento');
    }

    public function tipoPregunta(){
        return $this->belongsTo('TipoPregunta');
    }

    public function respuestas(){
        return $this->hasMany('Respuesta');
    }
}
