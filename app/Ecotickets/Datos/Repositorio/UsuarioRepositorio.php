<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:34 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\PermisosUsuarioXEvento;
use Eco\Datos\Modelos\Rol_Por_Usuario;
use Ecotickets\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ->join('Tbl_Roles','Tbl_Roles.Empresa_id','=','Tbl_Empresas.id')
            ->join('Tbl_Roles_Por_Usuarios','Tbl_Roles_Por_Usuarios.Rol_id','=','Tbl_Roles.id')
            ->select('users.*')
            ->where('Tbl_Roles_Por_Usuarios.Rol_id','<>',13)
            ->where('Tbl_Empresas.id', '=', $idEmpresa)
            ->where('users.id','<>',$idUsuario)
            ->get();
        return $users;
    }

    public  function  ObtenerUsuario($idUsuario)
    {
        return User::where('id', '=', $idUsuario)->get()->first();
    }

    //retorna el verdadero y el id del usuario si el usuario existe
    public function ExisteUsuario($userName = null,$correoUsuario=null){
        if(isset($userName)){
            $usuario = User::where('username', '=', $userName)->get()->first();
           if(isset($usuario)){
               return ['respuesta' =>true,'idUsuario'=>$usuario->id];
            }
        }
        if(isset($correoUsuario)){
            $usuario = User::where('email', '=', $correoUsuario)->get()->first();
            if(isset($usuario)){
                return ['respuesta' =>true,'idUsuario'=>$usuario->id];
            }
        }
        return false;
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

    public function tienePermisosXEvento($idEvento,$idUsuario){
      $consultaPermiso = PermisosUsuarioXEvento::where('user_id','=',$idUsuario)
                                ->where('Evento_id','=',$idEvento)->get()->first();
      if(isset($consultaPermiso)){
          return true;
      }else{
          return false;
      }
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

    public function UsuariosXSede($idsede)
    {
        return User::where('Sede_id', '=', $idsede)->get();
    }

    //Metodo que recibe el objeto de usuario y una array de ids  de roles
    public function guardarUsuario($usuarioObj,$rolesListObj){
        DB::beginTransaction();
        try {
            $usuarioObj->save();
            foreach ($rolesListObj as $rolid){
                $rolPorUsuario = new Rol_Por_Usuario();
                $rolPorUsuario->Rol_id = $rolid;
                $rolPorUsuario->user_id = $usuarioObj->id;
                $rolPorUsuario->save();
            }
            DB::commit();
            return ['respuesta' => true,'idUsuario'=> $usuarioObj->id];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }

    }

    // se crear un intancia del modelo usuario a partir de una intancia del modelo asistente
    public function crearModelUsuario($modelAsisten){
        $user = new User();
        $user->name = $modelAsisten->Nombres;
        $user->last_name = $modelAsisten->Apellidos;
        $user->username = explode('@',$modelAsisten->email)[0];
        $user->email = $modelAsisten->email;
        $user->password = Hash::make($modelAsisten->Identificacion);
        $user->Sede_id = env('SEDEPRINCIPALECO');
        $user->CorreoConfirmado = 1;
        return $user;
    }
}