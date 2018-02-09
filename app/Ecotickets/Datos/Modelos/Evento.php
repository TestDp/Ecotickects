<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;


class Evento extends Model
{
    protected $table = 'Tbl_Eventos';
    protected $fillable =['Nombre_Evento','Lugar_Evento','Fecha_Evento','Fecha_Inicial_Registro','Fecha_Final_Registro','Tipo_Evento','user_id','Ciudad_id','FlyerEvento','numeroAsistentes','SolicitarPIN','CorreoEnviarInvitacion','EsPublico','informacionEvento'];

    public function user(){
        return $this->belongsTo('User');
    }

    public function ciudad(){
        return $this->belongsTo('Eco\Datos\Modelos\Ciudad');
    }

    public function preguntas(){
        return $this->hasMany('Eco\Datos\Modelos\Pregunta','Evento_id','id');
    }

    public function asistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','Evento_id','id');
    }
}
