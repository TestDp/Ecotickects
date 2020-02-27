<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:09 AM
 */

namespace Eco\Negocio\Logica;




use Eco\Datos\Repositorio\SedeRepositorio;

class SedeServicio
{
    protected  $sedeRepositorio;
    public function __construct(SedeRepositorio $sedeRepositorio){
        $this->sedeRepositorio = $sedeRepositorio;
    }

    public  function GuardarSede($Sede){
        return $this->sedeRepositorio->GuardarSede($Sede);
    }
    public  function  ObtenerListaSedesSuperAdmin(){
        return $this->sedeRepositorio->ObtenerListaSedesSuperAdmin();
    }
    public  function  ObtenerListaSedesEmpresa($idEmpreesa)
    {
        return $this->sedeRepositorio->ObtenerListaSedesEmpresa($idEmpreesa);
    }

    public  function  ObtenerSede($idSede){
        return $this->sedeRepositorio->  ObtenerSede($idSede);
    }

}