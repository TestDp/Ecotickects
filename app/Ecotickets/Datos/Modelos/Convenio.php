<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model 
{
    protected $table = 'Tbl_Convenio';
    
    protected $fillable = [
        'convenio',
        'Evento_id',
        'FormatoCodigo',
        'URL',
        'web_service'
    ];
    
    // Relación con el modelo Evento
    public function evento()
    {
        return $this->belongsTo('Evento', 'Evento_id', 'id');
    }
}