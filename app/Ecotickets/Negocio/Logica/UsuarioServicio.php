<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 8/05/2018
 * Time: 5:18 PM
 */

namespace Eco\Negocio\Logica;




use Eco\Datos\Repositorio\UsuarioRepositorio;

class UsuarioServicio
{
    protected $usuarioRepositorio;
    public function __construct(UsuarioRepositorio $usuarioRepositorio)
    {
        $this->usuarioRepositorio = $usuarioRepositorio;
    }

    public  function  ObtenerUsuarios()
    {
        return $this->usuarioRepositorio->ObtenerUsuarios();
    }
}