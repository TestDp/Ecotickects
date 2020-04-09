<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 26/03/2018
 * Time: 1:17 PM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\InfoPago;

class InfoPagosRepositorio
{

    public function crearInfoPago($RequestInFoPago)
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

    public function obtenerInfoPagos($idInfoPagos)
    {
        return InfoPago::where('id', '=', $idInfoPagos)->first();
    }
}