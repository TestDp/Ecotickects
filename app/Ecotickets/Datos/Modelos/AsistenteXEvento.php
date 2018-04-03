<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Eco\Datos\Modelos\Asistente;

class AsistenteXEvento extends Model
{
    protected $table = 'tbl_asistentesXeventos';
    protected $fillable =['ComentarioEvento','Asistente_id','Evento_id','terminos','HabeasData','esActivo','esPerfilado','esPago','PinBoleta','idAsistenteCompra'];

    public function evento(){
        return $this->belongsTo('Evento');
    }

    public function asistente(){
        return $this->belongsTo('Eco\Datos\Modelos\Asistente');
    }

    public function respuestasAsistentesXEventos(){
        return $this->hasMany('AsistenteXEvento','AsistenteXEvento_id','id');
    }

    public function InformacionDePagos(){
        return $this->hasMany('InfoPago','InfoPago_id','id');
    }
}
