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
        return $this->asistenteRepositorio->registrarAsistente($asistente);
    }

    public function registrarAsistentePago($asistente)
    {
        $respuesta = $this->asistenteRepositorio->registrarAsistentePago($asistente);
        if ($respuesta['respuesta']) {
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
            $info_pagos->buyerEmail = "cristianmg13@hotmail.com";
            $info_pagos->responseUrl = "http://localhost:100/Ecotickects/public/RespuestaPagos";
            $info_pagos->confirmationUrl = "http://localhost:100/Ecotickects/public/RespuestaPagos";
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


    public function obtenerAsistentesXEvento($idEvento)
    {
        return $this->asistenteRepositorio->obtenerAsistentesXEvento($idEvento);
    }

    public function validarPIN($idPin)
    {
        return $this->asistenteRepositorio->validarPIN($idPin);
    }

    public function ActualizarPin($ced, $idPin)
    {
        return $this->asistenteRepositorio->ActualizarPin($ced, $idPin);
    }

    public function ObtnerCantidadAsistentes($idEvento)
    {
        return $this->asistenteRepositorio->ObtnerCantidadAsistentes($idEvento);
    }

    public function ObtenerAsistente($cc)
    {
        return $this->asistenteRepositorio->ObtenerAsistente($cc);
    }

    public function ObtenerInformacionDelAsistenteXEvento($idEvento, $cc)
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

    public function ActivarQRAsistenteXEvento($idEvento, $idAsistente)
    {
        return $this->asistenteRepositorio->ActivarQRAsistenteXEvento($idEvento, $idAsistente);
    }

    public function AsistentesActivos($idEvento)
    {
        return $this->asistenteRepositorio->AsistentesActivos($idEvento);
    }
}