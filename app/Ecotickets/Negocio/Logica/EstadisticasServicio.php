<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 26/01/2018
 * Time: 2:52 PM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Repositorio\AsistenteRepositorio;
use Eco\Datos\Repositorio\EstadisticasRepositorio;


class EstadisticasServicio
{
    protected $asistenteRepositorio;
    protected $estadisticasRepositorio;
    public function __construct(AsistenteRepositorio $asistenteRepositorio, EstadisticasRepositorio $estadisticasRepositorio )
    {
        $this->asistenteRepositorio = $asistenteRepositorio;
        $this->estadisticasRepositorio = $estadisticasRepositorio;
    }

    
    // public function ObtnerCantidadAsistentes($idEvento)
    // {
    //     return $this->asistenteRepositorio->ObtnerCantidadAsistentes($idEvento);
    // }
    public function ObtenerAsistentesXCiudad($idEvento)
    {
        return $this->estadisticasRepositorio->ObtenerAsistentesXCiudad($idEvento);
    }

    public function RangoDeEdadesEvento($idEvento)
    {
        return $this->estadisticasRepositorio->RangoDeEdadesEvento($idEvento);
    }

    public function NumeroAsistentesXFecha($idEvento)
    {
        return $this->estadisticasRepositorio->NumeroAsistentesXFecha($idEvento);
    }

    public function NumeroJuntas($idEvento)
    {
        return $this->estadisticasRepositorio->NumeroJuntas($idEvento);
    }

    public function NumeroJuntasAsistentes($idEvento)
    {
        return $this->estadisticasRepositorio->NumeroJuntasAsistentes($idEvento);
    }
    public function NumeroAsistentes($idEvento)
    {
        return $this->estadisticasRepositorio->NumeroAsistentes($idEvento);
    }

    // public function ObtenerAsistente($cc)
    // {
    //     return $this->asistenteRepositorio->ObtenerAsistente($cc);
    // }
   
}