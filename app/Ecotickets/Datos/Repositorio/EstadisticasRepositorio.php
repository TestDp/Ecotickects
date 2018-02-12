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

        
        $arrayAsistentesCiudad = array();
        $listaAsistentesEventos = AsistenteXEvento::where('Evento_id','=',$idEvento)->get();
        // foreach ($listaAsistentesEventos as $asistente){
        //   $arrayAsistentesCiudad[]=Asistente::select(DB::raw('count(*) as cantidad, CiudadId'))
        //         ->where('id','=',$asistente->Asistente_id)
        //         ->groupBy('Ciudad_id')
        //         ->get();
        
        // }
        return $arrayAsistentesCiudad;
    }

    // public function ObtnerCantidadAsistentes($idEvento)
    // {
    //     return count(AsistenteXEvento::where('Evento_id','=',$idEvento)->get());
    // }
   
}