<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 8/05/2018
 * Time: 5:15 PM
 */

namespace Eco\Datos\Repositorio;

use Ecotickets\User;


class UsuarioRepositorio
{

    public  function  ObtenerUsuarios()
    {
        return User::all();
    }

}