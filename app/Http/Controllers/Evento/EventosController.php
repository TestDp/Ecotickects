<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;

class EventosController extends Controller
{
    protected $eventoServicio;
    protected $departamentoServicio;
    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio)
    {
        $this->middleware('auth');
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
    }


    public function obtenerFormularioEvento()
    {
        $departamentos = $this->departamentoServicio->obtenerDepartamentos();
        $formulario = array('departamentos' => $departamentos);
        return view('Evento/CrearEvento',['formulario' =>$formulario]);
    }

    public function crearEvento(Request $EdEvento)
    {
        if($this->eventoServicio->crearEvento($EdEvento) )
        {
            return redirect('/home');
        }else{
            return redirect('/');
        }

    }


    public function obtenerListaAsistentes()
    {
        return view('Evento\ListaAsistente');
    }
}
