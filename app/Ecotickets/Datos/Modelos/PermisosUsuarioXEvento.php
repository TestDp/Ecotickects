<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 24/02/2020
 * Time: 8:43 AM
 */

namespace Eco\Datos\Modelos;


use Illuminate\Database\Eloquent\Model;

class PermisosUsuarioXEvento extends Model
{
    protected $table = 'Tbl_Permisos_Usuarios_X_Evento';
    protected $fillable =['user_id','Evento_id'];
}