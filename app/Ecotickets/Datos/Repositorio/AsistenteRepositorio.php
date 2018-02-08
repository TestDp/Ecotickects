<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 26/01/2018
 * Time: 2:53 PM
 */

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Asistente;
use Eco\Datos\Modelos\AsistenteXEvento;
use Eco\Datos\Modelos\RespuestaAsistenteXEvento;
use Eco\Datos\Modelos\CodigoAsistente;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use Mail;

class AsistenteRepositorio
{

    public function registrarAsistente($registroAsistente)
    {
        $asistente = $this->ObtenerAsistente($registroAsistente ->Identificacion);
        if($asistente)
        {
            $asistente = $this->actualizarAsistente($asistente,new Asistente($registroAsistente->all()));
        }else{
            $asistente = new Asistente($registroAsistente->all());
        }

      $identificacionAsistente = $this->ObtenerAsistenteXEvento($registroAsistente ->Evento_id,$asistente->id);

     if($identificacionAsistente == null)
      {
          DB::beginTransaction();
        try{
            $asistente->save();
            $asistenteXeventoo = new AsistenteXEvento($registroAsistente->all());
            $asistenteXeventoo ->Asistente_id = $asistente->id;
            $asistenteXeventoo->save();
            foreach ($registroAsistente->Respuesta_id  as $respuestasAsistente)
            {
                $respuestasAsistenteXevento = new RespuestaAsistenteXEvento();
                $respuestasAsistenteXevento ->Respuesta_id =$respuestasAsistente;
                $respuestasAsistenteXevento ->AsistenteXEvento_id = $asistenteXeventoo->id;
                $respuestasAsistenteXevento ->save();
            }
            DB::commit();

        }catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return  false;
        }
        
        return true;

    }else{
         return  '2';// se devuelve 1 cuando el usuario ya se encuentra registrado
     }

    }

    public function obtenerAsistentesXEvento($idEvento)
    {
        $arrayAsistentes = array();
        $listaAsistentesEventos = AsistenteXEvento::where('Evento_id','=',$idEvento)->get();
        foreach ($listaAsistentesEventos as $asistente){
          $arrayAsistentes[]=Asistente::where('id','=',$asistente->Asistente_id)->first() ;
        }
        return $arrayAsistentes;
    }

    public function validarPIN($idPin)
    {
        $verificarPin = count(CodigoAsistente::where('Codigo','=',$idPin)->where('TipoCodigo', '=', 0)->get());
        if ($verificarPin == 0)
        {
            return false;
        }  
        return true;
    }

    public function ActualizarPin($ced, $idPin)
    {
            $pinActualizar = CodigoAsistente::where('Codigo','=',$idPin)->get()->first();
            $pinActualizar->Identificacion = $ced;
            $pinActualizar->TipoCodigo = '1';
            $pinActualizar->save();
            return true;
    }

    public function ObtnerCantidadAsistentes($idEvento)
    {
        return count(AsistenteXEvento::where('Evento_id','=',$idEvento)->get());
    }

    public function ObtenerAsistente($cc)
    {
        return Asistente::where('Identificacion','=',$cc)->get()->first();
    }
    public  function  actualizarAsistente($asistente,$asistenteRequest)
    {
        $asistente->telefono =  $asistenteRequest->telefono;
        $asistente->Email = $asistenteRequest->Email;
        $asistente->Edad = $asistenteRequest->Edad;
        $asistente->Dirección = $asistenteRequest->Dirección;
        $asistente->Ciudad_id = $asistenteRequest->Ciudad_id;
        return $asistente;
    }

    public  function ObtenerAsistenteXEvento($idEvento,$idAsistente)
    {
       return AsistenteXEvento::where('Evento_id','=',$idEvento)->where('Asistente_id','=',$idAsistente)->get()->first();
    }
}