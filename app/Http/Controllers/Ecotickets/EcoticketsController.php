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

        return view('welcome',['ListaEventos' => $ListaEventos], ['ListaEventosDestacados' => $ListaEventosDestacados] );
    }

    public  function  ObtenerCupones(EventosServicio $eventosServicio)
    {
        $eventos = $this->eventoServicio->obtenerCupones();
        $ListaEventos= array('eventos' => $eventos);
        return view('Evento/ListaEventos',['ListaEventos' => $ListaEventos]);
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
        //$CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $CantidadEsperada =$evento->numeroAsistentes;
        if($CantidadRegistrados<$CantidadEsperada && $this->eventoServicio->obtenerEvento($idEvento)->EsPublico ==true){
            $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
            $rutaImagenes=env('RutaFlyerEventoRegistrarAsistente');
            $ElementosArray= array('evento' => $evento,'departamentos' => $departamentos,'EventoId'=>$idEvento,'rutaImagenes'=>$rutaImagenes);
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

    //Metodo para obtener los productos activos para la tienda del evento
    //$idEvento: id o pk del evento
    public function  obtenerProductosXEvento($idEvento)
    {
        $productosXEventos = $this->productosServicio->obtenerProductosXEvento($idEvento);
        $rutaImagenes=env('RutaTiendaProducto').$productosXEventos['idUser'].'/';
        $ListaProductos = array('productos' => $productosXEventos['Productos'],'rutaImagenes'=>$rutaImagenes,'idEvento'=>$idEvento);
        return view('Tienda/TiendaEvento',$ListaProductos);
    }
}
