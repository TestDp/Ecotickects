<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 21/05/2018
 * Time: 11:55 AM
 */

namespace Eco\Datos\Repositorio;


use Eco\Datos\Modelos\DetalleFactura;
use Eco\Datos\Modelos\Evento;
use Eco\Datos\Modelos\Factura;
use Illuminate\Support\Facades\DB;

class FacturaRepositorio
{
    public function crearFactura($Factura,$ArrayDetallesFactura)
    {
        DB::beginTransaction();
        try{
            $Factura->save();
            foreach ($ArrayDetallesFactura as $detalleFactura)
            {
                $detalleFactura->Factura_id = $Factura->id;
                $detalleFactura->save();
            }
            DB::commit();
            return ['respuesta' => true, 'infoPago' => $Factura->id];
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return ['respuesta' => false, 'error' => $error];
        }
        return ['respuesta' => false, 'error' => 'hubo un error guardando'];
    }

    public  function actualizarEstadoFactura($idfactura,$estado){
        DB::beginTransaction();
        try{
            $factura = Factura::where('id', '=', $idfactura)->get()->first();
            $factura->Cancelada = $estado;
            $factura->save();
            DB::commit();
            return true;
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return false;
        }
        return false;

    }

    public  function  EventosConVentas($idUser)
    {
        $eventosConVentas = array();
        $miseventos = Evento::where('user_id', '=', $idUser)->get();
        foreach ($miseventos as $evento)
        {
            $facturasEvento= Factura::where('Evento_id', '=', $evento->id)->get()->first();
            if($facturasEvento != null)
               $eventosConVentas[]=$evento;
        }
        return $eventosConVentas;
    }

    public  function  VentasPorEvento($idEvento)
    {
        return  Factura::where('Evento_id', '=', $idEvento)->get();
    }

    public  function  obtenerDetalleFactura($idFactura)
    {
         $Detallefactura = DetalleFactura::where('Factura_id', '=', $idFactura)->get();
         foreach ($Detallefactura as $detalle)
             $detalle->producto;
         return $Detallefactura;
    }

    public  function obtenerFactura($idFactura)
    {
        return Factura::where('id', '=', $idFactura)->get()->first();
    }

    public  function actualizarEstadoFacturaDespachada($idfactura,$estadoDespachada){
        DB::beginTransaction();
        try{
            $factura = Factura::where('id', '=', $idfactura)->get()->first();
            $factura->despachado = $estadoDespachada;
            $factura->save();
            DB::commit();
            return true;
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return false;
        }
        return false;

    }
}