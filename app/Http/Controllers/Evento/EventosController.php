<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            if($EdEvento->hasFile('ImagenFlyerEvento')){
                $file = $EdEvento->file('ImagenFlyerEvento');
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                $file->move(public_path().'/FlyerDeEventos/', $nombre);
            }

            /**obtenemos el campo file definido en el formulario
            $FlyerEvento = $EdEvento->ImagenFlyerEvento;
            if($FlyerEvento != null){
                //Asignamos el nombre del archivo
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                //indicamos que queremos guardar un nuevo archivo en el disco local

                \Storage::disk('local')->put('/public/FlyerDeEventos/'.$nombre,file_get_contents($FlyerEvento));
            }**/
            return redirect('/home');
        }else{
            return redirect('/');
        }

    }

    /*Metodo que me retorna la lista de asistentes*/
    public function ObtenerListaAsistentes($idEvento)
    {
        $ListaAsistentes= array('Asistentes' => $this -> asistenteServicio ->obtenerAsistentesXEvento($idEvento));
        return view('Evento/ListaAsistente',['ListaAsistentes' =>$ListaAsistentes]);
    }

    public function obtenerEstadisticas($idEvento)
    {
        $user = Auth::user();
        $idEvento=$this->eventoServicio->obtenerEvento($idEvento)->id;
        return view('Evento/Estadisticas',['idEvento' => $idEvento,'idUser'=>$user->id]);
    }

    public function ObtenerMisEventos(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $eventos=[];
        if(Auth::user()->hasRole('admin'))
        {
            $eventos = Evento::all();
        }else{
            $eventos = Evento::where("user_id","=",$user->id)->get();
        }

        $eventos->each(function($eventos){
            $eventos->ciudad = Ciudad::where('id','=',$eventos ->Ciudad_id)->get()->first();
            $eventos->ciudad->departamento=Departamento::where('id','=',$eventos->ciudad->Departamento_id)->get()->first();
        });
        $ListaEventos= array('eventos' => $eventos);
        return view('Evento/MisEventos',['ListaEventos' => $ListaEventos]);
    }

    public function FormularioActivarFunciones(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $eventos=[];
        if(Auth::user()->hasRole('admin'))
        {
            $eventos = Evento::all();
        }else{
            $eventos = Evento::where("user_id","=",$user->id)->get();
        }
        $ListaEventos= array('eventos' => $eventos);
        return view('Evento/ActivarFuncionesEventos',['ListaEventos' => $ListaEventos]);
    }

    /*metodo para activar o desactivar si el evento es pago*/
    public function ActivarEventoPago($idEvento,$FlagEsActivo)
    {
        return response()->json($this->eventoServicio->ActivarEventoPago($idEvento,$FlagEsActivo));
    }

    /*metodo para activar o desactivar la tienda del evento*/
    public function ActivarTienda($idEvento,$FlagEsActivo)
    {
        return response()->json($this->eventoServicio->ActivarTienda($idEvento,$FlagEsActivo));
    }

    /*metodo para activar o desactivar la solicitud de pin*/
    public function ActivarSolicitarPIN($idEvento,$FlagEsActivo)
    {
        return response()->json($this->eventoServicio->ActivarSolicitarPIN($idEvento,$FlagEsActivo));
    }

    /*metodo para activar o desactivar si el evento es publico o no*/
    public function ActivarEsPublico($idEvento,$FlagEsActivo)
    {
        return response()->json($this->eventoServicio->ActivarEsPublico($idEvento,$FlagEsActivo));
    }

}
