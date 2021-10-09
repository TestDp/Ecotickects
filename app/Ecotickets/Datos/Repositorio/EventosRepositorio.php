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
use Eco\Datos\Modelos\PermisosUsuarioXEvento;
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
            $evento->CorreoEnviarInvitacion = env('CORREOENVIOTICKET');

            if($EdEvento->usoPromotor)
            {
                $evento->usoPromotor = $EdEvento->usoPromotor;
            }
            else{
                $evento->usoPromotor =0;
            }

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
                    $PrecioBoleta ->cantidad = $EdEvento->cantidad[$indPrecio];;
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
            return ["Respuesta"=>true,"idEvento"=>$evento->id];
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ["Respuesta"=>false,"idEvento"=>null];
        }
        return ["Respuesta"=>false,"idEvento"=>null];
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
            $evento->esActivo = 1;
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
                foreach ($EdEvento->localidad as $localidad ){
                    if($EdEvento->idPrecioBoleta[$indPrecio] == 0)
                    {
                        $PrecioBoleta = new PrecioBoleta();
                        $PrecioBoleta ->localidad = $localidad;
                        $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                        $PrecioBoleta ->esActiva = $EdEvento->Activa[$indPrecio];
                        $PrecioBoleta ->Evento_id = $evento ->id;
                        $PrecioBoleta ->cantidad = $EdEvento->cantidad[$indPrecio];
                        $PrecioBoleta ->save();
                        if($EdEvento->esPromo[$indPrecio]==1){
                            $precioBoletaPromo = new PrecioBoleta();
                            $precioBoletaPromo ->localidad = $localidad.'-Promo-'.$EdEvento->Porcentaje[$indPrecio];
                            $precioBoletaPromo ->precio = $this->CalcularPrecioBoletaPromo($EdEvento->precio[$indPrecio],$EdEvento->Porcentaje[$indPrecio]);
                            $precioBoletaPromo ->esActiva = $EdEvento->Activa[$indPrecio];
                            $precioBoletaPromo ->Evento_id = $evento ->id;
                            $precioBoletaPromo ->cantidad = $EdEvento->cantidad[$indPrecio];
                            $precioBoletaPromo ->esCodigoPromo = $EdEvento->esPromo[$indPrecio];
                            $precioBoletaPromo ->Codigo = $EdEvento->Codigo[$indPrecio];
                            $precioBoletaPromo ->Porcentaje = $EdEvento->Porcentaje[$indPrecio];
                            $precioBoletaPromo ->PrecioBoletaPadre_Id = $PrecioBoleta->id;
                            $precioBoletaPromo ->save();
                        }
                    }else{
                        $PrecioBoleta = PrecioBoleta::find($EdEvento->idPrecioBoleta[$indPrecio]);
                        $PrecioBoleta ->localidad = $localidad;
                        $PrecioBoleta ->precio = $EdEvento->precio[$indPrecio];
                        $PrecioBoleta ->esActiva = $EdEvento->Activa[$indPrecio];
                        $PrecioBoleta ->Evento_id = $evento ->id;
                        $PrecioBoleta ->cantidad = $EdEvento->cantidad[$indPrecio];
                        $PrecioBoleta ->save();
                        if($EdEvento->esPromo[$indPrecio] == 1 && $EdEvento->PrecioBoletaPadre_Id[$indPrecio] !=null){
                            $precioBoletaPromo = PrecioBoleta::find($EdEvento->PrecioBoletaPadre_Id[$indPrecio]);
                            $precioBoletaPromo ->localidad = $localidad.'-Promo-'.$EdEvento->Porcentaje[$indPrecio].'%';
                            $precioBoletaPromo ->precio = $this->CalcularPrecioBoletaPromo($EdEvento->precio[$indPrecio],$EdEvento->Porcentaje[$indPrecio]);
                            $precioBoletaPromo ->esActiva = $EdEvento->Activa[$indPrecio];
                            $precioBoletaPromo ->Evento_id = $evento ->id;
                            $precioBoletaPromo ->cantidad = $EdEvento->cantidad[$indPrecio];
                            $precioBoletaPromo ->esCodigoPromo = $EdEvento->esPromo[$indPrecio];
                            $precioBoletaPromo ->Codigo = $EdEvento->Codigo[$indPrecio];
                            $precioBoletaPromo ->Porcentaje = $EdEvento->Porcentaje[$indPrecio];
                            $precioBoletaPromo ->PrecioBoletaPadre_Id = $PrecioBoleta->id;
                            $precioBoletaPromo ->save();
                        }else if($EdEvento->esPromo[$indPrecio] == 0 && $EdEvento->PrecioBoletaPadre_Id[$indPrecio] !=null){
                            $precioBoletaPromo = PrecioBoleta::find($EdEvento->PrecioBoletaPadre_Id[$indPrecio]);
                            $precioBoletaPromo ->localidad = $localidad.'-Promo-'.$EdEvento->Porcentaje[$indPrecio].'%';
                            $precioBoletaPromo ->precio = $this->CalcularPrecioBoletaPromo($EdEvento->precio[$indPrecio],$EdEvento->Porcentaje[$indPrecio]);
                            $precioBoletaPromo ->esActiva = $EdEvento->Activa[$indPrecio];
                            $precioBoletaPromo ->Evento_id = $evento ->id;
                            $precioBoletaPromo ->cantidad = $EdEvento->cantidad[$indPrecio];
                            $precioBoletaPromo ->esCodigoPromo = $EdEvento->esPromo[$indPrecio];
                            $precioBoletaPromo ->Codigo = $EdEvento->Codigo[$indPrecio];
                            $precioBoletaPromo ->Porcentaje = $EdEvento->Porcentaje[$indPrecio];
                            $precioBoletaPromo ->PrecioBoletaPadre_Id = $PrecioBoleta->id;
                            $precioBoletaPromo ->save();
                        }
                        else if($EdEvento->esPromo[$indPrecio]==1) {
                            $precioBoletaPromo = new PrecioBoleta();
                            $precioBoletaPromo ->localidad = $localidad.'-Promo-'.$EdEvento->Porcentaje[$indPrecio].'%';
                            $precioBoletaPromo ->precio = $this-> CalcularPrecioBoletaPromo($EdEvento->precio[$indPrecio],$EdEvento->Porcentaje[$indPrecio]);
                            $precioBoletaPromo ->esActiva = $EdEvento->Activa[$indPrecio];
                            $precioBoletaPromo ->Evento_id = $evento ->id;
                            $precioBoletaPromo ->cantidad = $EdEvento->cantidad[$indPrecio];
                            $precioBoletaPromo ->esCodigoPromo = $EdEvento->esPromo[$indPrecio];
                            $precioBoletaPromo ->Codigo = $EdEvento->Codigo[$indPrecio];
                            $precioBoletaPromo ->Porcentaje = $EdEvento->Porcentaje[$indPrecio];
                            $precioBoletaPromo ->PrecioBoletaPadre_Id = $PrecioBoleta->id;
                            $precioBoletaPromo ->save();
                        }
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

    private function CalcularPrecioBoletaPromo($precioBase,$porcentaje){
        $precioBase= $precioBase-($precioBase*$porcentaje/100);
        return $precioBase;
    }

    public function obtenerBoletaPromo($idEvento, $codigo)
    {
        return $preciosBoletas = PrecioBoleta::where('Evento_id','=',$idEvento)
            ->where('esActiva','=',1)
            ->where('esCodigoPromo','=',1)
            ->where('Codigo','=',$codigo)->get();
    }

    public function obtenerLocalidadesEvento($idEvento)
    {
        return $preciosBoletas = PrecioBoleta::where('Evento_id','=',$idEvento)
            ->where('esActiva','=',1)
            ->where('esCodigoPromo','=',0)
            ->where('PrecioBoletaPadre_Id','=',null)->get();
    }

    public function  obtenerPrecioBoleta($idPrecioBoleta){
        return PrecioBoleta::where('id','=',$idPrecioBoleta)->get()->first();
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
        //insertar las variables de cantidad de boletas
        $evento->preciosBoletas = PrecioBoleta::where('Evento_id','=',$idEvento)
                                ->where('esActiva','=',1)
                                ->where('esCodigoPromo','=',0)
                                 ->where('PrecioBoletaPadre_Id','=',null)->get();
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
        $evento->preciosBoletas = DB::table('Tbl_PreciosBoletas')
            ->leftjoin('Tbl_PreciosBoletas as ph','Tbl_PreciosBoletas.id', '=', 'ph.PrecioBoletaPadre_Id')
            ->select('Tbl_PreciosBoletas.*','ph.esCodigoPromo', 'ph.Codigo', 'ph.Porcentaje', 'ph.id as idHijo')
            ->where('Tbl_PreciosBoletas.Evento_id', '=',$idEvento)
            ->where('Tbl_PreciosBoletas.esCodigoPromo', '=',0)
            ->where('Tbl_PreciosBoletas.PrecioBoletaPadre_Id', '=',null)->get();
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
            ->where('EsPublico','=',true)
            ->where('esActivo','=',true)
            ->where('Fecha_Evento','>',$fechaActual)
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
        $eventos = Evento::where('Tipo_Evento','=','Evento')
            ->where('EsPublico','=',true)
            ->where('esActivo','=',true)
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
            ->where('esActivo','=',true)
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
	//$eventos = Evento::find(1)->get();
        return $eventos;
    }

    public  function  ObtenerMisSedes($idUser){
        $usuario = User::where("id","=",$idUser)->get()->first();
        $sedes = Sede::where("id","=",$usuario->Sede_id)->get();
        return $sedes;
    }

    //retorna una lista de eventos y cupones para el rol de super admin
    public function ListaDeEventosSuperAdmin($idTipo)
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');
        $eventos = DB::table('Tbl_Eventos')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.esActivo', '=', 1)
            ->where('Tbl_Eventos.Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'asc')->get();
        return $eventos;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por Empresa  y por cupon o evento
    public function ListaDeEventosEmpresa($idEmpresa,$idTipo)
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Sedes.Empresa_id', '=', $idEmpresa)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.esActivo', '=', 1)
            ->where('Tbl_Eventos.Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'asc')->get();
        return $eventos;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por empresa  y por cupon o evento
    public function ListaDeEventosPasadosEmpresa($idEmpresa,$idTipo)
    {
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Sedes.Empresa_id', '=', $idEmpresa)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.esActivo', '=', 0)
            ->orderBy('Fecha_Evento', 'desc')->get();
        return $eventos;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por sede  y por cupon o evento
    public function ListaDeEventosSede($idSede,$idTipo)
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Sedes.id', '=', $idSede)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.esActivo', '=', 1)
            ->where('Tbl_Eventos.Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'asc')->get();
        return $eventos;
    }

    public function ObtenerEventosUsuario($idUser)
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->join('Tbl_Permisos_Usuarios_X_Evento', 'Tbl_Eventos.id', '=', 'Tbl_Permisos_Usuarios_X_Evento.Evento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Permisos_Usuarios_X_Evento.user_id', '=', $idUser)
            ->where('Tbl_Eventos.esActivo', '=', 1)
            ->where('Tbl_Eventos.Fecha_Evento','>',$fechaActual)
            ->orderBy('Fecha_Evento', 'asc')->get();
        return $eventos;
    }

    public function ObtenerEventosUsuarioPasados($idUser)
    {
        $fechaActual = new DateTime('today');
        $fechaActual->modify('-1 day');
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->join('Tbl_Permisos_Usuarios_X_Evento', 'Tbl_Eventos.id', '=', 'Tbl_Permisos_Usuarios_X_Evento.Evento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('users.id', '=', $idUser)
            ->where('Tbl_Eventos.esActivo', '=', 0)
            ->orderBy('Fecha_Evento', 'DESC')->get();
        return $eventos;
    }

    //retorna una lista de eventos y cupones filtrados por sede  filtrados por sede  y por cupon o evento
    public function ListaDeEventosPasadosSede($idSede,$idTipo)
    {
        $eventos = DB::table('Tbl_Eventos')
            ->join('users', 'users.id', '=', 'Tbl_Eventos.user_id')
            ->join('Tbl_Sedes', 'Tbl_Sedes.id', '=', 'users.Sede_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'Tbl_Eventos.Ciudad_id')
            ->join('Tbl_Departamentos', 'Tbl_Departamentos.id', '=', 'Tbl_Ciudades.Departamento_id')
            ->select('Tbl_Eventos.*','Tbl_Ciudades.Nombre_Ciudad','Tbl_Departamentos.Nombre_Departamento' )
            ->where('Tbl_Sedes.id', '=', $idSede)
            ->where('Tbl_Eventos.Tipo_Evento', '=', $idTipo)
            ->where('Tbl_Eventos.esActivo', '=', 0)
            ->orderBy('Fecha_Evento', 'desc')->get();
        return $eventos;
    }


    //retorna una lista de etapas y la liquidacion neta restando el porcentajes y commisiones
    public function obtenerLiquidacion($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get()->first();
        $etapas = DB::table('Tbl_ConfiguracionXSedes')
            ->select(DB::Raw('resul.* , concat(cast((Tbl_ConfiguracionXSedes.Porcentaje * 100) as decimal(12,1)),"%")  as Porcentaje,
        cast(Tbl_ConfiguracionXSedes.comision1 + Tbl_ConfiguracionXSedes.comision2 as decimal(12,0)) as ComisionXBoleta,
        (resul.TotalEtapa - (resul.TotalEtapa * Tbl_ConfiguracionXSedes.Porcentaje) - (Tbl_ConfiguracionXSedes.comision1 + Tbl_ConfiguracionXSedes.comision2) * resul.cantidadBoletas) as Total'))

            ->join(DB::raw('(SELECT e.Nombre_Evento as Nombre_Evento,(case when p.MediosDePago_id = 2 then 1 else 0 end) 
                    as EsTC ,u.Sede_id AS Sede_id,p.PrecioTotal/p.CantidadBoletas AS PrecioEtapa,sum(CantidadBoletas) AS CantidadBoletas,  sum(PrecioTotal) AS TotalEtapa
                    from tbl_asistentesXeventos as ae
                    inner join tbl_asistentes as a
                    on ae.Asistente_id = a.id
                    inner join Tbl_Ciudades as c
                    on a.Ciudad_id = c.id
                    inner join Tbl_InfoPagos as p
                    on ae.id = p.AsistenteXEvento_id
                    inner join Tbl_Eventos as e
                    on ae.Evento_id = e.id
                    inner join users as u
                    on e.user_id = u.id
                    where Evento_id = ' . $evento->id . ' and EstadosTransaccion_id = 4
                    group by  e.Nombre_Evento,case when p.MediosDePago_id = 2 then 1 else 0 end, u.Sede_id, p.precioTotal/cantidadBoletas) resul'),
                function($join)
                {

                    $join->on('resul.PrecioEtapa','>','Tbl_ConfiguracionXSedes.PrecioMinimo')
                        ->on('resul.PrecioEtapa','<=','Tbl_ConfiguracionXSedes.PrecioMaximo')
                    ->on('resul.Sede_id','=','Tbl_ConfiguracionXSedes.Sede_id')
                    ->on('resul.EsTC','=','Tbl_ConfiguracionXSedes.EsTC');
                })

            ->get();

        $etapas->TotalGeneral =  $etapas->sum('Total');
        $etapas->CantidadTotal =  $etapas->sum('CantidadBoletas');
        $etapas->idEvento = $idEvento;
        $etapas->evento = $evento;

        return $etapas;
    }



    //retorna los eventos a los que tienen permisos los usuarios creados por el adminitrador u Organizador
    public function ListaDeEventosXUsuario($idUsuario)
    {
        $eventos = PermisosUsuarioXEvento::where('user_id','=',$idUsuario)->get();
        return $eventos;
    }

    //retorna una lista de etapas y las boletas distinguida por promotor
    public function ObtenerInformePromotor($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get()->first();

        $promotorBoletas = DB::table(
        DB::raw('(SELECT e.Nombre_Evento as Nombre_Evento ,u.Sede_id AS Sede_id,p.PrecioTotal/p.CantidadBoletas AS PrecioEtapa,
                     concat(ap.nombres, concat(\' \' , ap.apellidos) ) as Promotor,sum(CantidadBoletas) AS CantidadBoletas,  sum(PrecioTotal) AS TotalEtapa
                    from tbl_asistentesXeventos as ae
                    inner join tbl_asistentes as a
                    on ae.Asistente_id = a.id
                    inner join Tbl_Ciudades as c
                    on a.Ciudad_id = c.id
                    inner join Tbl_InfoPagos as p
                    on ae.id = p.AsistenteXEvento_id
                    inner join Tbl_Eventos as e
                    on ae.Evento_id = e.id
                    inner join users as u
                    on e.user_id = u.id
                    inner join tbl_asistentes as ap
                    on ae.promotor_id = ap.id
                    where Evento_id = 101 and
                    EstadosTransaccion_id = 4
                     group by  e.Nombre_Evento, u.Sede_id, p.precioTotal/cantidadBoletas, concat(ap.nombres, concat(\' \', ap.apellidos) )
                     order by concat(ap.nombres, concat(\' \' , ap.apellidos) )  asc) AS Resul') )
        ->where('CantidadBoletas','>',0)
        ->get();

            $promotorBoletas->CantidadTotal =  $promotorBoletas->sum('CantidadBoletas');
            $promotorBoletas->Total =  $promotorBoletas->sum('TotalEtapa');
            $promotorBoletas->idEvento = $idEvento;
            $promotorBoletas->evento = $evento;




        return $promotorBoletas;
    }

    //retorna una lista de etapas y las boletas distinguida por promotor
    public function ObtenerInformeUsuarioBoleta($idEvento)
    {
        $evento = Evento::where('id','=',$idEvento)->get()->first();

        $usuarioBoletas = DB::table(
            DB::raw('(SELECT e.Nombre_Evento as Nombre_Evento,u.Sede_id AS Sede_id,up.name as Promotor, 
        p.PrecioTotal/p.CantidadBoletas AS PrecioEtapa,sum(CantidadBoletas) AS CantidadBoletas, sum(PrecioTotal) AS TotalEtapa
                    from tbl_asistentesXeventos as ae
                    inner join tbl_asistentes as a
                    on ae.Asistente_id = a.id
                    inner join Tbl_Ciudades as c
                    on a.Ciudad_id = c.id
                    inner join Tbl_InfoPagos as p
                    on ae.id = p.AsistenteXEvento_id
                    inner join Tbl_Eventos as e
                    on ae.Evento_id = e.id
                    inner join users as u
                    on e.user_id = u.id
                    inner join Tbl_Usuarios_X_AsistenteEvento as ue
                    on ae.id = ue.AsistentesXEvento_id
                    inner join users as up
                    on  up.id = ue.user_id 
                    where Evento_id = ' . $evento->id . ' and EstadosTransaccion_id = 4
                    group by  e.Nombre_Evento, u.Sede_id, p.precioTotal/cantidadBoletas, up.name
                    order by up.name asc) AS Resul') )
            ->where('CantidadBoletas','>',0)
            ->get();

        $usuarioBoletas->CantidadTotal =  $usuarioBoletas->sum('CantidadBoletas');
        $usuarioBoletas->Total =  $usuarioBoletas->sum('TotalEtapa');
        $usuarioBoletas->idEvento = $idEvento;
        $usuarioBoletas->evento = $evento;




        return $usuarioBoletas;
    }

}