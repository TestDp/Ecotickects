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
use Eco\Datos\Modelos\Ciudad;
use Eco\Datos\Modelos\InfoPago;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\PrecioBoleta;
use Eco\Datos\Modelos\PromotoresXSede;
use Eco\Datos\Modelos\RespuestaAsistenteXEvento;
use Eco\Datos\Modelos\CodigoAsistente;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;


class AsistenteRepositorio
{
    //Metodo que registra a una asistente  cuando el evento no tiene costo
    public function registrarAsistente($registroAsistente, $invitacion)
    {
        $asistente = $this->ObtenerAsistente($registroAsistente->Identificacion);
        if ($asistente) {
            $asistente = $this->actualizarAsistente($registroAsistente->Identificacion, new Asistente($registroAsistente->all()));
        } else {
            $asistente = new Asistente($registroAsistente->all());
        }
        $identificacionAsistente = $this->ObtenerAsistenteXEvento($registroAsistente->Evento_id, $asistente->id);
        if ($identificacionAsistente == null) {
            DB::beginTransaction();
            try {
                $asistente->save();
                $asistenteXeventoo = new AsistenteXEvento($registroAsistente->all());
                $asistenteXeventoo->Asistente_id = $asistente->id;
                $asistenteXeventoo->Promotor_id = 1;
                $asistenteXeventoo->esPago = 0;
                if ($invitacion) {
                    $asistenteXeventoo->PinBoleta = $asistente->Identificacion;
                } else {
                    $asistenteXeventoo->PinBoleta = 0;
                }
                $asistenteXeventoo->save();
                if ($registroAsistente->Respuesta_id) {
                    foreach ($registroAsistente->Respuesta_id as $respuestasAsistente) {
                        $respuestasAsistenteXevento = new RespuestaAsistenteXEvento();
                        $respuestasAsistenteXevento->Respuesta_id = $respuestasAsistente;
                        $respuestasAsistenteXevento->AsistenteXEvento_id = $asistenteXeventoo->id;
                        $respuestasAsistenteXevento->save();
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                DB::rollback();
                dd($error);
                return $error;
            }
            return true;
        } else {
            return '2';// se devuelve 1 cuando el usuario ya se encuentra registrado
        }
    }

    //Metodo que registra a una asistente  cuando el evento  tiene costo
    public function registrarAsistentePago($registroAsistente)
    {
        $asistente = $this->ObtenerAsistente($registroAsistente->Identificacion);
        $infoPago = '';
        $infoComprador ='';
        if ($asistente) {
            $asistente = $this->actualizarAsistente($registroAsistente->Identificacion, new Asistente($registroAsistente->all()));
        } else {
            $asistente = new Asistente($registroAsistente->all());
        }
        DB::beginTransaction();
        try {
            $asistente->save();
            for ($i = 0; $i < $registroAsistente->CantidadTickets; $i++) {
                $asistenteXeventoo = new AsistenteXEvento($registroAsistente->all());
                $asistenteXeventoo->Asistente_id = $asistente->id;
                if($registroAsistente->Promotor_id)
                {
                    $asistenteXeventoo->Promotor_id = $registroAsistente->Promotor_id;
                }
                else{
                    $asistenteXeventoo->Promotor_id =1;
                }
                $asistenteXeventoo->PinBoleta = $this->GenerarPin();
                //pone el mismo id en elcampo idcomprador si es solo un tickets
                // si son vario le pone a los demas el idcomprador con el id del padre
                if ($i != 0) {
                    $asistenteXeventoo->idAsistenteCompra = $infoComprador;
                }
                ////
                $asistenteXeventoo->save();
                if ($registroAsistente->Respuesta_id && $i == 0) {
                    foreach ($registroAsistente->Respuesta_id as $respuestasAsistente) {
                        $respuestasAsistenteXevento = new RespuestaAsistenteXEvento();
                        $respuestasAsistenteXevento->Respuesta_id = $respuestasAsistente;
                        $respuestasAsistenteXevento->AsistenteXEvento_id = $asistenteXeventoo->id;
                        $respuestasAsistenteXevento->save();
                    }
                }
                if ($i == 0) {
                    $infoPago = $this->crearInfoPago($registroAsistente);
                    $infoPago->AsistenteXEvento_id = $asistenteXeventoo->id;
                    $infoPago->save();
                    //setea este valor con el id del comprador padre
                    $infoComprador = $asistenteXeventoo->id;
                }
            }
            DB::commit();
            return ['respuesta' => true, 'infoPago' => $infoPago];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
        return ['respuesta' => false, 'error' => 'hubo un error guardando'];
    }

    public function obtenerAsistentesXEvento($idEvento)
    {
        $listaAsistentesEventos = DB::table('tbl_asistentes')
            ->join('tbl_asistentesXeventos', 'tbl_asistentes.id', '=', 'tbl_asistentesXeventos.Asistente_id')
            ->join('Tbl_Ciudades','Tbl_Ciudades.id','=','tbl_asistentes.Ciudad_id')
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->select(\DB::raw('tbl_asistentesXeventos.esActivo, tbl_asistentes.id,  tbl_asistentes.Nombres, tbl_asistentes.Apellidos, tbl_asistentes.Identificacion, tbl_asistentes.telefono, tbl_asistentes.Email, tbl_asistentes.Edad, tbl_asistentes.Dirección, tbl_asistentes.Ciudad_id, "0" as CantidadBoletas, "0" as PrecioTotal, "Gratis" as TipoBoleta' ))
            ->get();
        return $listaAsistentesEventos;
    }

    public function obtenerAsistentesXEventoGuessList($idEvento)
    {
        $asistentesGuestList = DB::table('tbl_asistentes')
            ->join('tbl_asistentesXeventos', 'tbl_asistentes.id', '=', 'tbl_asistentesXeventos.Asistente_id')
            ->join('Tbl_Ciudades', 'Tbl_Ciudades.id', '=', 'tbl_asistentes.Ciudad_id')
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->where('tbl_asistentesXeventos.ComentarioEvento', '=', "BoletaGratis123")
            ->select(\DB::raw('tbl_asistentesXeventos.esActivo, tbl_asistentes.id,  tbl_asistentes.Nombres, tbl_asistentes.Apellidos, tbl_asistentes.Identificacion, tbl_asistentes.telefono, tbl_asistentes.Email, tbl_asistentes.Edad, tbl_asistentes.Dirección, Tbl_Ciudades.Nombre_Ciudad,  "Gratis" as TipoBoleta' ))
            ->orderBy('tbl_asistentes.id', 'DESC')
            ->get();
        return $asistentesGuestList;
    }

    public function obtenerAsistentesXEventoPago($idEvento)
    {
        $arrayAsistentes = array();
        $asistentesPago = DB::table('tbl_asistentes')
            ->join('tbl_asistentesXeventos', 'tbl_asistentes.id', '=', 'tbl_asistentesXeventos.Asistente_id')
            ->join('Tbl_Ciudades','Tbl_Ciudades.id','=','tbl_asistentes.Ciudad_id')
            ->join('Tbl_InfoPagos','Tbl_InfoPagos.AsistenteXEvento_id','=','tbl_asistentesXeventos.id')
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->select(\DB::raw('tbl_asistentesXeventos.esActivo, tbl_asistentes.id,  tbl_asistentes.Nombres, tbl_asistentes.Apellidos, tbl_asistentes.Identificacion, tbl_asistentes.telefono, tbl_asistentes.Email, tbl_asistentes.Edad, tbl_asistentes.Dirección, tbl_asistentes.Ciudad_id, Tbl_InfoPagos.CantidadBoletas, Tbl_InfoPagos.PrecioTotal, "Paga" as TipoBoleta' ))
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->get();
         foreach ($asistentesPago as $asistenteXEventoPago) {
            $asistenteXEventoPago->ciudad = Ciudad::where('id', '=', $asistenteXEventoPago->Ciudad_id)->get()->first();
            $arrayAsistentes[] = $asistenteXEventoPago;
        }
        return $arrayAsistentes;
    }

    public function validarPIN($idPin)
    {
        $verificarPin = count(CodigoAsistente::where('Codigo', '=', $idPin)->where('TipoCodigo', '=', 0)->get());
        if ($verificarPin == 0) {
            return false;
        }
        return true;
    }

    public function ActualizarPin($ced, $idPin)
    {
        $pinActualizar = CodigoAsistente::where('Codigo', '=', $idPin)->get()->first();
        $pinActualizar->Identificacion = $ced;
        $pinActualizar->TipoCodigo = '1';
        $pinActualizar->save();
        return true;
    }

    public function ActualizarPinBusquedaCorreo($correo)
    {
        $pinActualizar = CodigoAsistente::where('Identificacion', '=', $correo)->get()->first();
        if($pinActualizar != null){
            $pinActualizar->TipoCodigo = '1';
            $pinActualizar->save();
        }
        return true;
    }

    //se actualiza el pin solo ingresando el correo electronico donde se ingresa la cc, no se actualiza el estado del pin
    public function ActualizarPinSinActualizarEstado($correo, $idPin)
    {
        $pinActualizar = CodigoAsistente::where('Codigo', '=', $idPin)->get()->first();
        $pinActualizar->Identificacion = $correo;
        $pinActualizar->save();
        return true;
    }

    public function ObtnerCantidadAsistentes($idEvento)
    {
        return count(AsistenteXEvento::where('Evento_id', '=', $idEvento)->get());
    }

    public function ObtnerCantidadAsistentesPago($idEvento)
    {
        return  count(AsistenteXEvento::join('Tbl_InfoPagos', function ($join) {
            $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
        })
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->get());
    }

    public function ObtenerAsistente($cc)
    {
        $asistente = Asistente::where('Identificacion', '=', $cc)->get()->first();
        if ($asistente) {
            $asistente->ciudad = Ciudad::where('id', '=', $asistente->Ciudad_id)->get()->first();
        }
        return $asistente;
    }

    public function ObtenerAsistentePago($idEvento, $cc)
    {
        $asistentepago = Asistente::join('tbl_asistentesXeventos', 'tbl_asistentes.id', '=', 'tbl_asistentesXeventos.Asistente_id')
            ->join('Tbl_Ciudades','Tbl_Ciudades.id','=','tbl_asistentes.Ciudad_id')
            ->join('Tbl_InfoPagos', function ($join) {
                $join->on('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.id')->orOn('Tbl_InfoPagos.AsistenteXEvento_id', '=', 'tbl_asistentesXeventos.idAsistenteCompra');
            })
            ->join('Tbl_PreciosBoletas', 'Tbl_PreciosBoletas.Evento_id', '=', 'tbl_asistentesXeventos.Evento_id')
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->where('Tbl_InfoPagos.EstadosTransaccion_id', '=', 4)
            ->where('tbl_asistentesXeventos.PinBoleta', '=', $cc)
            ->whereRaw('Tbl_PreciosBoletas.precio = (Tbl_InfoPagos.PrecioTotal / Tbl_InfoPagos.CantidadBoletas)')
            ->select(\DB::raw('tbl_asistentes.id, Tbl_PreciosBoletas.precio, Tbl_PreciosBoletas.localidad ,  tbl_asistentes.Nombres, tbl_asistentes.Apellidos, tbl_asistentes.Identificacion, tbl_asistentes.telefono, tbl_asistentes.Email, tbl_asistentes.Edad, tbl_asistentes.Dirección,tbl_asistentes.Ciudad_id' ))
            ->orderBy('tbl_asistentes.id', 'DESC')
            ->get()->first();
        $asistenteinvitado = Asistente::join('tbl_asistentesXeventos', 'tbl_asistentes.id', '=', 'tbl_asistentesXeventos.Asistente_id')
            ->where('tbl_asistentesXeventos.Evento_id', '=', $idEvento)
            ->where('tbl_asistentesXeventos.PinBoleta', '=', $cc)
            ->where('tbl_asistentesXeventos.ComentarioEvento', '=', "BoletaGratis123")
            ->select(\DB::raw('tbl_asistentes.id, "0", "Cortesia", tbl_asistentes.Nombres, tbl_asistentes.Apellidos, tbl_asistentes.Identificacion, tbl_asistentes.telefono, tbl_asistentes.Email, tbl_asistentes.Edad, tbl_asistentes.Dirección, tbl_asistentes.Ciudad_id' ))
            ->orderBy('tbl_asistentes.id', 'DESC')
            ->get()->first();
        //$asistente = $asistentepago->merge($asistenteinvitado);
        if($asistentepago == null)
        {
            $asistente =  $asistenteinvitado;
        }else{
            $asistente =  $asistentepago;
        }
        if ($asistente) {
            $asistente->ciudad = Ciudad::where('id', '=', $asistente->Ciudad_id)->get()->first();
        }
        return $asistente;
    }

    public function actualizarAsistente($cc, $asistenteRequest)
    {
        $asistente = Asistente::where('Identificacion', '=', $cc)->get()->first();
        $asistente->telefono = $asistenteRequest->telefono;
        $asistente->Email = $asistenteRequest->Email;
        $asistente->Edad = $asistenteRequest->Edad;
        $asistente->Dirección = $asistenteRequest->Dirección;
        $asistente->Ciudad_id = $asistenteRequest->Ciudad_id;
        return $asistente;
    }

    public function ObtenerAsistenteXEvento($idEvento, $idAsistente)
    {
        return AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('Asistente_id', '=', $idAsistente)->get()->first();
    }

    public function ObtenerPromotorXSede($idSede, $idAsistente)
    {
        return PromotoresXSede::where('Sede_id', '=', $idSede)->where('Asistente_id', '=', $idAsistente)->get()->first();
    }

    public function ObtenerAsistenteXEventoPago($idEvento, $idAsistente, $cc)
    {
        return AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('Asistente_id', '=', $idAsistente)
            ->where('PinBoleta', '=', $cc)->get()->first();
    }

    public function ActivarQRAsistenteXEvento($idEvento, $idAsistente)
    {
        $asistenteEvento = AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('Asistente_id', '=', $idAsistente)->get()->first();
        if ($asistenteEvento->esActivo == false) {
            $asistenteEvento->esActivo = true;
            $asistenteEvento->save();
            return 'Usuario ingresado con exito';
        } else {
            return 'El Usuario YA INGRESO';
        }
        return 'Error ingresando el usuario';
    }

    public function ActivarQRAsistenteXEventoPago($idEvento, $idAsistente, $cc)
    {
        $asistenteEvento = AsistenteXEvento::where('Evento_id', '=', $idEvento)
            ->where('Asistente_id', '=', $idAsistente)
            ->where('PinBoleta', '=', $cc)->get()->first();
        if ($asistenteEvento->esActivo == false) {
            $asistenteEvento->esActivo = true;
            $asistenteEvento->save();
            return 'Usuario ingresado con exito';
        } else {
            return 'El Usuario YA INGRESO';
        }
        return 'Error ingresando el usuario';
    }

    public function AsistentesActivos($idEvento)
    {
        $arrayAsistentes = array();
        $listaAsistentesEventos = AsistenteXEvento::where([['Evento_id', '=', $idEvento], ['esActivo', '=', '1']])->get();
        foreach ($listaAsistentesEventos as $asistenteXEvento) {
            $asistente = Asistente::where('id', '=', $asistenteXEvento->Asistente_id)->first();
            $asistente->ciudad = Ciudad::where('id', '=', $asistente->Ciudad_id)->get()->first();
            $arrayAsistentes[] = $asistente;
        }
        return $arrayAsistentes;
    }

    public function GenerarPin()
    {
        do
        {
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
            $max = strlen($pattern) - 1;
            for ($i = 0; $i < 10; $i++) $key .= $pattern{mt_rand(0, $max)};
            $verificarPinBoletaPaga = count(AsistenteXEvento::where('PinBoleta', '=', $key)->get());
        }while ($verificarPinBoletaPaga >0);
        return $key;
    }

    private function crearInfoPago($RequestInFoPago)
    {
        $precioTotal = (PrecioBoleta::where('id', '=', $RequestInFoPago->localidad)->first()->precio) * $RequestInFoPago->CantidadTickets;
        $infopago = new InfoPago();
        $infopago->NumeroFactura = 1;//numero temporal
        $infopago->CantidadBoletas = $RequestInFoPago->CantidadTickets;
        $infopago->PrecioTotal = $precioTotal;
        $infopago->TotalIva = $precioTotal * 0.19;
        $infopago->Ganancia = $precioTotal - ($infopago->TotalIva);
        $infopago->Fecha_Compra = new \DateTime();
        $infopago->EstadosTransaccion_id = 1;
        $infopago->MediosDePago_id = 1;
        return $infopago;
    }

    public function actualizarInfoPagos($idInfoPagos, $estadotransaccion, $medioPago)
    {
        DB::beginTransaction();
        try {
            $infopago = InfoPago::where('id', '=', $idInfoPagos)->first();
            $infopago->EstadosTransaccion_id = $estadotransaccion;
            $infopago->MediosDePago_id = $medioPago;
            $infopago->save();
            DB::commit();
            return ['respuesta' => true, 'infoPago' => $infopago];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }

    }

    public function obtenerPinesBoletas($idInfoPagos)
    {
        $infopago = InfoPago::where('id', '=', $idInfoPagos)->first();
        $asistenteXEventos = AsistenteXEvento::where('id', '=', $infopago->AsistenteXEvento_id)->first();
        $asistentesXEventos = AsistenteXEvento::where('Evento_id', '=', $asistenteXEventos->Evento_id)
            ->where('id', '=', $asistenteXEventos->id)
            ->where('esPago', '=', true)
            ->Orwhere('idAsistenteCompra', '=', $asistenteXEventos->id)->get();
        return $asistentesXEventos;
    }

    public function ObtenerEventoRefe($idInfoPago)
    {
        $infopago = InfoPago::where('id', '=', $idInfoPago)->first();
        $asistenteXEventos = AsistenteXEvento::where('id', '=', $infopago->AsistenteXEvento_id)->first();
        $evento = Evento::where('id','=',$asistenteXEventos->Evento_id)->get()->first();
        return $evento;
    }

    public function ConfirmarAsistencia($idEvento, $idAsistente, $respuesta)
    {
        $asistenteEvento = AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('Asistente_id', '=', $idAsistente)->get()->first();
        if($respuesta == "si")
        {
            $asistenteEvento->esPerfilado = true;
            $asistenteEvento->save();
            return 'Gracias por confirmar Asistencia';
        }
        else {
            $asistenteEvento->esPerfilado = null;
            $asistenteEvento->save();
            return 'El Usuario NO Confirmo Asistencia';
        }
        return 'Error ingresando el usuario';

    }

    public function Espago($idEvento)
    {
        $espago = count(Evento::where('id', '=', $idEvento)->where('Espago', '=', 1)->get());
        if ($espago == 0) {
            return false;
        }
        return true;
    }

    public function ActivarPinPago($idEvento, $idPin)
    {
        $asistenteEvento = AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('PinBoleta', '=', $idPin)->get()->first();
        if ($asistenteEvento->esActivo == false) {
            $asistenteEvento->esActivo = true;
            $asistenteEvento->save();
            return 'Boleta Activada con exito';
        } else {
            return 'La boleta ya fue ACTIVADA';
        }
        return 'Error activando la boleta vuelva a intentarlo';
    }

    public function DesactivarQRAsistenteXEvento($idEvento, $idAsistente)
    {
        $asistenteEvento = AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('Asistente_id', '=', $idAsistente)->get()->first();
        if ($asistenteEvento->esActivo == true) {
            $asistenteEvento->esActivo = false;
            $asistenteEvento->save();
            return 'Usuario desactivado con exito';
        } else {
            return 'El Usuario ya se encuentra desactivado';
        }
        return 'Error desactivando el usuario';
    }

    public function EsGuestList($idEvento)
    {
        $esGuestList = count(AsistenteXEvento::where('Evento_id', '=', $idEvento)->where('ComentarioEvento', '=', "BoletaGratis123")->get());
        if ($esGuestList == 0) {
            return false;
        }
        return true;
    }

    public function registrarPromotor($registroPromotor)
    {
        $asistente = $this->ObtenerAsistente($registroPromotor->Identificacion);
        if ($asistente) {
            $asistente = $this->actualizarAsistente($registroPromotor->Identificacion, new Asistente($registroPromotor->all()));
        } else {
            $asistente = new Asistente($registroPromotor->all());
        }
        $identificacionPromotor = $this->ObtenerPromotorXSede($registroPromotor->Sede_id, $asistente->id);
        if ($identificacionPromotor == null) {
            DB::beginTransaction();
            try {
                $asistente->save();
                $promotorXSede = new PromotoresXSede($registroPromotor->all());
                $promotorXSede->Asistente_id = $asistente->id;
                $promotorXSede->esActivo = 1;
                $promotorXSede->save();
                DB::commit();

            } catch (\Exception $e) {
                $error = $e->getMessage();
                DB::rollback();
                dd($error);
                return $error;
            }
            return true;
        } else {
            return '2';// se devuelve 1 cuando el usuario ya se encuentra registrado
        }
    }
} 


