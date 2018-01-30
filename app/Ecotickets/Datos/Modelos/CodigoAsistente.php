<?php

namespace Eco\Datos\Modelos;

use Illuminate\Database\Eloquent\Model;

class CodigoAsistente extends Model
{
    protected $table = 'tbl_CodigosAsitente';
    protected $fillable =['Codigo','Identificacion','TipoCodigo'];

 
}