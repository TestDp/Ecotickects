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
        return view('home');
    }
}
