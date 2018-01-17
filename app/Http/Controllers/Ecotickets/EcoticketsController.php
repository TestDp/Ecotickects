<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Ecotickets\Datos\Modelos\Pregunta;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Ecotickets\Datos\Modelos\Evento;
use Ecotickets\Datos\Modelos\Departamento;

class EcoticketsController extends Controller
{

    public  function  ObtenerEventos()
    {
        $eventos = Evento::all();
        $ListaEventos = array('eventos' => $eventos);
        return view('welcome',['ListaEventos' => $ListaEventos]);
    }


    public function obtenerFormularioAsistente($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get();
        $departamentos = Departamento::all();
        $preguntas = Pregunta::where('Evento_id','=',$idEvento)->get();
        $preguntas->each(function($preguntas){
            $preguntas ->respuestas;
        });
        //dd($preguntas);
        $ElementosArray= array('evento' => $evento,'preguntas'=>$preguntas,'departamentos' => $departamentos);
        return view('Evento\RegistrarAsistente',['ElementosArray' =>$ElementosArray]);
    }
}
