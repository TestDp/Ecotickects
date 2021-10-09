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

    public function editarEvento($EdEvento)
    {
        return $this->eventoRepor->editarEvento($EdEvento);
    }

    public function obtenerBoletaPromo($idEvento, $codigo)
    {
        return  $this->eventoRepor->obtenerBoletaPromo($idEvento, $codigo);
    }

    public function obtenerLocalidadesEvento($idEvento)
    {
        return  $this->eventoRepor->obtenerLocalidadesEvento($idEvento);
    }

    public function obtenerEvento($idEvento)
    {
        return  $this->eventoRepor->obtenerEvento($idEvento);
    }

    public function obtenerSede($idSede)
    {
        return  $this->eventoRepor->obtenerSede($idSede);
    }

    public function obtenerEventoEditar($idEvento)
    {
        return  $this->eventoRepor->obtenerEventoEditar($idEvento);
    }

    public function obtenerEventos()
    {
        return $this->eventoRepor->ObtenerEventos();
    }

    public function obtenerEventosDestacados()
    {
        return $this->eventoRepor->obtenerEventosDestacados();
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

    public  function  ObtenerMisEventos($idUser)
    {
        return $this->eventoRepor->ObtenerMisEventos($idUser);
    }

    public  function  ObtenerMisSedes($idUser)
    {
        return $this->eventoRepor->ObtenerMisSedes($idUser);
    }
    public function ListaDeEventosSuperAdmin($idTipo){
        return $this->eventoRepor->ListaDeEventosSuperAdmin($idTipo);
    }

    public function ListaDeEventosSede($idSede,$idTipo)
    {
        return $this->eventoRepor->ListaDeEventosSede($idSede,$idTipo);
    }
    public function ListaDeEventosEmpresa($idEmpresa,$idTipo)
    {
        return $this->eventoRepor->ListaDeEventosEmpresa($idEmpresa,$idTipo);
    }
    public function ListaDeEventosPasadosEmpresa($idEmpresa,$idTipo)
    {
        return $this->eventoRepor->ListaDeEventosPasadosEmpresa($idEmpresa,$idTipo);
    }
    public function ListaDeEventosPasadosSede($idSede,$idTipo)
    {
        return $this->eventoRepor->ListaDeEventosPasadosSede($idSede,$idTipo);
    }
    public function obtenerLiquidacion($idEvento)
    {
        return $this->eventoRepor->obtenerLiquidacion($idEvento);
    }

    public function ObtenerInformePromotor($idEvento)
    {
        return $this->eventoRepor->ObtenerInformePromotor($idEvento);
    }

    public function ObtenerInformeUsuarioBoleta($idEvento)
    {
        return $this->eventoRepor->ObtenerInformeUsuarioBoleta($idEvento);
    }

    public function ListaDeEventosXUsuario($idUsuario)
    {
        return $this->eventoRepor->ListaDeEventosXUsuario($idUsuario);
    }

    public function ObtenerEventosUsuario($idUsuario){
        return $this->eventoRepor->ObtenerEventosUsuario($idUsuario);
    }

    public function ObtenerEventosUsuarioPasados($idUsuario){
        return $this->eventoRepor->ObtenerEventosUsuarioPasados($idUsuario);
    }


}