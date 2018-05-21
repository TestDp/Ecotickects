<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 21/05/2018
 * Time: 11:54 AM
 */

namespace Eco\Negocio\Logica;
use Eco\Datos\Modelos\DetalleFactura;
use Eco\Datos\Modelos\Factura;
use Eco\Datos\Repositorio\FacturaRepositorio;
use Eco\Datos\Repositorio\ProductosRepositorio;

class FacturaServicio
{
    protected $facturaRepor;
    protected $producRepor;

    public function __construct(FacturaRepositorio $facturaRepor,ProductosRepositorio $producRepor)
    {
        $this->facturaRepor = $facturaRepor;
        $this->producRepor = $producRepor;
    }
    public function crearFactura($EdFactura)
    {
        $factura = new Factura($EdFactura->all());
        $factura ->Cancelada = false;
        $ind =0;
        $ArrayDetalleFactura = array();
        foreach ($EdFactura->cantidad as $cantidad)
        {
            $producto =  $this->producRepor->ObtenerProducto($EdFactura->Producto_id[$ind]);
            $detalleFactura = new DetalleFactura();
            $detalleFactura->cantidad = $cantidad;
            $detalleFactura->Producto_id = $producto->id;
            $detalleFactura->subTotal =  $producto->precio * $cantidad;
            $factura ->PrecioTotal = $factura ->PrecioTotal + $detalleFactura->subTotal;
            $ArrayDetalleFactura[] = $detalleFactura;
            $ind++;
        }
        $factura->TotalIva = $factura ->PrecioTotal*env('CONSTIVA');
        $respuesta =  $this->facturaRepor->crearFactura($factura,$ArrayDetalleFactura);
        if ($respuesta['respuesta']) {
            $info_pagos = new \stdClass();
            $info_pagos->merchantId = env('MERCHANTID');
            $info_pagos->accountId = env('ACCOUNTID');
            $info_pagos->description = env('DESCRIPCION');
            $info_pagos->referenceCode = env('REFERENCECODETIENDA') . $respuesta['infoPago'];
            $info_pagos->amount = $factura ->PrecioTotal;
            $info_pagos->tax = env('TAX');
            $info_pagos->taxReturnBase = env('TAXRETURNBASE');
            $info_pagos->currency = env('CURRENCY');
            $info_pagos->signature = md5(env('APIKEYPAYU') . '~' . env('MERCHANTID') . '~' . $info_pagos->referenceCode . '~' . $factura ->PrecioTotal . '~' . env('CURRENCY'));
            $info_pagos->test = env('TEST');
            $info_pagos->buyerEmail = $factura->CorreoComprador;
            $info_pagos->responseUrl = env('URLRESPONSETIENDA');
            $info_pagos->confirmationUrl = env('URLCONFIRMATIONTIENDA');
            return ['respuesta' => true, 'info' => $info_pagos];
        }
        return $respuesta;
    }

    //metodo que obtiene el id de la factura desde el string de la referencia devuelto por payu
    public  function ObtenerIdFacturadDesdeRefencia($Rerefecia)
    {
        $idFactura = explode(env('REFERENCECODETIENDA'), $Rerefecia)[1];
        return $idFactura;
    }
    public  function actualizarEstadoFactura($idfactura,$estado)
    {
        return $this->actualizarEstadoFactura($idfactura,$estado);
    }
}