<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 4/10/2021
 * Time: 4:43 PM
 */

namespace Eco\Datos\Modelos;


use Illuminate\Database\Eloquent\Model;

class UsuarioXAsistenteEvento extends Model
{
    protected $table = 'Tbl_Usuarios_X_AsistenteEvento';
    protected $fillable =['AsistentesXEvento_id','user_id'];

}