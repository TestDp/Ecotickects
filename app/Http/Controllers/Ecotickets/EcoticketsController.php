<?php

namespace Ecotickets\Http\Controllers\Ecotickets;

use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Eco\Datos\Modelos\Pregunta;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Departamento;


class EcoticketsController extends Controller
{


    public  function  welcome()
    {
        return view('welcome');
    }
    public  function  ObtenerEventos()
    {
        $eventos = Evento::where('Tipo_Evento','=','Evento')->get();
        $ListaEventos = array('eventos' => $eventos);
        return view('Evento/ListaEventos',['ListaEventos' => $ListaEventos]);
    }

    public  function  ObtenerCupones()
    {
        $eventos = Evento::where('Tipo_Evento','=','Cupon')->get();
        $ListaEventos = array('eventos' => $eventos);
        return view('Evento/ListaCupones',['ListaEventos' => $ListaEventos]);
    }
    //metodo que me muestra el formulario del registro para el evento
    ///parametros:$idEvento -> id del evento en el cual se va a realizar el registro
    public function obtenerFormularioAsistente($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get();//se realiza la busqueda del evento en el cual se va a realizar el registro
        $preguntas = Pregunta::where('Evento_id','=',$idEvento)->get();// se realiza la busqueda de las preguntas relacionadas al evento
        $preguntas->each(function($preguntas){
            $preguntas ->respuestas;// se realiza la relacion de la respuestas de la preguntas del evento
        });
        $departamentos = Departamento::all();// se obtiene la lista de departamentos para mostrar en el formulario
        //dd($preguntas);
        $ElementosArray= array('evento' => $evento,'preguntas'=>$preguntas,'departamentos' => $departamentos,'EventoId'=>$idEvento);
        return view('Evento/RegistrarAsistente',['ElementosArray' =>$ElementosArray]);
    }



}
