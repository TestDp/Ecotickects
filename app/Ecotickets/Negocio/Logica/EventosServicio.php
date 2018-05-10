<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 24/01/2018
 * Time: 4:45 PM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Repositorio\EventosRepositorio;


class EventosServicio
{

    protected $eventoRepor;
    public function __construct(EventosRepositorio $eventoRepor)
    {
        $this->eventoRepor = $eventoRepor;
    }

    public function crearEvento($EdEvento)
    {
            return $this->eventoRepor->crearEvento($EdEvento);

    }

    public function obtenerEvento($idEvento)
    {
      return  $this->eventoRepor->obtenerEvento($idEvento);
    }

    public function obtenerEventos()
    {
        return $this->eventoRepor->ObtenerEventos();
    }

    public function obtenerCupones()
    {
        return $this->eventoRepor->ObtenerCupones();
    }

    public function ActivarEventoPago($idEvento,$FlagEsActivo)
    {
        return $this->eventoRepor->ActivarEventoPago($idEvento,$FlagEsActivo);
    }

    public function ActivarTienda($idEvento,$FlagEsActivo)
    {
        return $this->eventoRepor->ActivarTienda($idEvento,$FlagEsActivo);
    }

    public function ActivarSolicitarPIN($idEvento,$FlagEsActivo)
    {
        return $this->eventoRepor->ActivarSolicitarPIN($idEvento,$FlagEsActivo);
    }

    public function ActivarEsPublico($idEvento,$FlagEsActivo)
    {
        return $this->eventoRepor->ActivarEsPublico($idEvento,$FlagEsActivo);
    }
}