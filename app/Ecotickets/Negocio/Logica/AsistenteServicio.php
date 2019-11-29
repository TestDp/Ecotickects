<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 26/01/2018
 * Time: 2:52 PM
 */

namespace Eco\Negocio\Logica;

use Eco\Datos\Repositorio\AsistenteRepositorio;
use Eco\Negocio\EntidadesDominio\EDInfopagos;


class AsistenteServicio
{
    protected $asistenteRepositorio;

    public function __construct(AsistenteRepositorio $asistenteRepositorio)
    {
        $this->asistenteRepositorio = $asistenteRepositorio;
    }

    public function registrarAsistente($asistente)
    {
        $espago = $this->asistenteRepositorio->Espago($asistente->Evento_id);
        $invitacion = 0;
        if ($espago)
        {
            $invitacion = 1;
            return $this->asistenteRepositorio->registrarAsistente($asistente, $invitacion);
        }


        return $this->asistenteRepositorio->registrarAsistente($asistente, $invitacion);
    }

    public function registrarAsistentePago($asistente)
    {
        $respuesta = $this->asistenteRepositorio->registrarAsistentePago($asistente);
        if ($respuesta['respuesta']) {

            $pin = $asistente ->pinIngresar;
            if($pin){
                $this->ActualizarPinSinActualizarEstado($asistente->Email,$pin);
            }
            $info_pagos = new \stdClass();
            $info_pagos->merchantId = env('MERCHANTID');
            $info_pagos->accountId = env('ACCOUNTID');
            $info_pagos->description = env('DESCRIPCION');
            $info_pagos->referenceCode = env('REFERENCECODE') . $respuesta['infoPago']->id;
            $info_pagos->amount = $respuesta['infoPago']->PrecioTotal;
            $info_pagos->tax = env('TAX');
            $info_pagos->taxReturnBase = env('TAXRETURNBASE');
            $info_pagos->currency = env('CURRENCY');
            $info_pagos->signature = md5(env('APIKEYPAYU') . '~' . env('MERCHANTID') . '~' . $info_pagos->referenceCode . '~' . $respuesta['infoPago']->PrecioTotal . '~' . env('CURRENCY'));
            $info_pagos->test = env('TEST');
            $info_pagos->buyerEmail = $asistente->Email;
            $info_pagos->responseUrl = env('URLRESPONSE');
            $info_pagos->confirmationUrl = env('URLCONFIRMATION');
            return ['respuesta' => true, 'info' => $info_pagos];
        }
        return $respuesta;
    }

    public function crearBoletas($referenceCode, $estadotransaccion, $medioPago)
    {
        $idinfopago = explode(env('REFERENCECODE'), $referenceCode)[1];
        $respuesta= $this->asistenteRepositorio->actualizarInfoPagos($idinfopago, $estadotransaccion, $medioPago);
        if ($respuesta['respuesta'])
        {
            $asistentesEventosPines=$this->asistenteRepositorio->obtenerPinesBoletas($respuesta['infoPago']->id);
            return ['respuesta' => true, 'ListaAsistesEventoPines' => $asistentesEventosPines];
        }
        return $respuesta;
    }

    public function actualizarInfoPagos($referenceCode, $estadotransaccion, $medioPago){
        $idinfopago = explode(env('REFERENCECODE'), $referenceCode)[1];
        $respuesta = $this->asistenteRepositorio->actualizarInfoPagos($idinfopago, $estadotransaccion, $medioPago);
        return $respuesta;
    }

    public function validarFirmaPago($merchantId,$referenciaVenta,$valor,$moneda,$estadoVenta,$firmaVenta)
    {
        $newValor = $this->transformaValor($valor);
        try{
            $firmaVerificar = md5(env('APIKEYPAYU').'~'.$merchantId.'~'.$referenciaVenta.'~'.$newValor.'~'.$moneda.'~'.$estadoVenta);
            if($firmaVerificar == $firmaVenta){
                return 1;
            }
            return 0;
        }catch (\Exception $e){
            $error = $e->getMessage();
            return $error;
        }

    }

    public function transformaValor($valor){
        $stringEntero = explode('.', $valor)[0];
        $stringDecimal = explode('.', $valor)[1];
        $primerDigito = substr($stringDecimal, 0,1);
        $segundoDigito = substr($stringDecimal, 1,1);
        if($segundoDigito==0){
            return $stringEntero.'.'.$primerDigito;
        }
        return $valor;
    }

    public function ObtenerEventoRefe($referenceCode)
    {
        $idinfopago = explode(env('REFERENCECODE'), $referenceCode)[1];
        $respuesta= $this->asistenteRepositorio->ObtenerEventoRefe($idinfopago);
       
        return $respuesta;
    }




