<?php

namespace Ecotickets\Http\Controllers\UsuarioYRol;

use Eco\Negocio\Logica\UsuarioServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    protected $usuarioServicio;

    public function __construct(UsuarioServicio $usuarioServicio)
    {
        $this->middleware('auth');
        $this->usuarioServicio = $usuarioServicio;
    }

    public  function  ObtenerUsuarios(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $usuarios = $this->usuarioServicio->ObtenerUsuarios();
        return view('UsuarioYRol/ListaUsuarios',['listaUsuarios' =>$usuarios]);
    }

}
