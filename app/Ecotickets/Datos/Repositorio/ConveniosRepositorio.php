<?php

namespace Eco\Datos\Repositorio;

use Eco\Datos\Modelos\Convenio;
use Eco\Datos\Modelos\ConvenioxPreciosBoleta;


class ConveniosRepositorio
{
      public function obtenerConveniosPorEvento($eventoId)
      {
          return Convenio::where('Evento_id', $eventoId)->get()->first();
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