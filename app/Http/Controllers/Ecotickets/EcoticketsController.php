<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Eco\Datos\Modelos\Asistente;
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Ecotickets\Http\Controllers\Controller;
use Eco\Negocio\Logica\AsistenteServicio;



class EcoticketsController extends Controller
{

    protected $eventoServicio;
    protected $departamentoServicio;
    protected $asistenteServicio;

    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio,AsistenteServicio $asistenteServicio)
    {
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
        $this->asistenteServicio = $asistenteServicio;
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
        $CantidadRegistrados = $this->asistenteServicio->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $evento = $this->eventoServicio->obtenerEvento($idEvento);
        if($CantidadRegistrados<$CantidadEsperada && $evento->EsPublico ==true && $evento->esPago == false){
            $evento =$this->eventoServicio->obtenerEvento($idEvento);
            $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento);
            return view('Evento/RegistrarAsistente',['ElementosArray' =>$ElementosArray]);
        }else{
            return view('cantidadSuperada');
        }
    }

    ///metodo que me muestra el formulario del registro para el evento
    ///parametros:$idEvento -> id del evento en el cual se va a realizar el registro
    public function obtenerFormularioAsistentePago($idEvento)
    {
        $CantidadRegistrados = $this->asistenteServicio->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        if($CantidadRegistrados<$CantidadEsperada && $this->eventoServicio->obtenerEvento($idEvento)->EsPublico ==true){
            $evento =$this->eventoServicio->obtenerEvento($idEvento);
            $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento);
            return view('Evento/RegistrarAsistentePago',['ElementosArray' =>$ElementosArray]);
        }else{
            return view('cantidadSuperada');
        }
    }
    public function EventosApp($idUser)
    {
        $eventos = Evento::where("user_id","=",$idUser)->get();
        $eventos->each(function($eventos){
            $eventos->ciudad = Ciudad::where('id','=',$eventos ->Ciudad_id)->get()->first();
            $eventos->ciudad->departamento=Departamento::where('id','=',$eventos->ciudad->Departamento_id)->get()->first();
        });
        $ListaEventos= array('eventos' => $eventos);
        return response()->json(['ListaEventos' => $ListaEventos]);
    }
    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }


}
