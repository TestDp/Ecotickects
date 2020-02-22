<?php

namespace Ecotickets\Http\Controllers\Recurso;

use Eco\Negocio\Logica\DepartamentoServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;

class DepartamentoController extends Controller
{

    protected $departamentoServicio;

    public function __construct(DepartamentoServicio $departamentoServicio)
    {
        $this->middleware('auth');
        $this->departamentoServicio = $departamentoServicio;
    }

    public  function ObtenerDepartamento(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $departamentos = $this->departamentoServicio->obtenerDepartamento();
        return view('Recurso/ListaDepartamentos',['listaDepartamentos' =>$departamentos]);
    }


}
