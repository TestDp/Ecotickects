<?php
/**
 * Created by PhpStorm.
 * User: LaPoint
 * Date: 21/05/2018
 * Time: 11:55 AM
 */

namespace Eco\Datos\Repositorio;


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