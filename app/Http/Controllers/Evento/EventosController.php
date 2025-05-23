<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\CiudadServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Eco\Negocio\Logica\UsuarioServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class EventosController extends Controller
{
    protected $eventoServicio;
    protected $departamentoServicio;
    protected $asistenteServicio;
    protected  $ciudadServicio;
    protected  $usuarioServicio;


    public function __construct(EventosServicio $eventoServicio,DepartamentoServicio $departamentoServicio,
                                AsistenteServicio $asistenteServicio,CiudadServicio $ciudadServicio,
                                UsuarioServicio $usuarioServicio)
    {
        $this->middleware('auth');
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
        $this->asistenteServicio = $asistenteServicio;
        $this->ciudadServicio = $ciudadServicio;
        $this->usuarioServicio = $usuarioServicio;
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
        $respuestaProceso = $this->eventoServicio->crearEvento($EdEvento);
        $idSede = Auth::user()->Sede->id;
        if($respuestaProceso["Respuesta"])
        {
            $this->usuarioServicio->AsignarPermisosNuevoEvento($respuestaProceso["idEvento"],$idSede);
            if($EdEvento->hasFile('ImagenFlyerEvento')){
                $file = $EdEvento->file('ImagenFlyerEvento');
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                $file->move('FlyerDeEventos', $nombre);
            }
        }
        $eventos = $this->eventoServicio->ListaDeEventosSede($idSede,'Evento');
        $eventosPasados = $this->eventoServicio->ListaDeEventosPasadosSede($idSede,'Evento');
        $ListaEventos= array('eventos' => $eventos);
        $ListaEventosPasados= array('eventosPasados' => $eventosPasados);
        return view('Evento/MisEventos',array('ListaEventos' => $ListaEventos,
                                                    'ListaEventosPasados' => $ListaEventosPasados,
                                                    'respuestaProceso' => $respuestaProceso));

    }

    public function editarEvento(Request $EdEvento)
    {
        $respuestaProceso = $this->eventoServicio->editarEvento($EdEvento);
        if($respuestaProceso)
        {
            if($EdEvento->hasFile('ImagenFlyerEvento')){
                $file = $EdEvento->file('ImagenFlyerEvento');
                $nombre = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
                $file->move('FlyerDeEventos', $nombre);
            }
        }
        $eventos = null;
        $eventosPasados = null;
        $user = Auth::user();
        $idEmpreesa = $user->Sede->Empresa->id;
        $idUser = $user->id;
        if($user->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
            $eventosPasados = Evento::all();
        }else{
            if($user->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
                $eventosPasados = $this->eventoServicio->ListaDeEventosPasadosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
                $eventosPasados = $this->eventoServicio->ObtenerEventosUsuarioPasados($idUser);
            }
        }

        $ListaEventos= array('eventos' => $eventos);
        $ListaEventosPasados= array('eventosPasados' => $eventosPasados);
        return view('Evento/MisEventos',array('ListaEventos' => $ListaEventos,
            'ListaEventosPasados' => $ListaEventosPasados,
            'respuestaProceso'=>$respuestaProceso));

    }

    /*Metodo que me retorna la lista de asistentes*/
    public function ObtenerListaAsistentes(Request $request,$idEvento)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $evento = $this->eventoServicio->obtenerEvento($idEvento);
        $asistentes = $this -> asistenteServicio ->obtenerAsistentesXEvento($idEvento);
        $asistentesGuestList = $this -> asistenteServicio ->obtenerAsistentesXEventoGuestList($idEvento);
        $ListaAsistentes = array ('asistentes' => $asistentes);
        $ListaAsistentesGuestList = array ('asistentesGuestList' => $asistentesGuestList );
        return view('Evento/ListaAsistente', array('ListaAsistentes' => $ListaAsistentes,
            'ListaAsistentesGuestList' => $ListaAsistentesGuestList,"evento" => $evento));
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
        $evento = $this->eventoServicio->obtenerEvento($idEvento);
        return view('Evento/Estadisticas',['idEvento' => $evento->id,'idUser'=>$user->id,'evento'=>$evento]);
    }

    public function obtenerLiquidacion(Request $request,$idEvento)
    {
        $user = Auth::user();
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $ListaEtapas= array('Etapas' => $this -> eventoServicio ->obtenerLiquidacion($idEvento));
        return view('Evento/Liquidacion',['ListaEtapas' => $ListaEtapas,'idUser'=>$user->id]);
    }

    public function obtenerLiquidacionGrafica($idEvento)
    {
        $ListaEtapas= $this -> eventoServicio ->obtenerLiquidacion($idEvento);
        foreach ($ListaEtapas as $etapa){
            $arrayEtapa[]=$etapa->PrecioEtapa;
            $arrayCantidadBoletas[]=$etapa->CantidadBoletas;
        }
        $liquidacion = ['PrecioEtapas' => $arrayEtapa, 'CantidadBoletas' => $arrayCantidadBoletas];
        return response()->json($liquidacion);
    }

    public function obtenerInformePromotor(Request $request,$idEvento)
    {
        $user = Auth::user();
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $ListaPromotor= array('Promotor' => $this -> eventoServicio ->ObtenerInformePromotor($idEvento));
        return view('Evento/InformePromotor',['ListaPromotor' => $ListaPromotor,'idUser'=>$user->id]);
    }

    public function ObtenerInformeUsuarioBoleta(Request $request,$idEvento)
    {
        $user = Auth::user();
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $ListaUsuarioBoleta= array('UsuarioBoleta' => $this -> eventoServicio ->ObtenerInformeUsuarioBoleta($idEvento));
        $ListaUsuarioBoleta2= array('UsuarioBoleta2' => $this -> eventoServicio ->ObtenerInformeUsuarioBoleta2($idEvento));
        return view('Evento/InformeUsuarioBoleta',['ListaUsuarioBoleta' => $ListaUsuarioBoleta,'ListaUsuarioBoleta2' => $ListaUsuarioBoleta2,'idUser'=>$user->id]);
    }

    public function ObtenerMisEventos(Request $request)
    {
        $eventos = null;
        $eventosPasados=null;
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $user = Auth::user();
        $idEmpreesa = $user->Sede->Empresa->id;
        $idUser = $user->id;
        if($request->user()->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
            //$eventosPasados = Evento::all();
            $eventosPasados = $eventos;
        }else{
            if($request->user()->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
                $eventosPasados = $this->eventoServicio->ListaDeEventosPasadosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
                $eventosPasados = $this->eventoServicio->ObtenerEventosUsuarioPasados($idUser);
            }
        }
      /*  $recursosXRol =  collect($user->ListaRecursos());
        $recurso = $recursosXRol->where('Nombre','ListaAsistentes');*/
        $ListaEventos= array('eventos' => $eventos);
        $ListaEventosPasados= array('eventosPasados' => $eventosPasados);
        return view('Evento/MisEventos',array('ListaEventos' => $ListaEventos, 'ListaEventosPasados' => $ListaEventosPasados));
    }

    public function FormularioActivarFunciones(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idUser = Auth::user()->id;
        $eventos = null;
        if($request->user()->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');

        }else{
            if($request->user()->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
            }
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



    public function  obtenerVistaEventosXUsuario(Request $request,$idUsuario)
    {
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idSede = Auth::user()->Sede->id;
        $eventosUsuario = $this->eventoServicio->ListaDeEventosXUsuario($idUsuario);
        $eventos=null;
        if($request->user()->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
        }else{
            if($request->user()->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ListaDeEventosSede($idSede,'Evento');
            }
        }
        $view = View::make('Usuario/AsignarPermisosEventoVP',['listEventos'=>$eventos,
                                                                'eventosUsuario'=>$eventosUsuario,'idUsuario'=>$idUsuario]);
        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }else return view('Usuario/AsignarPermisosEventoVP',['listEventos'=>$eventos,'eventosUsuario'=>$eventosUsuario]);
    }

    public function obtenerLocalidadesEvento(Request $request,$idEvento)
    {
        $user = $request->user();
        if($user->hasRole(env('IdRolSuperAdmin'))){
            return response()->json($this->eventoServicio->obtenerLocalidadesEventoSAdmin($idEvento));
        }else{
            if($user->hasRole(env('IdRolAdmin'))){
                return  $this->eventoServicio->obtenerLocalidadesEventoAdmin($idEvento);
            }else{
                return  $this->eventoServicio->obtenerLocalidadesEventoOtroRol($idEvento);
            }
        }

    }

    public function generarEnlacePromotor(Request $request){
        $eventos = null;
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $idEmpreesa = Auth::user()->Sede->Empresa->id;
        $idUser = Auth::user()->id;
        if($request->user()->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
        }else{
            if($request->user()->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
            }
        }
        return view('Evento/GenerarEnlacePromotor',['eventos'=>$eventos]);
    }

    public function generarQREnlaceEvento(Request $request,$idEvento){
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $host = $request->getHttpHost();
        $path = storage_path('app') . '\qrsEnlaceEvento';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($host.'/FormularioAsistentePago/'.$idEvento));
        file_put_contents($path.'/QREvento'.$idEvento.'.png',base64_decode($qr));
        return response()->download($path.'/QREvento'.$idEvento.'.png')->deleteFileAfterSend(true);
    }

}
