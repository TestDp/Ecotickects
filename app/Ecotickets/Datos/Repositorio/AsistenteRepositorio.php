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
use Illuminate\Support\Facades\DB;

class AsistenteRepositorio
{

    public function registrarAsistente($registroAsistente)
    {
        DB::beginTransaction();
        try{
            $asistente = new Asistente($registroAsistente->all());
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
    }
}