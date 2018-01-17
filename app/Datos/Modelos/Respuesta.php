<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Pregunta;

class Respuesta extends Model
{
    protected $table = 'Tbl_Respuestas';
    protected $fillable =['EnunciadoRespuesta','Pregunta_id'];

    public function pregunta(){
        return $this->belongsTo('Pregunta');
    }
}
