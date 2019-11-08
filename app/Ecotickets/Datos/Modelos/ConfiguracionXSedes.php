<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;
use Eco\Datos\Modelos\AsistenteXEvento;

class ConfiguracionXSede extends Model
{
    protected $table = 'Tbl_ConfiguracionXSedes';
    protected $fillable =['Sede_id','PrecioMinimo','PrecioMaximo','VigenciaDesde','VigenciaHasta','Porcentaje','Impuesto1','Impuesto2','Comision1','Comision2','EsActivo'];

    public function sede(){
        return $this->belongsTo('Sede');
    }



}
