<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;

class EventosController extends Controller
{
    protected $eventoServicio;
    protected $departamentoServicio;
    protected $asistenteServicio;


    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio,AsistenteServicio $asistenteServicio)
    {
        $this->middleware('auth');
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
        $this->asistenteServicio = $asistenteServicio;
    }


    public function obtenerFormularioEvento()
    {
        $departamentos = $this->departamentoServicio->obtenerDepartamento();
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

    /*Metodo que me retorna la lista de asistentes*/
    public function ObtenerListaAsistentes($idEvento)
    {
        $ListaAsistentes= array('Asistentes' => $this -> asistenteServicio ->obtenerAsistentesXEvento($idEvento));
        return view('Evento\ListaAsistente',['ListaAsistentes' =>$ListaAsistentes]);
    }



}
