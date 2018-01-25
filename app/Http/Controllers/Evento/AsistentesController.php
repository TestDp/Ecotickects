<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Datos\Modelos\Asistente;
use Eco\Datos\Modelos\AsistenteXEvento;
use Eco\Datos\Modelos\RespuestaAsistenteXEvento;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;

class AsistentesController extends Controller
{


    public function registrarAsistente(Request $formRegistro)
    {
       //dd($formRegistro);
        $asistente = new Asistente($formRegistro->all());
        $asistente->save();
        $asistenteXeventoo = new AsistenteXEvento($formRegistro->all());
        $asistenteXeventoo ->Asistente_id = $asistente->id;
        $asistenteXeventoo->save();
        foreach ($formRegistro->Respuesta_id  as $respuestasAsistente)
        {
            $respuestasAsistenteXevento = new RespuestaAsistenteXEvento();
            $respuestasAsistenteXevento ->Respuesta_id =$respuestasAsistente;
            $respuestasAsistenteXevento ->AsistenteXEvento_id = $asistenteXeventoo->id;
            $respuestasAsistenteXevento ->save();
        }
        return redirect('/');
    }

}
