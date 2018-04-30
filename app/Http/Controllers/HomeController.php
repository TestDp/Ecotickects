<?php

namespace Ecotickets\Http\Controllers;

use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $eventos=[];
        if(Auth::user()->hasRole('admin'))
        {
            $eventos = Evento::all();
        }else{
            $eventos = Evento::where("user_id","=",$user->id)->get();
        }

        $eventos->each(function($eventos){
            $eventos->ciudad = Ciudad::where('id','=',$eventos ->Ciudad_id)->get()->first();
            $eventos->ciudad->departamento=Departamento::where('id','=',$eventos->ciudad->Departamento_id)->get()->first();
        });
        $ListaEventos= array('eventos' => $eventos);
        return view('home',['ListaEventos' => $ListaEventos]);
    }
}
