<?php

namespace Ecotickets\Http\Controllers;

use Ecotickets\Datos\Modelos\Evento;
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
    public function index()
    {
        $user = Auth::user();
        $eventos = Evento::where("user_id","=",$user->id)->get();
        $ListaEventos= array('eventos' => $eventos);
        return view('home',['ListaEventos' => $ListaEventos]);
    }
}
