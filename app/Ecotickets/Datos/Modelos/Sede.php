<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 9/08/2018
 * Time: 10:49 AM
 */

namespace Eco\Datos\Modelos;



use Ecotickets\User;
use Illuminate\Database\Eloquent\Model;

class Sede extends  Model
{
    protected $table = 'Tbl_Sedes';
    protected $fillable =['Nombre','Direccion','Telefono','Empresa_id'];

    public function Empresa()
    {
        return $this->belongsTo(Empresa::class,'Empresa_id');
    }

    public function Usuarios(){
        return $this->hasMany(User::class,'Sede_id','id');
    }

    public function PromotoresXsede(){
        return $this->hasMany('Eco\Datos\Modelos\PromotoresXSede','Sede_id','id');
    }




}