<?php

namespace Ecotickets\Http\Controllers\Cupon;

use Eco\Negocio\Logica\CuponesServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CuponesController extends Controller
{
    protected $cuponesServicio;

    public function __construct(CuponesServicio $cuponesServicio)
    {
        $this->middleware('auth');
        $this->cuponesServicio = $cuponesServicio;
    }

    public  function  ObtenerMisCupones(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        $user = Auth::user();
        $cupones = $this->cuponesServicio->ObtenerMisCupones($user->id);
        $ListaCupones= array('cupones' => $cupones);
        return view('Cupon/MisCupones',['ListaCupones' => $ListaCupones]);
    }
}
