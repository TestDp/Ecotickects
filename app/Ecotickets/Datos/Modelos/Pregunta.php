<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;


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
        return $this->hasMany('Eco\Datos\Modelos\Respuesta','Pregunta_id','id');
    }
}
