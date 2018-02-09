<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 26/01/2018
 * Time: 2:52 PM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Repositorio\AsistenteRepositorio;


class AsistenteServicio
{
    protected $asistenteRepositorio;
    public function __construct(AsistenteRepositorio $asistenteRepositorio)
    {
        $this->asistenteRepositorio = $asistenteRepositorio;
    }

    public function registrarAsistente($asistente)
    {
        return $this->asistenteRepositorio->registrarAsistente($asistente);
    }

    public function obtenerAsistentesXEvento($idEvento)
    {
        return $this->asistenteRepositorio->obtenerAsistentesXEvento($idEvento);
    }

    public function validarPIN($idPin)
    {
        return $this->asistenteRepositorio->validarPIN($idPin);
    }
    public function ActualizarPin($ced,$idPin)
    {
        return $this->asistenteRepositorio->ActualizarPin($ced,$idPin);
    }

    public function ObtnerCantidadAsistentes($idEvento)
    {
        return $this->asistenteRepositorio->ObtnerCantidadAsistentes($idEvento);
    }

    public function ObtenerAsistente($cc)
    {
        return $this->asistenteRepositorio->ObtenerAsistente($cc);
    }
}