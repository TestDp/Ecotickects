<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\EstadisticasServicio;
use Eco\Negocio\Logica\EventosServicio;
use Ecotickets\Http\Controllers\Controller;



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
    public function RangoDeEdadesEvento($idEvento)
    {
        $cantidadEdadAsistentes = $this -> estadisticasServicio ->RangoDeEdadesEvento($idEvento);
        return response()->json($cantidadEdadAsistentes);
    }

    public function NumeroAsistentesXFecha($idEvento)
    {
        $cantidadEdadAsistentes = $this -> estadisticasServicio ->NumeroAsistentesXFecha($idEvento);
        return response()->json($cantidadEdadAsistentes);
    }

    
    public function NumeroJuntasAsistentes($idEvento)
    {
        $cantidadJuntas = $this -> estadisticasServicio ->NumeroJuntas($idEvento);
        $cantidadJuntasAsistentes = $this -> estadisticasServicio ->NumeroJuntasAsistentes($idEvento);
        $cantidadJuntascomparar = ['Cantidadtotal'=>$cantidadJuntas,'CantidadAsistentes'=>$cantidadJuntasAsistentes];
        
        return response()->json($cantidadJuntascomparar);
    }

    public function EstadisticasApp($idEvento)
    {
        $CantidadRegistrados = $this -> asistenteServicio ->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $CantidadAsistentes = $this->estadisticasServicio-> NumeroAsistentes($idEvento);
        $cantidadAsistentes = ['CantidadEsperada'=>$CantidadEsperada,'CantidadRegistrados'=>$CantidadRegistrados,'CantidadAsistentes'=>$CantidadAsistentes];
        $cantidadJuntas = $this -> estadisticasServicio ->NumeroJuntas($idEvento);
        $cantidadJuntasAsistentes = $this -> estadisticasServicio ->NumeroJuntasAsistentes($idEvento);
        $cantidadJuntascomparar = ['Cantidadtotal'=>$cantidadJuntas,'CantidadAsistentes'=>$cantidadJuntasAsistentes];
        $numeroDeAsistentesXFecha = $this -> estadisticasServicio ->NumeroAsistentesXFecha($idEvento);
        $RangoEdadAsistentes = $this -> estadisticasServicio ->RangoDeEdadesEvento($idEvento);
        $cantidadAsistentesXciudad = $this -> estadisticasServicio ->ObtenerAsistentesXCiudad($idEvento);
        $estadisticas = ['cantidadAsistentes' =>$cantidadAsistentes,
            'cantidadJuntascomparar'=>$cantidadJuntascomparar,
            'numeroDeAsistentesXFecha'=>$numeroDeAsistentesXFecha,
            'rangoEdadAsistentes'=>$RangoEdadAsistentes,
            'cantidadAsistentesXciudad'=>$cantidadAsistentesXciudad];
        return response()->json($estadisticas);
    }

}