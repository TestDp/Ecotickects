<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class CampoPersonalizado extends Model
{
    protected $table = 'tbl_campos_personalizados';
    protected $fillable = ['Evento_id', 'etiqueta', 'opciones', 'esObligatorio', 'orden'];

    public function evento()
    {
        return $this->belongsTo('Eco\Datos\Modelos\Evento', 'Evento_id', 'id');
    }

    public function respuestas()
    {
        return $this->hasMany('Eco\Datos\Modelos\RespuestaCampoPersonalizado', 'CampoPersonalizado_id', 'id');
    }

    /**
     * Devuelve las opciones como array. Si no hay opciones, retorna vacío.
     */
    public function getOpcionesArray()
    {
        if (empty($this->opciones)) {
            return [];
        }
        return array_map('trim', explode(',', $this->opciones));
    }

    /**
     * Indica si el campo tiene opciones predefinidas (select) o es texto libre (input).
     */
    public function tieneOpciones()
    {
        return !empty($this->opciones);
    }
}
