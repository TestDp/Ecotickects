<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Departamento;


class EcoticketsController extends Controller
{

    protected $eventoServicio;
    protected $departamentoServicio;

    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio)
    {
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
    }

    public  function  welcome()
    {
        return view('welcome');
    }
    public  function  ObtenerEventos()
    {

        //dd($this->eventoServicio->obtenerEventos());

        return $this->eventoServicio->obtenerEventos();


    }

    public  function  ObtenerCupones(EventosServicio $eventosServicio)
    {

        return $this->eventoServicio->obtenerCupones();

       /* $eventos = Evento::where('Tipo_Evento','=','Cupon')->get();
        $ListaEventos = array('eventos' => $eventos);
        return view('Evento/ListaCupones',['ListaEventos' => $ListaEventos]);*/
    }

    //metodo que me muestra el formulario del registro para el evento
    ///parametros:$idEvento -> id del evento en el cual se va a realizar el registro
    public function obtenerFormularioAsistente($idEvento)
    {
        $evento =$this->eventoServicio->obtenerEvento($idEvento);
        $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
        $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento);
        return view('Evento/RegistrarAsistente',['ElementosArray' =>$ElementosArray]);
    }

}
