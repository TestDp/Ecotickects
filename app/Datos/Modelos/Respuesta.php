<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Evento;

class Respuesta extends Model
{
    protected $table = 'Tbl_Respuesta';
    protected $fillable =['Enunciado','Pregunta_id'];

    public function pregunta(){
        return $this->belongsTo('Pregunta');
    }
}
