<?php

namespace Ecotickets\Http\Controllers;

use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	protected $eventoServicio;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventosServicio $eventoServicio)
    {
        $this->middleware('auth');
		$this->eventoServicio = $eventoServicio;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        return view('home');
    }
	
	    public  function  ObtenerEventos(EventosServicio $eventosServicio)
    {
        $eventos = $this->eventoServicio->obtenerEventos();
        $ListaEventos= array('eventos' => $eventos);
        return view('home',['ListaEventos' => $ListaEventos]);
    }
}
