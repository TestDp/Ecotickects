<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class RespuestaCampoPersonalizado extends Model
{
    protected $table = 'tbl_respuestas_campos_personalizados';
    protected $fillable = ['CampoPersonalizado_id', 'AsistenteXEvento_id', 'valor'];

    public function campoPersonalizado()
    {
        return $this->belongsTo('Eco\Datos\Modelos\CampoPersonalizado', 'CampoPersonalizado_id', 'id');
    }

    public function asistenteXEvento()
    {
        return $this->belongsTo('Eco\Datos\Modelos\AsistenteXEvento', 'AsistenteXEvento_id', 'id');
    }
}
