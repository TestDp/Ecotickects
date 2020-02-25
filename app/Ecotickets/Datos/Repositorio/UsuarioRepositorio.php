<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:34 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\PermisosUsuarioXEvento;
use Ecotickets\User;
use Illuminate\Support\Facades\DB;

class UsuarioRepositorio
{
    public  function  ObtenerListaUsuariosSuperAdmin()
    {
        $users = User::all();
        return $users;
    }
    public  function  ObtenerListaUsuariosEmpresa($idEmpresa,$idUsuario)
    {
        $users = DB::table('users')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Empresas', 'Tbl_Empresas.id', '=', 'Tbl_Sedes.Empresa_id')
            ->select('users.*')
            ->where('Tbl_Empresas.id', '=', $idEmpresa)
            ->where('users.id','<>',$idUsuario)
            ->get();
        return $users;
    }

    public  function  ObtenerUsuario($idUsuario)
    {
        return User::where('id', '=', $idUsuario)->get()->first();
    }

    //activa o desactiva permisos  del usuario por evento
    public function ActivarPermisoXEvento($idEvento,$idUsuario){
        DB::beginTransaction();
        try{
            $permisosEvento = new PermisosUsuarioXEvento();
            $permisosEvento->user_id= $idUsuario;
            $permisosEvento->Evento_id= $idEvento;
            $permisosEvento ->save();
            DB::commit();
        }catch (\Exception $e)
        {
            DB::rollback();
            return  false;
        }
        return true;
    }

    public function DesacivarPermisoXEvento($idEvento,$idUsuario){
        DB::beginTransaction();
        try{
             PermisosUsuarioXEvento::where('user_id','=',$idUsuario)->
                            where('Evento_id','=',$idEvento)->delete();
            DB::commit();
        }catch (\Exception $e)
        {
            DB::rollback();
            return  false;
        }
        return true;
    }
}