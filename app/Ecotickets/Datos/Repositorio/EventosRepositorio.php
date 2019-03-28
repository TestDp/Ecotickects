<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 23/01/2018
 * Time: 4:17 PM
 */

namespace Eco\Datos\Repositorio;


use DateTime;
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\Departamento;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Respuesta;
use Eco\Datos\Modelos\PrecioBoleta;
use Illuminate\Support\Facades\DB;


class EventosRepositorio
{

    public function crearEvento($EdEvento)
    {
        DB::beginTransaction();
        try{

            //inicio del bloque donde se guarda el evento para obtener el id del evento
            $evento = new Evento($EdEvento->all());
            $evento->Fecha_Evento=new DateTime($EdEvento->Fecha_Evento . $EdEvento->Hora_Evento);
            $evento->Fecha_Inicial_Registro=new DateTime($EdEvento->Fecha_Inicial_Registro . $EdEvento->Hora_Inicial_Registro);
            $evento->Fecha_Final_Registro=new DateTime($EdEvento->Fecha_Final_Registro . $EdEvento->Hora_Final_Registro);
            $evento->activarTienda = false;
            //Asignamos el nombre del archivo
            if($EdEvento->ImagenFlyerEvento != null){
                $evento->FlyerEvento  = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
            }

            $evento ->save();
            $indPrecio =0;
            if($EdEvento->esPago == 1){
                foreach ($EdEvento->localidad as $localidad ){
                    $PrecioBoleta = new PrecioBoleta();
                    $PrecioBoleta ->localidad = $localidad;
                    $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                    $PrecioBoleta ->Evento_id = $evento -> id;
                    $PrecioBoleta ->cantidad = 1;
                    $PrecioBoleta ->save();
                    $indPrecio++;
                }

            }
            //fin del bloque
            $ind =0;
            //Validar si el array es vacio
            if($EdEvento->Enunciado)
            {
                // ciclo que recorre el arrya de enunciado para obtener el texto de las preguntas
                foreach ($EdEvento->Enunciado  as $EnunciadoPregunta)
                {
                    $Pregunta = new Pregunta();
                    $Pregunta ->Enunciado = $EnunciadoPregunta;
                    $Pregunta ->Evento_id = $evento -> id;
                    $Pregunta ->TipoPregunta_id = 1;//NOTA:SE DEBE GUARDAR DINAMICAMENTE
                    $Pregunta ->save();// se guarda la pregunta para obtner el id y poder relacionarlo con la respuesta
                    //se recorre el array en la posicion ind para sacar las respuestas relacionadas a las preguntas
                    foreach ($EdEvento->TextoRespuesta[$ind] as $EnunciadoRespuesta)
                    {
                        $Respuesta = new Respuesta();
                        $Respuesta ->EnunciadoRespuesta = $EnunciadoRespuesta;
                        $Respuesta ->Pregunta_id = $Pregunta->id;
                        $Respuesta ->save();// se guarda la respuesta
                    }
                    $ind++;

                }
            }

            DB::commit();
        }catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public function editarEvento($EdEvento)
    {
        DB::beginTransaction();
        try{

            //inicio del bloque donde se guarda el evento para obtener el id del evento
            $evento = Evento::find($EdEvento->id);
            $evento->Nombre_Evento = $EdEvento->Nombre_Evento;
            $evento->Tipo_Evento = $EdEvento->Tipo_Evento;
            $evento->SolicitarPIN = $EdEvento->SolicitarPIN;
            $evento->Ciudad_id = $EdEvento->Ciudad_id;
            $evento->Lugar_Evento = $EdEvento->Lugar_Evento;
            $evento->numeroAsistentes = $EdEvento->numeroAsistentes;
            $evento->EsPublico = $EdEvento->EsPublico;
            $evento->CorreoEnviarInvitacion = $EdEvento->CorreoEnviarInvitacion;
            $evento->CodigoPulep = $EdEvento->CodigoPulep;
            $evento->esPago = $EdEvento->esPago;
            $evento->informacionEvento = $EdEvento->informacionEvento;
            $evento->Fecha_Evento=new DateTime($EdEvento->Fecha_Evento . $EdEvento->Hora_Evento);
            $evento->Fecha_Inicial_Registro=new DateTime($EdEvento->Fecha_Inicial_Registro . $EdEvento->Hora_Inicial_Registro);
            $evento->Fecha_Final_Registro=new DateTime($EdEvento->Fecha_Final_Registro . $EdEvento->Hora_Final_Registro);
            $evento->activarTienda = false;
            //Asignamos el nombre del archivo
            if($EdEvento->ImagenFlyerEvento != null){
                $evento->FlyerEvento  = 'FlyerEvento_'.$EdEvento->Nombre_Evento.'.jpg';
            }
            $evento ->save();

            $indPrecio =0;
            if($EdEvento->esPago == 1){
                PrecioBoleta::where('Evento_id','=',$EdEvento->id)->delete();
                foreach ($EdEvento->localidad as $localidad ){
                    $PrecioBoleta = new PrecioBoleta();
                    $PrecioBoleta ->localidad = $localidad;
                    $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                    $PrecioBoleta ->Evento_id = $evento -> id;
                    $PrecioBoleta ->cantidad = 1;
                    $PrecioBoleta ->save();
                    $indPrecio++;
                }

            }else{
                PrecioBoleta::where('Evento_id','=',$EdEvento->id)->delete();
            }
            //fin del bloque
            $ind =0;
            //Validar si el array es vacio
            if($EdEvento->Enunciado)
            {
               $preguntas =  Pregunta::where('Evento_id','=',$EdEvento->id)->get();
               foreach ($preguntas as $pregunta){
                   Respuesta::where('Pregunta_id','=',$pregunta->id)->delete();
               }
                Pregunta::where('Evento_id','=',$EdEvento->id)->delete();
                // ciclo que recorre el array de enunciado para obtener el texto de las preguntas
                foreach ($EdEvento->Enunciado  as $EnunciadoPregunta)
                {
                    $Pregunta = new Pregunta();
                    $Pregunta ->Enunciado = $EnunciadoPregunta;
                    $Pregunta ->Evento_id = $evento -> id;
                    $Pregunta ->TipoPregunta_id = 1;//NOTA:SE DEBE GUARDAR DINAMICAMENTE
                    $Pregunta ->save();// se guarda la pregunta para obtner el id y poder relacionarlo con la respuesta
                    //se recorre el array en la posicion ind para sacar las respuestas relacionadas a las preguntas
                    foreach ($EdEvento->TextoRespuesta[$ind] as $EnunciadoRespuesta)
                    {
                        $Respuesta = new Respuesta();
                        $Respuesta ->EnunciadoRespuesta = $EnunciadoRespuesta;
                        $Respuesta ->Pregunta_id = $Pregunta->id;
                        $Respuesta ->save();// se guarda la respuesta
                    }
                    $ind++;

                }
            }else{
                $preguntas =  Pregunta::where('Evento_id','=',$EdEvento->id)->get();
                foreach ($preguntas as $pregunta){
                    Respuesta::where('Pregunta_id','=',$pregunta->id)->delete();
                }
                Pregunta::where('Evento_id','=',$EdEvento->id)->delete();
            }

            DB::commit();
        }catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }


    public function obtenerEvento($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get()->first();
        $evento->preguntas;
        $evento->preciosBoletas;
        $evento->preguntas->each(function($preguntas){
            $preguntas ->respuestas;// se realiza la relacion de la respuestas de la preguntas del evento
        });
        $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
        $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
        return $evento ;
    }

    public  function  ObtenerEventos()
    {
        $eventos = Evento::where('Tipo_Evento','=','Evento')->where('EsPublico','=',true)->orderBy('Fecha_Evento', 'ASC')->get();
        foreach ($eventos as $evento)
        {
            $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
            $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
        }
        return $eventos;
    }

    public  function  ObtenerEventosDestacados()
    {
        $eventos = Evento::where('Tipo_Evento','=','Evento')->where('EsPublico','=',true)
            ->where('CodigoPulep','=','12345')->orderBy('Fecha_Evento', 'ASC')->get();
        foreach ($eventos as $evento)
        {
            $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
            $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
        }
        return $eventos;
    }

    public  function  ObtenerCupones()
    {
        $cupones = Evento::where('Tipo_Evento','=','Cupon')->get();
        foreach ($cupones as $cupon)
        {
            $cupon->ciudad= Ciudad::where('id','=',$cupon ->Ciudad_id)->get()->first();
            $cupon->ciudad->departamento=Departamento::where('id','=',$cupon ->ciudad->Departamento_id)->get()->first();
        }
        return $cupones;
    }

    public function ActivarEventoPago($idEvento,$FlagEsActivo)
    {
        DB::beginTransaction();
        try{
            $evento = Evento::where('id','=',$idEvento)->get()->first();
            $evento->esPago = $FlagEsActivo;
            $evento ->save();
            DB::commit();
        }catch (\Exception $e)
        {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public function ActivarTienda($idEvento,$FlagEsActivo)
    {
        DB::beginTransaction();
        try{
            $evento = Evento::where('id','=',$idEvento)->get()->first();
            $evento->activarTienda = $FlagEsActivo;
            $evento ->save();
            DB::commit();
        }catch (\Exception $e)
        {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public function ActivarSolicitarPIN($idEvento,$FlagEsActivo)
    {
        DB::beginTransaction();
        try{
            $evento = Evento::where('id','=',$idEvento)->get()->first();
            $evento->SolicitarPIN = $FlagEsActivo;
            $evento ->save();
            DB::commit();
        }catch (\Exception $e)
        {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }
    public function ActivarEsPublico($idEvento,$FlagEsActivo)
    {
        DB::beginTransaction();
        try{
            $evento = Evento::where('id','=',$idEvento)->get()->first();
            $evento->EsPublico = $FlagEsActivo;
            $evento ->save();
            DB::commit();
        }catch (\Exception $e)
        {
            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        return true;
    }

    public  function  ObtenerMisEventos($idUser){
        $eventos = Evento::where("user_id","=",$idUser)->get();
        return $eventos;
    }
}