    public function obtenerAsistentesXEvento($idEvento)
    {
        $espago = $this->asistenteRepositorio->Espago($idEvento);
        //$esGuestList = $this->asistenteRepositorio->EsGuestList($idEvento);
        if ($espago)
        {
            return $this->asistenteRepositorio->obtenerAsistentesXEventoPago($idEvento);
        }
        /*elseif ($esGuestList)
        {
            return $this->asistenteRepositorio->obtenerAsistentesXEventoGuessList($idEvento);
        }*/

        return $this->asistenteRepositorio->obtenerAsistentesXEvento($idEvento);
    }

    public function obtenerAsistentesXEventoGuestList($idEvento)
    {
        $esGuestList = $this->asistenteRepositorio->EsGuestList($idEvento);

        if ($esGuestList)
       {
           return $this->asistenteRepositorio->obtenerAsistentesXEventoGuessList($idEvento);
       }

        return $this->asistenteRepositorio->obtenerAsistentesXEventoGuessList($idEvento);

    }

    public function validarPIN($idPin)
    {
        return $this->asistenteRepositorio->validarPIN($idPin);
    }

    public function ActualizarPin($ced, $idPin)
    {
        return $this->asistenteRepositorio->ActualizarPin($ced, $idPin);
    }

    public function ActualizarPinSinActualizarEstado($correo, $idPin){
        return $this->asistenteRepositorio->ActualizarPinSinActualizarEstado($correo, $idPin);
    }

    public function ActualizarPinBusquedaCorreo($correo){
        return $this->asistenteRepositorio->ActualizarPinBusquedaCorreo($correo);
    }
    public function ObtnerCantidadAsistentes($idEvento)
    {
        $espago = $this->asistenteRepositorio->Espago($idEvento);
        if ($espago)
        {
            return $this->asistenteRepositorio->ObtnerCantidadAsistentesPago($idEvento);
        }

        return $this->asistenteRepositorio->ObtnerCantidadAsistentes($idEvento);
    }

    public function ObtenerAsistente($cc)
    {
        return $this->asistenteRepositorio->ObtenerAsistente($cc);
    }

    public function ObtenerInformacionDelAsistenteXEvento($idEvento, $cc)
    {
        $espago = $this->asistenteRepositorio->Espago($idEvento);
        if ($espago)
        {
            $asistente = $this->asistenteRepositorio->ObtenerAsistentePago($idEvento,$cc);
            if ($asistente != null) {
                $AsistenteEvento = $this->asistenteRepositorio->ObtenerAsistenteXEventoPago($idEvento, $asistente->id, $cc);
                if ($AsistenteEvento != null) {
                    $asistente->esActivo = $AsistenteEvento->esActivo;
                    $asistente->esPerfilado = $AsistenteEvento->esPerfilado;
                    return $asistente;
                }
            }
            return null;
        }
        else
        {
            $asistente = $this->asistenteRepositorio->ObtenerAsistente($cc);
            if ($asistente != null) {
                $AsistenteEvento = $this->asistenteRepositorio->ObtenerAsistenteXEvento($idEvento, $asistente->id);
                if ($AsistenteEvento != null) {
                    $asistente->esActivo = $AsistenteEvento->esActivo;
                    $asistente->esPerfilado = $AsistenteEvento->esPerfilado;
                    return $asistente;
                }
            }
            return null;
        }



    }

    public function ActivarQRAsistenteXEvento($idEvento, $idAsistente, $cc)
    {
        $espago = $this->asistenteRepositorio->Espago($idEvento);
        if ($espago)
        {
            return $this->asistenteRepositorio->ActivarQRAsistenteXEventoPago($idEvento, $idAsistente, $cc);
        }

            return $this->asistenteRepositorio->ActivarQRAsistenteXEvento($idEvento, $idAsistente);

    }

    public function AsistentesActivos($idEvento)
    {
        return $this->asistenteRepositorio->AsistentesActivos($idEvento);
    }

    public function ConfirmarAsistencia($idEvento, $idAsistente, $respuesta)
    {
        return $this->asistenteRepositorio->ConfirmarAsistencia($idEvento, $idAsistente, $respuesta);
    }

    public function ActivarPinPago($idEvento, $idPin)
    {
        return $this->asistenteRepositorio->ActivarPinPago($idEvento, $idPin);
    }

    public function DesactivarQRAsistenteXEvento($idEvento, $idAsistente)
    {
        return $this->asistenteRepositorio->DesactivarQRAsistenteXEvento($idEvento, $idAsistente);
    }

    public function registrarPromotor($promotor)
    {

        return $this->asistenteRepositorio->registrarPromotor($promotor);
    }

}