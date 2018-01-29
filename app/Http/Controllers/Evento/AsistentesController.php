<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\AsistenteServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;


class AsistentesController extends Controller
{
    protected $asistenteServicio;
    public function __construct(AsistenteServicio $asistenteServicio)
    {
        $this->asistenteServicio = $asistenteServicio;
    }

    public function registrarAsistente(Request $formRegistro)
    {
        if($this->asistenteServicio->registrarAsistente($formRegistro) )
        {
            return redirect('/');
        }else{
            return redirect('/');
        }
    }



}
