<?php

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Convenio;
use Eco\Datos\Modelos\ConvenioxPreciosBoleta;
use Illuminate\Support\Facades\DB;


class ConveniosRepositorio
{
      public function obtenerConveniosPorEvento($eventoId)
      {
          return Convenio::where('Evento_id', $eventoId)->get()->first();
      }

      public function  yaTieneCompraConvenio($idEvento,$cc){
         return DB::table('tbl_asistentesXeventos as ae')
              ->join('tbl_asistentes as a', 'ae.Asistente_id', '=', 'a.id')
              ->join('Tbl_Ciudades as c', 'a.Ciudad_id', '=', 'c.id')
              ->join('Tbl_InfoPagos as p', 'ae.id', '=', 'p.AsistenteXEvento_id')
              ->join('Tbl_Eventos as e', 'ae.Evento_id', '=', 'e.id')
              ->join('Tbl_ConvenioxPreciosBoletas as cpb', 'ae.id', '=', 'cpb.AsistentexEvento_id')
              ->select(
                  'e.Nombre_Evento as Nombre_Evento',
                  DB::raw('p.PrecioTotal / p.CantidadBoletas AS PrecioEtapa'),
                  DB::raw('SUM(p.CantidadBoletas) AS CantidadBoletas'),
                  DB::raw('SUM(p.PrecioTotal) AS TotalEtapa')
              )
              ->where('ae.Evento_id', $idEvento)
              ->whereIn('p.EstadosTransaccion_id', [4, 7])
              ->where('a.Identificacion', $cc)
              ->groupBy('e.Nombre_Evento', DB::raw('p.PrecioTotal / p.CantidadBoletas'))
              ->get();
      }


    /* public function obtenerConvenio($id)
     {
         return Convenio::findOrFail($id);
     }

     public function obtenerCodigoPromocional($convenioId, $categoria)
     {
         $convenioxPrecio = ConvenioxPreciosBoleta::where('convenio_id', $convenioId)
             ->where('Tarifa', 'nomTarifa=' . $categoria)
             ->first();

         if ($convenioxPrecio) {
             // Aquí deberías retornar el código promocional asociado
             // Esto dependerá de cómo estén estructurados tus datos
             return $convenioxPrecio->id;
         }

         return null;
     }*/
}