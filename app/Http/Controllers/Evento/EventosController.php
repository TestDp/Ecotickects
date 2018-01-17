<?php

namespace Ecotickets\Http\Controllers\Evento;

use Ecotickets\Datos\Modelos\Pregunta;
use Ecotickets\Datos\Modelos\Respuesta;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Ecotickets\Datos\Modelos\Departamento;
use Ecotickets\Datos\Modelos\Ciudad;
use Ecotickets\Datos\Modelos\Evento;

class EventosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function obtenerFormularioEvento()
    {
        $departamentos = Departamento::all();
        $formulario = array('departamentos' => $departamentos);
        return view('Evento\CrearEvento',['formulario' =>$formulario]);
    }

    public function crearEvento(Request $EdEvento)
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
        return redirect('/home');
    }


    public function obtenerCiudades($idDepartamento)
    {
        $ciudades = Ciudad::where('Departamento_id','=',$idDepartamento)->get();
        return response()->json($ciudades);
    }

}
