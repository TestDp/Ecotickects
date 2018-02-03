<?php

namespace Ecotickets\Http\Controllers\Evento;

use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class AsistentesController extends Controller
{
    protected $asistenteServicio;
    protected $eventoServicio;
    public function __construct(AsistenteServicio $asistenteServicio,EventosServicio $eventoServicio)
    {
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
    }

    public function registrarAsistente(Request $formRegistro)
    {
        $respuesta=$this->asistenteServicio->registrarAsistente($formRegistro);
        if($respuesta =='true')
        {
            $file = $formRegistro->imagen;
            //obtenemos el nombre del archivo
            $ced = $formRegistro ->Identificacion;
            $pin = $formRegistro ->pinIngresar;
            $this->asistenteServicio->ActualizarPin($ced,$pin);

            $nombre = $formRegistro ->Identificacion . 'imagenQR.png';

            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put('/QrDeEventos/'.$nombre,file_get_contents($file));

            $qrImagen = storage_path('app').'/QrDeEventos/'.$nombre;

            $correoElectronico = $formRegistro->Email;
            $evento =$this->eventoServicio->obtenerEvento($formRegistro->Evento_id);
            $ElementosArray= array('evento' => $evento);
            Mail::send('Email/correo',['ElementosArray' =>$ElementosArray],function($msj) use($qrImagen,$correoElectronico){
                $msj->from('info@dpsoluciones.co','Invitación LOVERS FESTIVAL 2018');
                $msj->subject('Importante - Aquí esta tu pase de acceso');
                $msj->to($correoElectronico);
               // $msj->bcc('juancamilo.blandon@gmail.com');
                $msj->attach($qrImagen);
            });
            return view("respuesta",['ElementosArray' =>$ElementosArray]);
        }else{
            if($respuesta == '2'){
                $ccUser=$formRegistro ->Identificacion;
                return view('existente',['identificacion' => $ccUser]);
            }
            else{
                return redirect('/');
            }

        }
    }

    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }

}
