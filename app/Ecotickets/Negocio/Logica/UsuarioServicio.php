<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:33 PM
 */

namespace Eco\Negocio\Logica;




use Eco\Datos\Repositorio\UsuarioRepositorio;
use Ecotickets\User;
use Illuminate\Support\Facades\Hash;

class UsuarioServicio
{

    protected  $usuarioRepositorio;
    public function __construct(UsuarioRepositorio $usuarioRepositorio){
        $this->usuarioRepositorio = $usuarioRepositorio;
    }

    public  function  ObtenerListaUsuariosSuperAdmin()
    {
        return $this->usuarioRepositorio->ObtenerListaUsuariosSuperAdmin();
    }
    public  function  ObtenerListaUsuariosEmpresa($idEmpresa,$idUsuario){
        return $this->usuarioRepositorio->ObtenerListaUsuariosEmpresa($idEmpresa,$idUsuario);
    }

    public  function  ObtenerUsuario($idUsuario){
        return $this->usuarioRepositorio->ObtenerUsuario($idUsuario);
    }
    public function AcivarPermisoXEvento($idEvento,$idUsuario){
        return $this->usuarioRepositorio->ActivarPermisoXEvento($idEvento,$idUsuario);
    }
    public function DesacivarPermisoXEvento($idEvento,$idUsuario){
        return $this->usuarioRepositorio->DesacivarPermisoXEvento($idEvento,$idUsuario);
    }

    public function AsignarPermisosNuevoEvento($idEvento,$idSede)
    {
        $usuarios = $this->usuarioRepositorio->UsuariosXSede($idSede);
        foreach ($usuarios as $usuario){
            $this->usuarioRepositorio->ActivarPermisoXEvento($idEvento,$usuario->id);
        };
    }

    public function guardarUsuario($request){
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->CorreoConfirmado = 1;
        return $this->usuarioRepositorio->guardarUsuario($user,$request->Roles_id);
    }

}