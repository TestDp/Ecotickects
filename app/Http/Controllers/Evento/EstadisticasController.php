<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\EstadisticasServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class EstadisticasController extends Controller
{
    protected $asistenteServicio;
    protected $eventoServicio;
    protected $estadisticasServicio;
    


    public function __construct( EstadisticasServicio $estadisticasServicio,AsistenteServicio $asistenteServicio,EventosServicio $eventoServicio)
    {
        $this->estadisticasServicio = $estadisticasServicio;
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
    }

    // public function ObtnerCantidadAsistentes($idEvento)
    // {
    //     $CantidadRegistrados = $this -> asistenteServicio ->ObtnerCantidadAsistentes($idEvento);
    //     $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
    //     $cantidadAsistentes = ['CantidadEsperada'=>$CantidadEsperada,'CantidadRegistrados'=>$CantidadRegistrados];
    //     return response()->json($cantidadAsistentes);
    // }
    
    public function ObtenerAsistentesXCiudad($idEvento)
    {
        $cantidadAsistentesXciudad = $this -> estadisticasServicio ->ObtenerAsistentesXCiudad($idEvento);
        return response()->json($cantidadAsistentesXciudad);
        
    }
}