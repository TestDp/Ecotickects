<?php

namespace Ecotickets\Http\Controllers\Evento;
use PDF;
use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EstadisticasServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;



class AsistentesController extends Controller
{
    protected $asistenteServicio;
    protected $eventoServicio;
    protected $EstadisticasServicios;
    protected $departamentoServicio;
    public function __construct(AsistenteServicio $asistenteServicio,EventosServicio $eventoServicio,EstadisticasServicio $EstadisticasServicios,DepartamentoServicio $departamentoServicio)
    {
        //$this->middleware('auth');
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
        $this->EstadisticasServicios = $EstadisticasServicios;
        $this->departamentoServicio=$departamentoServicio;
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

    //Metodo cuando se esta registrando un asistente que esta comprando una boleta
    public function registrarAsistentePagoPost(Request $formRegistro)
    {
        return response()->json($this->asistenteServicio->registrarAsistentePago($formRegistro));
    }
    //Metodo de respuesta de la plataforma de pagos payu
    public function getRespuestaPagos()
    {
        $estadoTransaccion = $_REQUEST['transactionState'];
        $transaccionId = $_REQUEST['transactionId'];
        $transaccionReference = $_REQUEST['referenceCode'];
        $correoElectronico = $_REQUEST['buyerEmail'];
        $medioPago = $_REQUEST['polPaymentMethodType'];
        if ($estadoTransaccion == 4 ) {
            $listaAsistentesXEventosPines = $this->asistenteServicio->crearBoletas($transaccionReference,$estadoTransaccion,$medioPago);
            $evento =$this->eventoServicio->obtenerEvento($listaAsistentesXEventosPines['ListaAsistesEventoPines']->first()->Evento_id);
            $ElementosArray= array('evento' => $evento);
            $correoSaliente='info@loversfestival.com';
            $nombreEvento = $evento->Nombre_Evento;
            $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];
            Mail::send('Email/correo',['ElementosArray' =>$ElementosArray],function($msj) use($pinesImagenes,$correoElectronico,$correoSaliente,$nombreEvento,$evento,$transaccionReference){
                $msj->from($correoSaliente,'Invitación '.$nombreEvento);
                $msj->subject('Importante - Aquí esta tu pase de acceso');
                $msj->to($correoElectronico);
                $msj->bcc('soporteecotickets@gmail.com');
                foreach ($pinesImagenes as $pin){
                    $qr= base64_encode(\QrCode::format('png')->merge('../public/img/iconoPequeno.png')->size(280)->generate($nombreEvento.' - CC - '.$pin->PinBoleta.'ECOTICKETS'));
                    $ElementosArray= array('evento' => $evento,'qr'=>$qr);
                    \PDF::loadView('boletatest', ['ElementosArray' =>$ElementosArray])->save('../storage/app/boletas/ECOTICKET'.$pin->id.'.pdf');
                    $qrImagen =storage_path('app').'/boletas/ECOTICKET'.$pin->id.'.pdf';
                    $msj->attach($qrImagen);
                }
            });
           return view("boleta",['ElementosArray' =>$ElementosArray]);
        }
        $ccUser=$transaccionReference;
        return view('existente',['identificacion' => $ccUser]);// se debe cambiar
    }

    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }

    public function ObtnerCantidadAsistentes($idEvento)
    {
        $CantidadRegistrados = $this -> asistenteServicio ->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $CantidadAsistentes = $this->EstadisticasServicios-> NumeroAsistentes($idEvento);
        $cantidadAsistentes = ['CantidadEsperada'=>$CantidadEsperada,'CantidadRegistrados'=>$CantidadRegistrados,'CantidadAsistentes'=>$CantidadAsistentes];
        return response()->json($cantidadAsistentes);
    }

    public function ObtenerAsistente($cc)
    {
        return response()->json($this -> asistenteServicio ->ObtenerAsistente($cc));
    }

    public function FormularioQR($idEvento)
    {
        return view('Evento/LecturaQR',['Evento' => $this->eventoServicio->obtenerEvento($idEvento)]);
    }

    public  function ObtenerInformacionDelAsistenteXEvento($idEvento,$cc)
    {
        return response()->json($this -> asistenteServicio ->ObtenerInformacionDelAsistenteXEvento($idEvento,$cc));
    }

    public function ActivarQRAsistenteXEvento($idEvento,$idAsistente)
    {
        return $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento,$idAsistente);
    }

    public function AsistentesActivos($idEvento)
    {
        return response()->json($this->asistenteServicio->AsistentesActivos($idEvento));
    }
    //buscar qr y activarlo
    public function ActivarQRAsistenteXEventoApp($idEvento,$cc)
    {
        $usuario=$this -> asistenteServicio ->ObtenerInformacionDelAsistenteXEvento($idEvento,$cc);
        $respuestaActivacion= $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento,$usuario->id);
        $informacionUsuario =['usuario'=>$usuario,'respuestaActivación'=>$respuestaActivacion];
        return response()->json($informacionUsuario);
    }
}
