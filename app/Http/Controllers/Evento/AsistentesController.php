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
                if($pin){
                    $this->asistenteServicio->ActualizarPin($ced,$pin);
                }
                $nombre = $formRegistro ->Identificacion . 'imagenQR.png';
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('local')->put('/QrDeEventos/'.$formRegistro->Evento_id.'/'.$nombre,file_get_contents($file));
                $qrImagen = storage_path('app').'/QrDeEventos/'.$formRegistro->Evento_id.'/'.$nombre;
                $correoElectronico = $formRegistro->Email;
                $evento =$this->eventoServicio->obtenerEvento($formRegistro->Evento_id);
                $ElementosArray= array('evento' => $evento);
                $correoSaliente=$evento->CorreoEnviarInvitacion;
                $nombreEvento = $evento->Nombre_Evento;
                Mail::send('Email/correo',['ElementosArray' =>$ElementosArray],function($msj) use($qrImagen,$correoElectronico,$correoSaliente,$nombreEvento){
                    $msj->from($correoSaliente,'Invitación '.$nombreEvento);
                    $msj->subject('Importante - Aquí esta tu pase de acceso');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
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

    public function ObtnerCantidadAsistentes($idEvento)
    {
        $CantidadRegistrados = $this -> asistenteServicio ->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $cantidadAsistentes = ['CantidadEsperada'=>$CantidadEsperada,'CantidadRegistrados'=>$CantidadRegistrados];
        return response()->json($cantidadAsistentes);
    }

    public function ObtenerAsistente($cc)
    {
        return response()->json($this -> asistenteServicio ->ObtenerAsistente($cc));
    }
}
