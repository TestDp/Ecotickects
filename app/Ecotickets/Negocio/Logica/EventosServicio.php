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
        if($EdEvento->Nombre_Evento == "Evento123")
        {
            return false;
        }else{
            return $this->eventoRepor->crearEvento($EdEvento);
        }

    }

    public function obtenerEvento($idEvento)
    {
      return  $this->eventoRepor->obtenerEvento($idEvento);
    }
}