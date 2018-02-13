<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 23/01/2018
 * Time: 4:17 PM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Asistente;
use Eco\Datos\Modelos\AsistenteXEvento;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Respuesta;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\Echo_;

class EstadisticasRepositorio
{


    // public  function  ObtenerAsistentesXCiudad($idEvento)
    // {
    //     $eventos = Evento::where('Tipo_Evento','=','Evento')->get();


    //     foreach ($eventos as $evento)
    //     {
    //        $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
    //        $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
    //     }

    //     $ListaEventos = array('eventos' => $eventos);
    //     return view('Evento/ListaEventos',['ListaEventos' => $ListaEventos]);
    // }

    
    public function ObtenerAsistentesXCiudad($idEvento)
    {
        $arrayNombresCiudades = array();
        $cantidadmaxima = 0;
        $arrayCantidadCiudades = array();
        $AsistentesCiudad = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
            ->join('Tbl_Ciudades', 'tbl_asistentes.Ciudad_id', '=', 'Tbl_Ciudades.id')
            ->groupBy('Tbl_Ciudades.Nombre_Ciudad','Tbl_Ciudades.id')
            ->select('Tbl_Ciudades.Nombre_Ciudad','Tbl_Ciudades.id',DB::raw('count(Tbl_Ciudades.id) as cantidad'))
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->get();
        foreach ($AsistentesCiudad as $asistente){
            $arrayNombresCiudades[]=$asistente->Nombre_Ciudad;
            $arrayCantidadCiudades[]=$asistente->cantidad;
            if($cantidadmaxima < $asistente->cantidad)
            {
                $cantidadmaxima = $asistente->cantidad;
            }
        }
        $arrayAsistentesCiudad =array("nombreCiudades"=>$arrayNombresCiudades,'Cantidad'=>$arrayCantidadCiudades, 'Maximo'=>$cantidadmaxima);
        return $arrayAsistentesCiudad;
    }

    // public function ObtnerCantidadAsistentes($idEvento)
    // {
    //     return count(AsistenteXEvento::where('Evento_id','=',$idEvento)->get());
    // }
   
}