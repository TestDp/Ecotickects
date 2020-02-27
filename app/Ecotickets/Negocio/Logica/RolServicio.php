<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 1:34 PM
 */

namespace Eco\Negocio\Logica;


use Eco\Datos\Repositorio\RolRepositorio;


class RolServicio
{
    protected  $rolRepositorio;
    public function __construct(RolRepositorio $rolRepositorio){
        $this->rolRepositorio = $rolRepositorio;
    }

    public  function GuardarRol($rol){
        return $this->rolRepositorio->GuardarRol($rol);
    }

    public  function  ObtenerListaRoles($idEmpreesa){
        return $this->rolRepositorio->ObtenerListaRoles($idEmpreesa);
    }

    public  function  ObtenerRol($idRol)
    {
        return $this->rolRepositorio->ObtenerRol($idRol);
    }

    public function ObtenerListaRecursosDelRol($idRol){
        return $this->rolRepositorio->ObtenerListaRecursosDelRol($idRol);
    }

    public function ObtenerRolesSupeAdmin(){
        return $this->rolRepositorio->ObtenerRolesSupeAdmin();
    }
    public  function  ObtenerRolesAsignadosEmpresa($idEmpresa){
        return $this->rolRepositorio->ObtenerRolesAsignadosEmpresa($idEmpresa);
    }
    public  function ObtenerRolesUsuario($idUsuario)
    {
        return $this->rolRepositorio->ObtenerRolesUsuario($idUsuario);
    }

    public  function  ObtenerRolesAsignadosXUsuario($idUsuario)
    {
        return $this->rolRepositorio->ObtenerRolesAsignadosXUsuario($idUsuario);
    }
}