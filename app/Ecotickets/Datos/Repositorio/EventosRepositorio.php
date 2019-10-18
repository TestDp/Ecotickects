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
use Eco\Datos\Modelos\PromotoresXSede;
use Eco\Datos\Modelos\Respuesta;
use Eco\Datos\Modelos\PrecioBoleta;
use Eco\Datos\Modelos\Sede;
use Illuminate\Support\Facades\DB;
use Ecotickets\User;


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
                    $PrecioBoleta ->esActiva = 1;
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
               // PrecioBoleta::where('Evento_id','=',$EdEvento->id)->delete();
                foreach ($EdEvento->localidad as $localidad ){
                    if($EdEvento->idPrecioBoleta[$indPrecio] == 0)
                    {
                        $PrecioBoleta = new PrecioBoleta();
                        $PrecioBoleta ->localidad = $localidad;
                        $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                        $PrecioBoleta ->esActiva = $EdEvento->Activa[$indPrecio];
                        $PrecioBoleta ->Evento_id = $evento -> id;
                        $PrecioBoleta ->cantidad = 1;
                        $PrecioBoleta ->save();
                    }else{
                        $PrecioBoleta = PrecioBoleta::find($EdEvento->idPrecioBoleta[$indPrecio]);
                        $PrecioBoleta ->localidad = $localidad;
                        $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                        $PrecioBoleta ->esActiva = $EdEvento->Activa[$indPrecio];
                        $PrecioBoleta ->Evento_id = $evento -> id;
                        $PrecioBoleta ->cantidad = 1;
                        $PrecioBoleta ->save();
                    }
                    $indPrecio++;
                }
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
        $user1 = User::where ('id', '=', $evento->user_id)->get()->first();

        $promo = DB::table('Tbl_PromotoresXSedes')
            ->join('tbl_asistentes', 'tbl_asistentes.id', '=', 'Tbl_PromotoresXSedes.Asistente_id')
            ->select('tbl_asistentes.*','Tbl_PromotoresXSedes.id' )
            ->where('Tbl_PromotoresXSedes.Sede_id', '=', $user1->Sede_id)->get();




        $evento->promotores = $promo;
        $evento->preciosBoletas = PrecioBoleta::where('Evento_id','=',$idEvento)
                                ->where('esActiva','=',1)->get();
        $evento->preguntas->each(function($preguntas){
            $preguntas ->respuestas;// se realiza la relacion de la respuestas de la preguntas del evento
        });
        $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
        $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
        return $evento ;
    }

    public function obtenerSede($idSede)
    {
        $sede = Sede::where('id','=',$idSede)->get()->first();

        return $sede;
    }


    public function obtenerEventoEditar($idEvento)
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
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');

        $eventos = Evento::where('Tipo_Evento','=','Evento')
            ->where('EsPublico','=',true)->where('Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'ASC')->get();
        foreach ($eventos as $evento)
        {
            $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
            $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
            $timestamp = strtotime($evento->Fecha_Evento);
            $evento->Fecha_Evento = date(" d/m/y  h.i A", $timestamp);
        }
        return $eventos;
    }

    public  function  ObtenerEventosDestacados()
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');

        $eventos = Evento::where('Tipo_Evento','=','Evento')->where('EsPublico','=',true)
            ->where('CodigoPulep','=','12345')
            ->where('Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'ASC')->get();
        foreach ($eventos as $evento)
        {
            $evento->ciudad= Ciudad::where('id','=',$evento ->Ciudad_id)->get()->first();
            $evento->ciudad->departamento=Departamento::where('id','=',$evento ->ciudad->Departamento_id)->get()->first();
            $timestamp = strtotime($evento->Fecha_Evento);
            $evento->Fecha_Evento = date("d/m/y  h.i A", $timestamp);
        }
        return $eventos;
    }

    public  function  ObtenerCupones()
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');

        $cupones = Evento::where('Tipo_Evento','=','Cupon')
            ->where('EsPublico','=',true)
            ->where('Fecha_Evento','>',$fechaActual)->get();
        $FechaActual = new DateTime();
        foreach ($cupones as $cupon)
        {
            $cupon->ciudad= Ciudad::where('id','=',$cupon ->Ciudad_id)->get()->first();
            $cupon->ciudad->departamento=Departamento::where('id','=',$cupon ->ciudad->Departamento_id)->get()->first();
            $fechaEvento = new DateTime($cupon->Fecha_Evento);
            $diferencia =  $FechaActual->diff($fechaEvento);
            $timestamp = strtotime($cupon->Fecha_Evento);
            $cupon->Fecha_Evento = date(" d/m/y  h.i A", $timestamp);
            $cupon->Plazo = $diferencia->days;

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

    public  function  ObtenerMisSedes($idUser){
        $usuario = User::where("id","=",$idUser)->get()->first();

        $sedes = Sede::where("id","=",$usuario->Sede_id)->get();

        return $sedes;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por sede  y por cupon o evento
    public function ListaDeEventosSede($idSede,$idTipo)
    {
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->select('Tbl_Eventos.*')
            ->where('Tbl_Sedes.id', '=', $idSede)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.EsPublico', '=', 1)
            ->orderBy('Fecha_Evento', 'ASC')
            //->orderBy('Tbl_Facturas.id')
            ->latest()
            ->paginate(10);
        return $eventos;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por sede  y por cupon o evento
    public function ListaDeEventosPasadosSede($idSede,$idTipo)
    {
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->select('Tbl_Eventos.*')
            ->where('Tbl_Sedes.id', '=', $idSede)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.EsPublico', '=', 0)
            ->orderBy('Fecha_Evento', 'DESC')
            //->orderBy('Tbl_Facturas.id')
            ->latest()
            ->paginate(10);
        return $eventos;
    }

    public function  ActualizarEventosFecha()
    {
        DB::statement("CALL SpActualizarEventos()");
        $actualiza = 1;

       // Update `Tbl_Eventos`
        //set EsPublico = 0
        // WHERE Fecha_Evento < now()
    }


}