<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class ConvenioxPreciosBoleta extends Model 
{
    protected $table = 'Tbl_ConvenioxPreciosBoletas';
    
    protected $fillable = [
        'PrecioBoleta_id',
        'Convenio_id',
        'Tarifa',
        'AsistentexEvento_id'
    ];
    
    // Relación con el modelo Convenio
    public function convenio()
    {
        return $this->belongsTo('Convenio', 'Convenio_id', 'id');
    }
    
    // Relación con el modelo Localidad (asumiendo que existe)
    public function PrecioBoleta()
    {
        return $this->belongsTo('Tbl_PreciosBoletas', 'PrecioBoleta_id', 'id');
    }
    
    // Relación con el modelo AsistenteXEvento
    public function asistenteXEvento()
    {
        return $this->belongsTo('AsistenteXEvento', 'AsistentexEvento_id', 'id');
    }
}