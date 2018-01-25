<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Datos\Repositorio\CiudadRepositorio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Respuesta;

class EventosController extends Controller
{
    protected $ciudadRepo;
    protected $eventoSer;
    public function __construct(CiudadRepositorio $ciuRepor,EventosServicio $eventoSer)
    {
        $this->middleware('auth');
        $this->ciudadRepo =$ciuRepor;
        $this->eventoSer = $eventoSer;
    }


    public function obtenerFormularioEvento()
    {
        $departamentos = $this->ciudadRepo->obtenerDepartamentos();
        $formulario = array('departamentos' => $departamentos);
        return view('Evento/CrearEvento',['formulario' =>$formulario]);
    }

    public function crearEvento(Request $EdEvento)
    {
        if($this->eventoSer->crearEvento($EdEvento) )
        {
            return redirect('/home');
        }else{
            return redirect('/');
        }

    }


    public function obtenerCiudades($idDepartamento)//este metodo se tiene que mover  de esta clase
    {
        $ciudades = $this->ciudadRepo->obtenerCiudades($idDepartamento);
        // $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        //  dd($ciudades);
        return response()->json($ciudades);

    }

    public function obtenerListaAsistentes()
    {
        return view('Evento\ListaAsistente');
    }
}
