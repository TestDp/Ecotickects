<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 6/09/2018
 * Time: 3:28 PM
 */

namespace Ecotickets\Http\Controllers\UsuarioYRol;


use Eco\Datos\Modelos\Rol_Por_Usuario;
use Eco\Negocio\Logica\RolServicio;
use Eco\Negocio\Logica\SedeServicio;
use Eco\Negocio\Logica\UsuarioServicio;
use Eco\Validaciones\UsuarioValidaciones;
use Ecotickets\Http\Controllers\Controller;
use Ecotickets\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends  Controller
{

    protected $usuarioServicio;
    protected $sedeServicio;
    protected $rolServicio;
    protected $usuarioValidaciones;

    public function __construct(UsuarioServicio $usuarioServicio, SedeServicio $sedeServicio, RolServicio $rolServicio,
                                UsuarioValidaciones $usuarioValidaciones){
        $this->middleware('auth');
        $this->usuarioServicio = $usuarioServicio;
        $this->sedeServicio = $sedeServicio;
        $this->rolServicio = $rolServicio;
        $this->usuarioValidaciones = $usuarioValidaciones;
    }

    //Metodo para cargar  la vista de crear un rol
    public function CrearUsuarioEmpresa(Request $request)
    {
        $roles = null;
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        if($request->user()->hasRole("SuperAdmin")){
            $roles = $this->rolServicio->ObtenerRolesSupeAdmin($idEmpreesa);
        }else{
            $roles = $this->rolServicio->ObtenerRolesAsignadosXUsuario($request->user()->id);
        }
        $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        $view = View::make('Usuario/crearUsuario',
            array('listRoles'=>$roles,'listSedes'=>$sedes));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return View::make('Usuario/crearUsuario',
            array('listRoles'=>$roles,'listSedes'=>$sedes));
    }

    //Metodo para cargar  la vista de editar un rol
    public function EditarUsuarioEmpresa(Request $request, $idUsuario)
    {
        $roles = null;
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idUsuario,$urlinfo)[0];//se parte la url para quitarle el parametro y porder consultarla NOTA:provicional mientras se encuentra otra forma
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $usuario = $this->usuarioServicio->ObtenerUsuario($idUsuario);
        $sedes = $this->sedeServicio->ObtenerListaSedes($idEmpreesa);
        if($request->user()->hasRole("SuperAdmin")){
            $roles = $this->rolServicio->ObtenerRolesSupeAdmin($idEmpreesa);
        }else{
            $roles = $this->rolServicio->ObtenerRolesAsignadosXUsuario($request->user()->id);
        }
        $rolesUsuario = $this->rolServicio->ObtenerRolesUsuario($idUsuario);
        $view = View::make('Usuario/editarUsuario',
            array('usuario'=>$usuario,'listSedes'=>$sedes,'listRoles'=>$roles,'rolesUsuario'=>$rolesUsuario));
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Usuario/editarUsuario');
    }

    //Metodo para guardar la informacion editada del usuario
    public function EditarUsuario(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->usuarioValidaciones->ValidarFormularioEditar($request->all())->validate();
        DB::beginTransaction();
        try {
            $user =  User::find($request->id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->Sede_id = $request->Sede_id;
            Rol_Por_Usuario::where('user_id','=',$request->id)->delete();
            $user->save();
            foreach ($request->Roles_id as $rolid){
                $rolPorUsuario = new Rol_Por_Usuario();
                $rolPorUsuario->Rol_id = $rolid;
                $rolPorUsuario->user_id = $user->id;
                $rolPorUsuario->save();
            }
            DB::commit();

        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
        $usuarios = null;
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idUsuario = Auth::user()->id;
        if($request->user()->hasRole("SuperAdmin")){
            $usuarios = $this->usuarioServicio->ObtenerListaUsuariosSuperAdmin();
        }else{
            $usuarios = $this->usuarioServicio->ObtenerListaUsuariosEmpresa($idEmpreesa,$idUsuario);
        }
        $view = View::make('Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Usuario/listaUsuarios');
    }

    public function CambiarContrasenaUsuario(Request $request){
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->usuarioValidaciones->ValidarFormularioContrasena($request->all())->validate();
        DB::beginTransaction();
        try {
            $user =  User::find($request->id);
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return ['respuesta' => true];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
    }
    //Metodo para crear un usuario desde el perfil de una empresa
    public function GuardarUsuarioEmpresa(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $this->usuarioValidaciones->ValidarFormularioCrear($request->all())->validate();
        DB::beginTransaction();
        try {
            $user = new User($request->all());
            $user->password = Hash::make($request->password);
            $user->CorreoConfirmado = 1;
            $user->save();
            foreach ($request->Roles_id as $rolid){
                $rolPorUsuario = new Rol_Por_Usuario();
                $rolPorUsuario->Rol_id = $rolid;
                $rolPorUsuario->user_id = $user->id;
                $rolPorUsuario->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idUsuario = Auth::user()->id;
        $usuarios = $this->usuarioServicio->ObtenerListaUsuarios($idEmpreesa,$idUsuario);
        $view = View::make('Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Usuario/listaUsuarios');
    }

    //Metodo para obtener todos  los usuarios por empresa
    public  function ObtenerUsuarios(Request $request){
        $usuarios = null;
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idUsuario = Auth::user()->id;
        if($request->user()->hasRole("SuperAdmin")){
            $usuarios = $this->usuarioServicio->ObtenerListaUsuariosSuperAdmin();
        }else{
            $usuarios = $this->usuarioServicio->ObtenerListaUsuariosEmpresa($idEmpreesa,$idUsuario);
        }
        $view = View::make('Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Usuario/listaUsuarios')->with('listUsuarios',$usuarios);
    }

    //Funcion para verificar el correo del usuario registrado
    public function verifarCorreo($code)
    {
        $user = User::where('CodigoConfirmacion', $code)->first();
        if (! $user)
            return redirect('/');
        $user->CorreoConfirmado = true;
        $user->CodigoConfirmacion = null;
        $user->save();
        return redirect('/home')->with('notification', 'Has confirmado correctamente tu correo!');
    }
}