<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 5/09/2018
 * Time: 9:10 AM
 */

namespace Eco\Datos\Repositorio;



use Eco\Datos\Modelos\Sede;
use Illuminate\Support\Facades\DB;

class SedeRepositorio
{

    public  function GuardarSede($request)
    {
        DB::beginTransaction();
        try {
            if(isset($request['id']))
            {
                $sede = Sede::find($request['id']);
                $sede->Nombre = $request['Nombre'];
                $sede->Direccion = $request['Direccion'];
                $sede->Telefono = $request['Telefono'];

            }else{
                $sede = new Sede($request);
            }
            $sede->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {

            $error = $e->getMessage();
            DB::rollback();
            return $error;
        }
    }

    public  function  ObtenerListaSedes($idEmpreesa)
    {
        return Sede::where('Empresa_id', '=', $idEmpreesa)->get();
    }

    public  function  ObtenerSede($idSede)
    {
        return Sede::where('id', '=', $idSede)->get()->first();
    }
}