<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Eco\Datos\Modelos\Asistente;
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EventosServicio;
use Eco\Negocio\Logica\ProductosServicio;
use Ecotickets\Http\Controllers\Controller;
use Eco\Negocio\Logica\AsistenteServicio;
use Ecotickets\User;
use Illuminate\Support\Facades\Auth;



class EcoticketsController extends Controller
{

    protected $eventoServicio;
    protected $departamentoServicio;
    protected $asistenteServicio;
    protected $productosServicio;

    public function __construct(EventosServicio $eventoServicio,
                                DepartamentoServicio $departamentoServicio,
                                AsistenteServicio $asistenteServicio,
                                ProductosServicio $productosServicio)
    {
        $this->departamentoServicio=$departamentoServicio;
        $this->eventoServicio = $eventoServicio;
        $this->asistenteServicio = $asistenteServicio;
        $this->productosServicio = $productosServicio;
    }

    public  function  welcome()
    {
        return view('welcome');
    }

    public  function  ObtenerEventos()
    {
        $eventos = $this->eventoServicio->obtenerEventos();
        $rutaImagenes=env('RutaFlyerEventoWelcome');
        $ListaEventos= array('eventos' => $eventos,'rutaImagenes'=>$rutaImagenes);
        $eventosDestacados = $this->eventoServicio->obtenerEventosDestacados();
        $ListaEventosDestacados= array('eventosDestacados' => $eventosDestacados,'rutaImagenes'=>$rutaImagenes);
        $cupones = $this->eventoServicio->obtenerCupones();
        $ListaEcupones= array('cupones' => $cupones,'rutaImagenes'=>$rutaImagenes);
        return view('welcome',array('ListaEcupones' => $ListaEcupones,'ListaEventos' => $ListaEventos, 'ListaEventosDestacados' => $ListaEventosDestacados) );
    }

    public  function  ObtenerCupones()
    {
        $cupones = $this->eventoServicio->obtenerCupones();
        $rutaImagenes=env('RutaFlyerEventoWelcome');
        $ListaEcupones= array('cupones' => $cupones,'rutaImagenes'=>$rutaImagenes);
        return view('Evento/ListaEcupones',['ListaEcupones' => $ListaEcupones]);
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
            $rutaImagenes=env('RutaFlyerEventoRegistrarAsistente');
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento,'rutaImagenes'=>$rutaImagenes);
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
        $evento =$this->eventoServicio->obtenerEvento($idEvento);
        $CantidadEsperada =$evento->numeroAsistentes;
        if($CantidadRegistrados<$CantidadEsperada && $evento->EsPublico ==true){
            $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
            $rutaImagenes=env('RutaFlyerEventoRegistrarAsistente');
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento,'rutaImagenes'=>$rutaImagenes);
            return view('Evento/RegistrarAsistentePago',['ElementosArray' =>$ElementosArray]);
        }else{
            return view('cantidadSuperada');
        }
    }

    public function obtenerFormularioProspectoPagoPromotor($idEvento,$idPromotor)
    {
        $CantidadRegistrados = $this->asistenteServicio->ObtnerCantidadAsistentes($idEvento);
        $evento =$this->eventoServicio->obtenerEvento($idEvento);
        $CantidadEsperada =$evento->numeroAsistentes;
        if($CantidadRegistrados<$CantidadEsperada && $this->eventoServicio->obtenerEvento($idEvento)->EsPublico ==true){
            $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
            $rutaImagenes = env('RutaFlyerEventoRegistrarAsistentePromotor');
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,
                'EventoId'=>$idEvento,'rutaImagenes'=>$rutaImagenes,'idPromotor' => $idPromotor);
            return view('Evento/RegistrarProspectoPagoPromotor',['ElementosArray' =>$ElementosArray]);
        }else{
            return view('cantidadSuperada');
        }
    }

    public function EventosApp($idUser)
    {
        $user = User::where("id","=",$idUser)->first();
        $idSede = $user->Sede->id;
        $eventos=null;
        if($user->hasRole(env('IdRolSuperAdmin')))
        {
            $eventos = Evento::all();
        }else{
            $eventos = $this->eventoServicio->ListaDeEventosSede($idSede,'Evento');
        }
        return response()->json($eventos);
    }

    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }

    //Metodo para obtener los productos activos para la tienda del evento
    //$idEvento: id o pk del evento
    public function  obtenerProductosXEvento($idEvento)
    {
        $productosXEventos = $this->productosServicio->obtenerProductosXEvento($idEvento);
        $rutaImagenes=env('RutaTiendaProducto').$productosXEventos['idUser'].'/';
        $ListaProductos = array('productos' => $productosXEventos['Productos'],'rutaImagenes'=>$rutaImagenes,'idEvento'=>$idEvento);
        return view('Tienda/TiendaEvento',$ListaProductos);
    }

    public function  ActualizarEventosFecha()
    {
        $this->eventoServicio->ActualizarEventosFecha();
    }

    public function EventosAppXamarin($idUser)
    {
        $user = User::where("id","=",$idUser)->first();
        $idEmpreesa = $user->Sede->Empresa->id;
        $eventos=null;
        if($user->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
        }else{
            if($user->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
            }
        }
        return response()->json($eventos);
    }

    public function obtenerBoletaPromo($idEvento,$CodigoPromocional)
    {
        return response()->json($this->eventoServicio->obtenerBoletaPromo($idEvento,$CodigoPromocional));
    }
}
