<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Eco\Datos\Modelos\Asistente;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Ecotickets\Http\Controllers\Controller;



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
        return $this->eventoServicio->obtenerEventos();
    }

    public  function  ObtenerCupones(EventosServicio $eventosServicio)
    {
        return $this->eventoServicio->obtenerCupones();
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
