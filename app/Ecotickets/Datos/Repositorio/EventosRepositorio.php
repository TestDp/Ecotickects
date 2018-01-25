<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 23/01/2018
 * Time: 4:17 PM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Respuesta;

class EventosRepositorio
{

    public function crearEvento($EdEvento)
    {
        //inicio del bloque donde se guarda el evento para obtener el id del evento
        $evento = new Evento($EdEvento->all());
        $evento ->save();
        //fin del bloque
        $ind =0;
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
        return true;
    }
}