<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\CiudadServicio;
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
    protected  $ciudadServicio;


    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio,
                                AsistenteServicio $asistenteServicio,CiudadServicio $ciudadServicio)
    {
        $this->middleware('auth');
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
        $this->asistenteServicio = $asistenteServicio;
        $this->ciudadServicio = $ciudadServicio;
    }


    public function obtenerFormularioEvento(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $departamentos = $this->departamentoServicio->obtenerDepartamento();
        $formulario = array('departamentos' => $departamentos);
        return view('Evento/CrearEvento',['formulario' =>$formulario]);
    }

    public function obtenerFormularioEditarEvento($idEvento)
    {
        $departamentos = $this->departamentoServicio->obtenerDepartamento();
        $formulario = array('departamentos' => $departamentos);
        $evento = $this->eventoServicio->obtenerEventoEditar($idEvento);
        $ciudades = $this->ciudadServicio->obtenerCiudades($evento->ciudad->departamento->id);
        $fechaEventoCompleta = new \DateTime($evento->Fecha_Evento);
        $fechaIniRegistroCompleta = new \DateTime($evento->Fecha_Inicial_Registro);
        $fechaFinRegistroCompleta = new \DateTime($evento->Fecha_Final_Registro);
        $evento->fechaEventoSinHora=$fechaEventoCompleta->format('Y-m-d');
        $evento->horaEvento = $fechaEventoCompleta->format('H:i:s');
        $evento->fechaIniRegistroSinHora = $fechaIniRegistroCompleta->format('Y-m-d');
        $evento->horaIniRegistro = $fechaEventoCompleta->format('H:i:s');
        $evento->fechaFinRegistroSinHora = $fechaFinRegistroCompleta->format('Y-m-d');
        $evento->horaFinRegistro = $fechaFinRegistroCompleta->format('H:i:s');
        return view('Evento/editarEvento',['formulario' =>$formulario,'evento'=>$evento,'ciudades'=>$ciudades]);
    }

    public function crearEvento(Request $EdEvento)
    {
        $urlinfo= $EdEvento->getPathInfo();
        $EdEvento->user()->AutorizarUrlRecurso($urlinfo);
        if($this->eventoServicio->crearEvento($EdEvento) )
        {
            if($EdEvento->hasFile('ImagenFlyerEvento')){
                $file = $EdEvento->file('ImagenFlyerEvento');
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                $file->move('FlyerDeEventos', $nombre);
            }
            return redirect('/home');
        }else{
            return redirect('/');
        }

    }

    public function editarEvento(Request $EdEvento)
    {
        if($this->eventoServicio->editarEvento($EdEvento) )        {

            if($EdEvento->hasFile('ImagenFlyerEvento')){
                $file = $EdEvento->file('ImagenFlyerEvento');
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                $file->move('FlyerDeEventos', $nombre);
            }
            return redirect('/home');
        }else{
            return redirect('/');
        }

    }
    /*Metodo que me retorna la lista de asistentes*/
    public function ObtenerListaAsistentes(Request $request,$idEvento)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);

        $asistentes = $this -> asistenteServicio ->obtenerAsistentesXEvento($idEvento);
        $asistentesGuestList = $this -> asistenteServicio ->obtenerAsistentesXEventoGuestList($idEvento);

        $ListaAsistentes = array ('asistentes' => $asistentes);
        $ListaAsistentesGuestList = array ('asistentesGuestList' => $asistentesGuestList );

        return view('Evento/ListaAsistente', array('ListaAsistentes' => $ListaAsistentes,'ListaAsistentesGuestList' => $ListaAsistentesGuestList));


    }

    /*Metodo que me retorna la lista de asistentes Guest List*/
    public function ObtenerListaAsistentesGuestList(Request $request,$idEvento)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $ListaAsistentesGuestList= array('Asistentes' => $this -> asistenteServicio ->obtenerAsistentesXEventoGuestList($idEvento));
        return view('Evento/ListaAsistenteGuestList',['ListaAsistentesGuestList' =>$ListaAsistentesGuestList]);
    }

    public function obtenerEstadisticas(Request $request,$idEvento)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $user = Auth::user();
        $idEvento=$this->eventoServicio->obtenerEvento($idEvento)->id;
        return view('Evento/Estadisticas',['idEvento' => $idEvento,'idUser'=>$user->id]);
    }

    public function obtenerLiquidacion(Request $request,$idEvento)
    {
       // $urlinfo= $request->getPathInfo();
       // $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
      //  $request->user()->AutorizarUrlRecurso($urlinfo);
        $user = Auth::user();
        $evento=$this->eventoServicio->obtenerEvento($idEvento)->id;
        $ListaEtapas= array('Etapas' => $this -> eventoServicio ->obtenerLiquidacion($idEvento));
        //return view('Evento/ListaAsistente',['ListaAsistentes' =>$ListaAsistentes]);
        return view('Evento/Liquidacion',['ListaEtapas' => $ListaEtapas,'idUser'=>$user->id]);
    }

    public function obtenerLiquidacionGrafica($idEvento)
    {

        $user = Auth::user();
        $ListaEtapas= $this -> eventoServicio ->obtenerLiquidacion($idEvento);

        foreach ($ListaEtapas as $etapa){
            $arrayEtapa[]=$etapa->PrecioEtapa;
            $arrayCantidadBoletas[]=$etapa->CantidadBoletas;

        }

        $liquidacion = ['PrecioEtapas' => $arrayEtapa, 'CantidadBoletas' => $arrayCantidadBoletas];
        return response()->json($liquidacion);

    }



    public function ObtenerMisEventos(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
       // $user = Auth::user();
        $idSede = Auth::user()->Sede->id;
      /**  if(Auth::user()->hasRole('admin'))
        {
            $eventos = Evento::all();
        }else{
            $eventos = Evento::where("user_id","=",$user->id)->get();
        }**/
        $eventos = $this->eventoServicio->ListaDeEventosSede($idSede,'Evento');

        $eventosPasados = $this->eventoServicio->ListaDeEventosPasadosSede($idSede,'Evento');


        $ListaEventos= array('eventos' => $eventos);
        $ListaEventosPasados= array('eventosPasados' => $eventosPasados);

        return view('Evento/MisEventos',array('ListaEventos' => $ListaEventos, 'ListaEventosPasados' => $ListaEventosPasados));
    }

    public function FormularioActivarFunciones(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $user = Auth::user();
        $idSede = Auth::user()->Sede->id;
        $eventos=[];
        if(Auth::user()->hasRole('SuperAdmin'))
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

    public function  ActualizarEventosFecha()
    {
        $this->eventoServicio->ActualizarEventosFecha();
    }

}
