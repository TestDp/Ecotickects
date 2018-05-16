<?php

namespace Ecotickets\Http\Controllers\Evento;
use Eco\Datos\Modelos\InfoPago;
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

    /** Metodo constructor de la clase.*/
    public function __construct(AsistenteServicio $asistenteServicio,EventosServicio $eventoServicio,
                                EstadisticasServicio $EstadisticasServicios,DepartamentoServicio $departamentoServicio)
    {
        //$this->middleware('auth');
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
        $this->EstadisticasServicios = $EstadisticasServicios;
        $this->departamentoServicio=$departamentoServicio;
    }

    /* Metodo para  registrar un asistente  cuando el evento es gratuito.**/
    public function registrarAsistente(Request $formRegistro)
    {
        $respuesta=$this->asistenteServicio->registrarAsistente($formRegistro);
        if($respuesta =='true')
        {
            $file = $formRegistro->imagen;
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

    /*Metodo cuando se esta registrando un asistente que esta comprando una boleta.**/
    public function registrarAsistentePagoPost(Request $formRegistro)
    {
        return response()->json($this->asistenteServicio->registrarAsistentePago($formRegistro));
    }

    /**Metodo de respuesta de la plataforma de pagos payu para el envio de  la  boleta al correo electronico, el  llamado
    se hace de  manera asincronica.Metodo de comunicacion entre sistemas.**/
    public function RespuestaPagos(Request $formRegistro)
    {
        try {
            $correoElectronico = $formRegistro->email_buyer;
            $medioPago = $formRegistro->payment_method_id;
            $merchantId = $formRegistro->merchant_id;
            $referenciaVenta= $formRegistro->reference_sale;
            $valor= $formRegistro->value;
            $moneda= $formRegistro->currency;
            $estadoVenta = $formRegistro->state_pol;
            $firmaVenta = $formRegistro->sign;
            //NOTA:linea para verificar la informacion enviada  por payu
            $verficarFirma  = $this->asistenteServicio->validarFirmaPago($merchantId,$referenciaVenta,$valor,$moneda,$estadoVenta,$firmaVenta);
            //$verificarfirma:1 para la validacion de la firma es correcta
            //$verificarfirma:0 para la validacion de la firma es incorrecta
            if ($estadoVenta == 4 && $verficarFirma == 1) {
                $listaAsistentesXEventosPines = $this->asistenteServicio->crearBoletas($referenciaVenta,$estadoVenta,$medioPago);
                $evento =$this->eventoServicio->obtenerEvento($listaAsistentesXEventosPines['ListaAsistesEventoPines']->first()->Evento_id);
                $ElementosArray = array('evento' => $evento);
                $correoSaliente = $evento->CorreoEnviarInvitacion;//PONER EL CORREO DE MANERA GENERAL
                $nombreEvento = $evento->Nombre_Evento;
                $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];
                Mail::send('Email/correo',['ElementosArray' =>$ElementosArray],function($msj) use($pinesImagenes,$correoElectronico,$correoSaliente,$nombreEvento,$evento){
                    $msj->from($correoSaliente,'Invitación '.$nombreEvento);
                    $msj->subject('Importante - Aquí esta tu pase de acceso');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
                    foreach ($pinesImagenes as $pin){
                        $qr= base64_encode(\QrCode::format('png')->merge('../../pruebas.ecotickets.co/img/iconoPequeno.png')->size(280)->generate($nombreEvento.' - CC - '.$pin->PinBoleta.'ECOTICKETS'));
                        $ElementosArray= array('evento' => $evento,'qr'=>$qr);
                        \PDF::loadView('boletatest', ['ElementosArray' =>$ElementosArray])->save(storage_path('app').'/boletas/ECOTICKET'.$pin->id.'.pdf');
                        $qrImagen =storage_path('app').'/boletas/ECOTICKET'.$pin->id.'.pdf';
                        $msj->attach($qrImagen);
                    }
                });
            }else{
                // se actualiza la informmacion del pago cuando el estado de la transaccion es diferente a 4
                $this->asistenteServicio->actualizarInfoPagos($referenciaVenta,$estadoVenta,$medioPago);
            }
            return response('OK',200);
        }catch (\Exception $e){
            $error = $e->getMessage();
            return reponse('ERROR',404);
        }
    }

    /**Metodo de respuesta de la plataforma payu para mostrar el mensaje al usuario sobre el estado de la transaccion.
     * el llamado se hace cuando se presiona el boton de regresar al sitio.*/
    public function RespuestaPagosUsuario()
    {
        $estadoTransaccion = $_REQUEST['transactionState'];
        $transaccionReference = $_REQUEST['referenceCode'];
        $medioPago = $_REQUEST['polPaymentMethodType'];
        $evento =$this->asistenteServicio->ObtenerEventoRefe($transaccionReference);
        switch ($estadoTransaccion) {
            case 4: /* Approved */
                $ElementosArray= array('evento' => $evento,'mensaje' => "APROVADO");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;

            case 7: /* Pending*/
                $ElementosArray= array('evento' => $evento,'mensaje' => "PENDIENTE");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;

            case 6: /* Declined*/
                $ElementosArray= array('evento' => $evento,'mensaje' => "DECLINADO");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;

            case 104: /* Error*/
                $ElementosArray= array('evento' => $evento,'mensaje' => "ERROR");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;

            case 5: /* Expired*/
                $ElementosArray= array('evento' => $evento,'mensaje' => "EXPIRADO");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;

            default: /* Do something */
                $ElementosArray= array('evento' => $evento,'mensaje' => "PENDIENTE POR PYU");
                return view("respuestaPago",['ElementosArray' =>$ElementosArray]);
                break;
        }




        $ccUser=$transaccionReference;
        return view('existente',['identificacion' => $ccUser]);// se debe cambiar
    }

    /*Metodo para validar si el pin ingresado el formulario es valido.*/
    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }

    /*Metodo que me retorna un array con los cantidad de usuarios registrados,esperados y asistentes.**/
    public function ObtnerCantidadAsistentes($idEvento)
    {
        $CantidadRegistrados = $this -> asistenteServicio ->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada =$this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $CantidadAsistentes = $this->EstadisticasServicios-> NumeroAsistentes($idEvento);
        $cantidadAsistentes = ['CantidadEsperada'=>$CantidadEsperada,'CantidadRegistrados'=>$CantidadRegistrados,
            'CantidadAsistentes'=>$CantidadAsistentes];
        return response()->json($cantidadAsistentes);
    }

    /**Metodo que me retorna un asistente o usuario registrado al evento, se realiza la busqueda por mmedio de la
    identificación.*/
    public function ObtenerAsistente($cc)
    {
        return response()->json($this -> asistenteServicio ->ObtenerAsistente($cc));
    }

    /*Metodo que me retorna el formulario para la lectura del qr con el evento al que se le va a leer el qr**/
    public function FormularioQR($idEvento)
    {
        return view('Evento/LecturaQR',['Evento' => $this->eventoServicio->obtenerEvento($idEvento)]);
    }

    /*Metodo que me retorna la informacion del asistente, se realza la busqueda por id del evento y por la identificacion
    del usuario**/
    public  function ObtenerInformacionDelAsistenteXEvento($idEvento,$cc)
    {
        return response()->json($this -> asistenteServicio ->ObtenerInformacionDelAsistenteXEvento($idEvento,$cc));
    }

    /*Metodo para  activar el qr del asistente al evento, recibe  como parametros el id del evento y el id  del asistente
    o usuario**/
    public function ActivarQRAsistenteXEvento($idEvento,$idAsistente)
    {
        return $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento,$idAsistente);
    }

    /*Metodo que me retornar los usuarios que asistienron al evento**/
    public function AsistentesActivos($idEvento)
    {
        $ListaUsuarios= array('usuariosRegistrados' => $this -> asistenteServicio ->obtenerAsistentesXEvento($idEvento),
            'Asistentes'=>$this->asistenteServicio->AsistentesActivos($idEvento));
        return response()->json($ListaUsuarios);
    }

    /*Metodo para  activar y leer el qr, hacer las dos operaciones en un sola**/
    public function ActivarQRAsistenteXEventoApp($idEvento,$cc)
    {
        $usuario=$this -> asistenteServicio ->ObtenerInformacionDelAsistenteXEvento($idEvento,$cc);
        $respuestaActivacion= $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento,$usuario->id);
        $informacionUsuario =['usuario'=>$usuario,'respuestaActivación'=>$respuestaActivacion];
        return response()->json($informacionUsuario);
    }

    public function ConfirmarAsistente(Request $formConfirma)
    {
        $cc = $formConfirma->Identificacion;
        $idEvento = $formConfirma->idEvento;
        $confirmaAsistencia = $formConfirma->confirmarAsistencia;
        
         $usuario=$this -> asistenteServicio ->ObtenerInformacionDelAsistenteXEvento($idEvento,$cc);
         $respuestaConfirmacion= $this->asistenteServicio->ConfirmarAsistencia($idEvento,$usuario->id,$confirmaAsistencia);
         $informacionUsuario =['usuario'=>$usuario,'respuestaConfirmacion'=>$respuestaConfirmacion];
         //return response()->json($informacionUsuario);
        return redirect('/');

    }

     /*Metodo que me retorna el formulario para la lectura del qr con el evento al que se le va a leer el qr**/
     public function ObtenerFormularioConfirmacionAsistente($idEvento)
     {
         return view('Evento/ConfirmarAsistencia',['Evento' => $this->eventoServicio->obtenerEvento($idEvento)]);
     }
}
