<?php

namespace Ecotickets\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Ecotickets\Datos\Modelos\Evento;

class TipoPregunta extends Model
{
    protected $table = 'Tbl_Tipos_Preguntas';
    protected $fillable =['Enunciado'];

    public function preguntas(){
        return $this->hasMany('Pregunta');
    }
}
