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

    
    public function ObtenerAsistentesXCiudadPago($idEvento)
    {
        $arrayNombresCiudades = array();
        $cantidadmaxima = 0;
        $arrayCantidadCiudades = array();
        $AsistentesCiudad = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
            ->join('Tbl_Ciudades', 'tbl_asistentes.Ciudad_id', '=', 'Tbl_Ciudades.id')
            ->join('Tbl_InfoPagos', function ($join) {
                $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
            })
            ->groupBy('Tbl_Ciudades.Nombre_Ciudad','Tbl_Ciudades.id')
            ->select('Tbl_Ciudades.Nombre_Ciudad','Tbl_Ciudades.id',DB::raw('count(Tbl_Ciudades.id) as cantidad'))
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
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

    public function RangoDeEdadesEvento($idEvento)
    {
        $arrayEdadesAsistentes = array();
        $cantidadmaxima = 0;
        $arrayCantidadEdadesAsistentes = array();
        $AsistentesEdades = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
            ->groupBy('tbl_asistentes.Edad')
            ->select('tbl_asistentes.Edad',DB::raw('count(tbl_asistentes.Edad) as cantidad'))
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->get();
        foreach ($AsistentesEdades as $asistenteEdad){
            $arrayEdadesAsistentes[]="Edad ".$asistenteEdad->Edad;
            $arrayCantidadEdadesAsistentes[]=$asistenteEdad->cantidad;
            if($cantidadmaxima < $asistenteEdad->cantidad)
            {
                $cantidadmaxima = $asistenteEdad->cantidad;
            }
        }
        $arrayEdadesAsistentes =array("LabelEdades"=>$arrayEdadesAsistentes,'Cantidad'=>$arrayCantidadEdadesAsistentes, 'Maximo'=>$cantidadmaxima);
        return $arrayEdadesAsistentes;
    }

    public function RangoDeEdadesEventoPago($idEvento)
    {
        $arrayEdadesAsistentes = array();
        $cantidadmaxima = 0;
        $arrayCantidadEdadesAsistentes = array();
        $AsistentesEdades = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
            ->join('Tbl_InfoPagos', function ($join) {
                $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
            })
            ->groupBy('tbl_asistentes.Edad')
            ->select('tbl_asistentes.Edad',DB::raw('count(tbl_asistentes.Edad) as cantidad'))
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->get();
        foreach ($AsistentesEdades as $asistenteEdad){
            $arrayEdadesAsistentes[]="Edad ".$asistenteEdad->Edad;
            $arrayCantidadEdadesAsistentes[]=$asistenteEdad->cantidad;
            if($cantidadmaxima < $asistenteEdad->cantidad)
            {
                $cantidadmaxima = $asistenteEdad->cantidad;
            }
        }
        $arrayEdadesAsistentes =array("LabelEdades"=>$arrayEdadesAsistentes,'Cantidad'=>$arrayCantidadEdadesAsistentes, 'Maximo'=>$cantidadmaxima);
        return $arrayEdadesAsistentes;
    }

    public function NumeroAsistentesXFecha($idEvento)
    {
        $arrayFechasAsistentes = array();
        $cantidadmaxima = 0;
        $arrayCantidadFechasAsistentes = array();
        $AsistentesEdades = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
           // ->groupBy('tbl_asistentes.Edad')
           ->select(DB::raw("DATE_FORMAT(tbl_asistentes.created_at, '%Y-%m-%d') as created_at"),DB::raw('count(tbl_asistentes.created_at) as cantidad'))
            ->groupBy('created_at')
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->get();
        foreach ($AsistentesEdades as $asistenteEdad){
            $arrayFechasAsistentes[]=$asistenteEdad->created_at;
            $arrayCantidadFechasAsistentes[]=$asistenteEdad->cantidad;
            if($cantidadmaxima < $asistenteEdad->cantidad)
            {
                $cantidadmaxima = $asistenteEdad->cantidad;
            }
        }
        $arrayFechasAsistentes =array("LabelFechas"=>$arrayFechasAsistentes,'Cantidad'=>$arrayCantidadFechasAsistentes, 'Maximo'=>$cantidadmaxima);
        return $arrayFechasAsistentes;
    }

    public function NumeroAsistentesXFechaPago($idEvento)
    {
        $arrayFechasAsistentes = array();
        $cantidadmaxima = 0;
        $arrayCantidadFechasAsistentes = array();
        $AsistentesEdades = DB::table('tbl_asistentesXeventos')
            ->join('tbl_asistentes', 'tbl_asistentesXeventos.Asistente_id','=','tbl_asistentes.id')
            // ->groupBy('tbl_asistentes.Edad')
            ->join('Tbl_InfoPagos', function ($join) {
                $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
            })
            ->select(DB::raw("DATE_FORMAT(tbl_asistentes.created_at, '%Y-%m-%d') as created_at"),DB::raw('count(tbl_asistentes.created_at) as cantidad'))
            ->groupBy('created_at')
            ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->get();
        foreach ($AsistentesEdades as $asistenteEdad){
            $arrayFechasAsistentes[]=$asistenteEdad->created_at;
            $arrayCantidadFechasAsistentes[]=$asistenteEdad->cantidad;
            if($cantidadmaxima < $asistenteEdad->cantidad)
            {
                $cantidadmaxima = $asistenteEdad->cantidad;
            }
        }
        $arrayFechasAsistentes =array("LabelFechas"=>$arrayFechasAsistentes,'Cantidad'=>$arrayCantidadFechasAsistentes, 'Maximo'=>$cantidadmaxima);
        return $arrayFechasAsistentes;
    }


    public function NumeroJuntas($idEvento)
    {
        return count( DB::table('tbl_asistentesXeventos')
       ->select(DB::raw('tbl_asistentesXeventos.ComentarioEvento'),DB::raw('count(tbl_asistentesXeventos.ComentarioEvento) as cantidad'))
        ->groupBy('tbl_asistentesXeventos.ComentarioEvento')
        ->where('tbl_asistentesXeventos.Evento_id','=',$idEvento)->distinct('tbl_asistentesXeventos.ComentarioEvento')
        ->get());
    }
    public function NumeroJuntasAsistentes($idEvento)
    {
        return count( DB::table('tbl_asistentesXeventos')
        ->select(DB::raw('tbl_asistentesXeventos.ComentarioEvento'),DB::raw('count(tbl_asistentesXeventos.ComentarioEvento) as cantidad'))
         ->groupBy('tbl_asistentesXeventos.ComentarioEvento')
         ->where([
            ['tbl_asistentesXeventos.Evento_id','=',$idEvento],
            ['tbl_asistentesXeventos.esActivo', '=', '1',]])
         ->distinct('tbl_asistentesXeventos.ComentarioEvento')
            ->havingRaw('cantidad > 1')
         ->get());
        
    }

    public function NumeroAsistentes($idEvento)
    {
        return count(AsistenteXEvento::where([
            ['Evento_id', '=', $idEvento],
            ['esActivo', '=', '1'],
        ])->get());
    }

    public function NumeroAsistentesPago($idEvento)
    {
        return  count(AsistenteXEvento::join('Tbl_InfoPagos', function ($join) {
            $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
        })
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->where('tbl_asistentesXeventos.esActivo', '=', 1)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->get());


    }

    // public function ObtnerCantidadAsistentes($idEvento)
    // {
    //     return count(AsistenteXEvento::where('Evento_id','=',$idEvento)->get());
    // }
   
}