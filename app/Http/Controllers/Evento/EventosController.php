<?php

namespace Ecotickets\Http\Controllers\Evento;

use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Ecotickets\Datos\Modelos\Departamento;
use Ecotickets\Datos\Modelos\Ciudad;
use Ecotickets\Datos\Modelos\Evento;

class EventosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function obtenerFormularioEvento()
    {
        $departamentos = Departamento::all();
        $formulario = array('departamentos' => $departamentos);
        return view('Evento\CrearEvento',['formulario' =>$formulario]);
    }

    public function crearEvento(Request $EdEvento)
    {
        $evento = new Evento($EdEvento->all());
        $evento->save();
        return redirect('/home');
    }


    public function obtenerCiudades($idDepartamento)
    {
        $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        return response()->json($ciudades);
    }

}
