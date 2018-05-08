<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 8/05/2018
 * Time: 1:51 PM
 */

namespace Eco\Datos\Repositorio;
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;


class CuponesRepositorio
{

    public  function  ObtenerMisCupones($idUsuario)
    {
        $eventos = Evento::where('Tipo_Evento','=','Cupon')->where('user_id','=',$idUsuario)->get();
        foreach ($eventos as $evento)
        {
            $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
            $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
        }
        return $eventos;
    }
}