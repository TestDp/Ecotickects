<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        if($this->eventoServicio->crearEvento($EdEvento) )        {
            //obtenemos el campo file definido en el formulario
            $FlyerEvento = $EdEvento->ImagenFlyerEvento;
            //Asignamos el nombre del archivo
            $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put('/FlyerDeEventos/'.$nombre,file_get_contents($FlyerEvento));
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
