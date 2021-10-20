<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Datos\Modelos\PrecioBoleta;
use Illuminate\Support\Facades\Auth;
use PDF;
use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\DepartamentoServicio;
use Eco\Negocio\Logica\EstadisticasServicio;
use Eco\Negocio\Logica\EventosServicio;
use Illuminate\Http\Request;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;



class AsistentesController extends Controller
{
    protected $asistenteServicio;
    protected $eventoServicio;
    protected $EstadisticasServicios;
    protected $departamentoServicio;

    /**Metodo constructor de la clase.*/
    public function __construct(AsistenteServicio $asistenteServicio, EventosServicio $eventoServicio,
                                EstadisticasServicio $EstadisticasServicios, DepartamentoServicio $departamentoServicio)
    {
        //$this->middleware('auth');
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
        $this->EstadisticasServicios = $EstadisticasServicios;
        $this->departamentoServicio = $departamentoServicio;
    }

    public function registrarAsistentetem(Request $formRegistro)
    {
        $this->GenerarQRS($formRegistro);
    }

    /* Metodo para  registrar un asistente  cuando el evento es gratuito.**/
    public function registrarAsistente(Request $formRegistro)
    {
        $respuesta = $this->asistenteServicio->registrarAsistente($formRegistro);
        if ($respuesta == 'true') {
            $file = $formRegistro->imagen;
            $ccUser = $formRegistro->Identificacion;
            $pin = $formRegistro->pinIngresar;
            if ($pin) {
                $this->asistenteServicio->ActualizarPin($ccUser, $pin);
            }
            $correoElectronico = $formRegistro->Email;
            $evento = $this->eventoServicio->obtenerEvento($formRegistro->Evento_id);
            $ElementosArray = array('evento' => $evento);
            $correoSaliente = $evento->CorreoEnviarInvitacion;
            $nombreEvento = $evento->Nombre_Evento;

            //inicio prueba de concepto de envio de correos
            /*   $transport = (new Swift_SmtpTransport('mail.facin.co', 26,'tls'))
                   ->setUsername('info@facin.co')
                   ->setPassword('_}LH&oQc4.K_')
               ;
               // Create the Mailer using your created Transport
               $mailer = new Swift_Mailer($transport);
               // Create a message
               $message = (new Swift_Message('Wonderful Subject'))
                   ->setFrom(['info@ecotickets.co' => 'Diego Patino'])
                   ->setTo(['cristianmg13@hotmail.com' => 'A name'])
                   ->setBody('este es un mensaje de prueba');
               // Send the message
               $result = $mailer->send($message);
           ///fin prueba de concepto de envio de correos

           */
            Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($evento, $ccUser, $correoElectronico, $correoSaliente, $nombreEvento) {
                $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
                $msj->subject('Importante - Aquí esta tu pase de acceso');
                $msj->to($correoElectronico);
                $msj->bcc('soporteecotickets@gmail.com');
                $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $ccUser . 'ECOTICKETS'));
                $ElementosArray = array('evento' => $evento, 'qr' => $qr);
                //preguntamos si el directorio existe
                if (!file_exists(storage_path('app') . '/cortesias/'.$evento->id)) {
                    mkdir(storage_path('app') . '/cortesias/'.$evento->id, 0777, true);
                }
                \PDF::loadView('cortesia', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/cortesias/'.$evento->id.'/ECOTICKET' . $ccUser. '.pdf');
                $qrImagen = storage_path('app') . '/cortesias/'.$evento->id.'/ECOTICKET' . $ccUser . '.pdf';
                $msj->attach($qrImagen);
            });
            return view("respuesta", ['ElementosArray' => $ElementosArray]);
        } else {
            if ($respuesta == '2') {
                $ccUser = $formRegistro->Identificacion;
                return view('existente', ['identificacion' => $ccUser]);
            } else {
                return redirect('/');
            }
        }
    }

    /* Metodo para  registrar un asistente  cuando el evento es gratuito.**/
    public function registrarUsuario(Request $formRegistro)
    {
        $respuesta = $this->asistenteServicio->registrarAsistente($formRegistro);
        if ($respuesta == 'true') {
            $correoElectronico = $formRegistro->Email;
            $evento = $this->eventoServicio->obtenerEvento($formRegistro->Evento_id);
            $ElementosArray = array('evento' => $evento);
            $correoSaliente = $evento->CorreoEnviarInvitacion;
            $nombreEvento = $evento->Nombre_Evento;
            $ccUser = $formRegistro->Identificacion;
            Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($correoElectronico, $correoSaliente, $nombreEvento,$evento,$ccUser) {
                $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
                $msj->subject('Importante - Aquí esta tu pase de acceso');
                $msj->to($correoElectronico);
                $msj->bcc('soporteecotickets@gmail.com');
                $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $ccUser . 'ECOTICKETS'));
                $localidad =  new PrecioBoleta();
                $localidad->localidad ='Cortesia';
                $localidad->precio =0;
                $ElementosArray = array('evento' => $evento, 'qr' => $qr,'localidad'=>$localidad);
                //preguntamos si el directorio existe
                if (!file_exists(storage_path('app') . '/boletas/'.$evento->id)) {
                    mkdir(storage_path('app') . '/boletas/'.$evento->id, 0777, true);
                }
                \PDF::loadView('boletatest', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $ccUser. '.pdf');
                $qrImagen = storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $ccUser . '.pdf';
                $msj->attach($qrImagen);
            });
            return redirect("FormularioUsuario")->with('status', true);
        } else {
            if ($respuesta == '2') {
                $ccUser = $formRegistro->Identificacion;
                return view('existente', ['identificacion' => $ccUser]);
            } else {
                return redirect('/');
            }
        }
    }

    //Cuando se esta registrando un propecto(persona que posiblemente asistirá al evento)
    public function registrarProspectoYEnviarTicket(Request $formRegistro){

        try {
            $user = Auth::user();
            $respuesta = $this->asistenteServicio->registrarProspecto($formRegistro,$user->id);
            if ($respuesta['respuesta']) {
                $correoElectronico = $formRegistro->Email;
                $this->asistenteServicio->ActualizarPinBusquedaCorreo($correoElectronico);
                $listaAsistentesXEventosPines = $this->asistenteServicio->crearTicket($respuesta['infoPagoObject']);
                $evento = $this->eventoServicio->obtenerEvento($listaAsistentesXEventosPines['ListaAsistesEventoPines']->first()->Evento_id);
                $localidad = $listaAsistentesXEventosPines['localidad'];
                $ElementosArray = array('evento' => $evento);
                $correoSaliente = $evento->CorreoEnviarInvitacion;//PONER EL CORREO DE MANERA GENERAL
                $nombreEvento = $evento->Nombre_Evento;
                $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];
                Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($pinesImagenes, $correoElectronico, $correoSaliente, $nombreEvento, $evento, $localidad) {
                    $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
                    $msj->subject('Importante - Aquí esta tu pase de acceso');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
                    //preguntamos si el directorio existe
                    if (!file_exists(storage_path('app') . '/boletas/' . $evento->id)) {
                        mkdir(storage_path('app') . '/boletas/' . $evento->id, 0777, true);
                    }
                    foreach ($pinesImagenes as $pin) {
                        $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $pin->PinBoleta . 'ECOTICKETS'));
                        $ElementosArray = array('evento' => $evento, 'qr' => $qr, 'localidad' => $localidad);
                        \PDF::loadView('boletatest', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/boletas/' . $evento->id . '/ECOTICKET' . $pin->id . '.pdf');
                        $qrImagen = storage_path('app') . '/boletas/' . $evento->id . '/ECOTICKET' . $pin->id . '.pdf';
                        $msj->attach($qrImagen);
                    }
                });

                return redirect("FormularioUsuario")->with('status', true);
            }
            return redirect("FormularioUsuario")->with('respuestaError', true);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $archivo =  fopen(storage_path('app').'/log.txt','a');
            fwrite($archivo,$error);
            fclose($archivo);
            return redirect("FormularioUsuario")->with('respuestaError', false);
        }

    }

    /* Metodo para  registrar un promotor**/
    public function registrarPromotor(Request $formRegistro)
    {
        $respuesta = $this->asistenteServicio->registrarPromotor($formRegistro);
        if ($respuesta == 'true') {
            $correoElectronico = $formRegistro->Email;
            $sede = $this->eventoServicio->obtenerSede($formRegistro->Sede_id);
            $ElementosArray = array('sede' => $sede);
            $correoSaliente = 'info@loversfestival.com';
            $nombreEvento = $sede->Nombre;
            $ccUser = $formRegistro->Identificacion;
            Mail::send('Email/correoPromotor', ['ElementosArray' => $ElementosArray], function ($msj) use ($correoElectronico, $correoSaliente, $nombreEvento,$sede,$ccUser) {
                $msj->from($correoSaliente, 'Certificación Promotor ' . $nombreEvento);
                $msj->subject('Importante - Certificado Promotor');
                $msj->to($correoElectronico);
                $msj->bcc('soporteecotickets@gmail.com');
                $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $ccUser . 'ECOTICKETS'));
                $ElementosArray = array('sede' => $sede, 'qr' => $qr);
                //preguntamos si el directorio existe
                if (!file_exists(storage_path('app') . '/boletas/'.$sede->id)) {
                    mkdir(storage_path('app') . '/boletas/'.$sede->id, 0777, true);
                }
                \PDF::loadView('certificadoPromotor', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/boletas/'.$sede->id.'/ECOTICKET' . $ccUser. '.pdf');
                $qrImagen = storage_path('app') . '/boletas/'.$sede->id.'/ECOTICKET' . $ccUser . '.pdf';
                $msj->attach($qrImagen);
            });
            return redirect("FormularioPromotor")->with('status', true);;
        } else {
            if ($respuesta == '2') {
                $ccUser = $formRegistro->Identificacion;
                return view('existente', ['identificacion' => $ccUser]);
            } else {
                return redirect('/');
            }
        }
    }


    public function EnviarBoletas(Request $formRegistro)
    {
        return response()->json($this->asistenteServicio->registrarAsistentePago($formRegistro));
    }


    /*Metodo cuando se esta registrando un asistente que esta comprando una boleta.**/
    public function registrarAsistentePagoPostWebCheckout(Request $formRegistro)
    {
        return response()->json($this->asistenteServicio->registrarAsistentePago($formRegistro));
    }

    public function registrarAsistentePagoPost(Request $formRegistro)
    {
        $respuesta = $this->asistenteServicio->registrarAsistentePagoPayu($formRegistro);
        $resumenPago = new \stdClass();
        $resumenPago->CantidadTickets = $formRegistro->CantidadTickets;
        $resumenPago->PrecioUnidad = $respuesta['infoPago']->PrecioTotal/$formRegistro->CantidadTickets;
        $resumenPago->PrecioSubTotal = $respuesta['infoPago']->PrecioTotal;
        $resumenPago->NombreComprador = $formRegistro->Nombres ." ". $formRegistro->Apellidos;
        $resumenPago->Email = $formRegistro->Email;
        $resumenPago->Referencia = env('REFERENCECODE') . $respuesta['infoPago']->id;
        $resumenPago->Descripcion = env('DESCRIPCION');
        $resumenPago->Direccion = $formRegistro->Dirección;
        $resumenPago->Telefono = $formRegistro->telefono;
        $resumenPago->InfoPId = $respuesta['infoPago']->id;
        $resumenPago->nombreBoleta = $respuesta['infoPago']->nombreBoleta;
        $view = View::make('MPagos/ResumenPago')->with('InfoPago',$resumenPago);
        $sections = $view->renderSections();
        return Response::json($sections['ResumenPago']);
    }


    /*Metodo para generar qrs. sirve para reenviar las invitaciones**/
    public function GenerarQRS(Request $formRegistro)
    {
        $evento = $this->eventoServicio->obtenerEvento($formRegistro->Evento_id);
        $correoElectronico = $formRegistro->correo;
        $nombreEvento = $evento->Nombre_Evento;
        $correoSaliente = $evento->CorreoEnviarInvitacion;
        $pinUser= $formRegistro->pin;
        $ElementosArray = array('evento' => $evento);
        $listaAsistentesXEventosPines = $this->asistenteServicio->crearBoletas($pinUser, 4, 4);
        $localidad = $listaAsistentesXEventosPines['localidad'];
        $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];
        Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($correoElectronico, $correoSaliente, $nombreEvento,$evento,$pinUser,$localidad,$pinesImagenes) {
            $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
            $msj->subject('Importante - Aquí esta tu pase de acceso');
            $msj->to($correoElectronico);
            $msj->bcc('soporteecotickets@gmail.com');
            $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $pinUser . 'ECOTICKETS'));
            $ElementosArray = array('evento' => $evento, 'qr' => $qr);
            //preguntamos si el directorio existe
            if (!file_exists(storage_path('app') . '/boletas/'.$evento->id)) {
                mkdir(storage_path('app') . '/boletas/'.$evento->id, 0777, true);
            }
            foreach ($pinesImagenes as $pin) {
                $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $pin->PinBoleta . 'ECOTICKETS'));
                $ElementosArray = array('evento' => $evento, 'qr' => $qr,'localidad'=>$localidad);
                \PDF::loadView('boletatest', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $pin->id . '.pdf');
                $qrImagen = storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $pin->id . '.pdf';
                $msj->attach($qrImagen);
            }
        });
        return redirect('/home');
    }

    /**Metodo de respuesta de la plataforma de pagos payu para el envio de  la  boleta al correo electronico, el  llamado
     * se hace de  manera asincronica.Metodo de comunicacion entre sistemas.**/
    public function RespuestaPagos(Request $formRegistro)
    {
        try {
            $correoElectronico = $formRegistro->email_buyer;
            $medioPago = $formRegistro->payment_method_id;
            $merchantId = $formRegistro->merchant_id;
            $referenciaVenta = $formRegistro->reference_sale;
            $valor = $formRegistro->value;
            $moneda = $formRegistro->currency;
            $estadoVenta = $formRegistro->state_pol;
            $firmaVenta = $formRegistro->sign;
            //NOTA:linea para verificar la informacion enviada  por payu
            $verficarFirma = $this->asistenteServicio->validarFirmaPago($merchantId, $referenciaVenta, $valor, $moneda, $estadoVenta, $firmaVenta);
            //$verificarfirma:1 para la validacion de la firma es correcta
            //$verificarfirma:0 para la validacion de la firma es incorrecta
            $verficarFirma = 1;
            $estadoVenta = 4;
            if ($estadoVenta == 4 && $verficarFirma == 1) {
                $this->asistenteServicio->ActualizarPinBusquedaCorreo($formRegistro->email_buyer);
                $listaAsistentesXEventosPines = $this->asistenteServicio->crearBoletas($referenciaVenta, $estadoVenta, $medioPago);
                $evento = $this->eventoServicio->obtenerEvento($listaAsistentesXEventosPines['ListaAsistesEventoPines']->first()->Evento_id);
                $localidad = $listaAsistentesXEventosPines['localidad'];
                $ElementosArray = array('evento' => $evento);
                $correoSaliente = $evento->CorreoEnviarInvitacion;
                $nombreEvento = $evento->Nombre_Evento;
                $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];
                Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($pinesImagenes, $correoElectronico, $correoSaliente, $nombreEvento, $evento,$localidad) {
                    $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
                    $msj->subject('Importante - Aquí esta tu pase de acceso');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
                    //preguntamos si el directorio existe
                    if (!file_exists(storage_path('app') . '/boletas/'.$evento->id)) {
                        mkdir(storage_path('app') . '/boletas/'.$evento->id, 0777, true);
                    }
                    $archivo =  fopen(storage_path('app').'/log.txt','a');
                    fwrite($archivo,'HOLA3');
                    fclose($archivo);
                    foreach ($pinesImagenes as $pin) {
                        $qr = base64_encode(\QrCode::format('png')->merge(env('RUTAICONOPEQUENIOPROSPECTOADMIN'))->size(280)->generate($nombreEvento . ' - CC - ' . $pin->PinBoleta . 'ECOTICKETS'));
                        $ElementosArray = array('evento' => $evento, 'qr' => $qr,'localidad'=>$localidad);
                        \PDF::loadView('boletatest', ['ElementosArray' => $ElementosArray])->save(storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $pin->id . '.pdf');
                        $qrImagen = storage_path('app') . '/boletas/'.$evento->id.'/ECOTICKET' . $pin->id . '.pdf';
                        $msj->attach($qrImagen);
                    }
                });
            } else {
                // se actualiza la informmacion del pago cuando el estado de la transaccion es diferente a 4
                $this->asistenteServicio->actualizarInfoPagos($referenciaVenta, $estadoVenta, $medioPago);
            }
            return response('OK', 200);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $archivo =  fopen(storage_path('app').'/log.txt','a');
            fwrite($archivo,$error);
            fclose($archivo);
            return response('ERROR', 404);
        }
    }



    /**Metodo de respuesta de la plataforma payu para mostrar el mensaje al usuario sobre el estado de la transaccion.
     * el llamado se hace cuando se presiona el boton de regresar al sitio. WebCheckout*/
    public function RespuestaPagosUsuarioWebCheckout()
    {
        $estadoTransaccion = $_REQUEST['transactionState'];
        $transaccionReference = $_REQUEST['referenceCode'];
        $medioPago = $_REQUEST['polPaymentMethodType'];
        $evento = $this->asistenteServicio->ObtenerEventoRefe($transaccionReference);
        switch ($estadoTransaccion) {
            case 4: /* Approved */
                $ElementosArray = array('evento' => $evento, 'mensaje' => "APROBADO");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;

            case 7: /* Pending*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "PENDIENTE");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;

            case 6: /* Declined*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "DECLINADO");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;

            case 104: /* Error*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "ERROR");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;

            case 5: /* Expired*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "EXPIRADO");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;

            default: /* Do something */
                $ElementosArray = array('evento' => $evento, 'mensaje' => "PENDIENTE POR PAYU");
                return view("respuestaPago", ['ElementosArray' => $ElementosArray]);
                break;
        }
        $ccUser = $transaccionReference;
        return view('existente', ['identificacion' => $ccUser]);// se debe cambiar
    }

    /*Metodo para validar si el pin ingresado el formulario es valido.*/
    public function validarPIN($idPin)
    {
        return response()->json($this->asistenteServicio->validarPIN($idPin));
    }

    /*Metodo que me retorna un array con los cantidad de usuarios registrados,esperados y asistentes.**/
    public function ObtnerCantidadAsistentes($idEvento)
    {
        $CantidadRegistrados = $this->asistenteServicio->ObtnerCantidadAsistentes($idEvento);
        $CantidadEsperada = $this->eventoServicio->obtenerEvento($idEvento)->numeroAsistentes;
        $CantidadAsistentes = $this->EstadisticasServicios->NumeroAsistentes($idEvento);
        $cantidadAsistentes = ['CantidadEsperada' => $CantidadEsperada, 'CantidadRegistrados' => $CantidadRegistrados,
            'CantidadAsistentes' => $CantidadAsistentes];
        return response()->json($cantidadAsistentes);
    }

    /**Metodo que me retorna un asistente o usuario registrado al evento, se realiza la busqueda por mmedio de la
     * identificación.*/
    public function ObtenerAsistente($cc)
    {
        return response()->json($this->asistenteServicio->ObtenerAsistente($cc));
    }

    /*Metodo que me retorna el formulario para la lectura del qr con el evento al que se le va a leer el qr**/
    public function FormularioQR(Request $request,$idEvento)
    {
        $urlinfo= $request->getPathInfo();
        $urlinfo = explode('/'.$idEvento,$urlinfo)[0];
        $request->user()->AutorizarUrlRecurso($urlinfo);
        return view('Evento/LecturaQR', ['Evento' => $this->eventoServicio->obtenerEvento($idEvento)]);
    }

    /*Metodo que me retorna la informacion del asistente, se realza la busqueda por id del evento y por la identificacion
    del usuario**/
    public function ObtenerInformacionDelAsistenteXEvento($idEvento, $cc)
    {
        return response()->json($this->asistenteServicio->ObtenerInformacionDelAsistenteXEvento($idEvento, $cc));
    }

    /*Metodo para  activar el qr del asistente al evento, recibe  como parametros el id del evento y el id  del asistente
    o usuario**/
    public function ActivarQRAsistenteXEvento($idEvento, $idAsistente, $cc)
    {
        return $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento, $idAsistente, $cc);
    }

    /*Metodo que me retornar los usuarios que asistienron al evento**/
    public function AsistentesActivos($idEvento)
    {
        $ListaUsuarios = array('usuariosRegistrados' => $this->asistenteServicio->obtenerAsistentesXEvento($idEvento),
            'Asistentes' => $this->asistenteServicio->AsistentesActivos($idEvento));
        return response()->json($ListaUsuarios);
    }

    /*Metodo para  activar y leer el qr, hacer las dos operaciones en un sola**/
    public function ActivarQRAsistenteXEventoApp($idEvento, $cc)
    {
        $usuario = $this->asistenteServicio->ObtenerInformacionDelAsistenteXEvento($idEvento, $cc);
        $respuestaActivacion = '';
        if ($usuario != null) {
            $respuestaActivacion = $this->asistenteServicio->ActivarQRAsistenteXEvento($idEvento, $usuario->id, $cc);
        } else {
            //$respuestaActivacion = 'USUARIO NO REGISTRADO';
            $respuestaActivacion = $this->asistenteServicio->ActivarPinPago($idEvento, $cc);
        }
        //$informacionUsuario = ['usuario' => $usuario, 'respuestaActivacion' => $respuestaActivacion];
        return response()->json($respuestaActivacion);
    }

    public function ConfirmarAsistente(Request $formConfirma)
    {
        $cc = $formConfirma->Identificacion;
        $idEvento = $formConfirma->idEvento;
        $confirmaAsistencia = $formConfirma->confirmarAsistencia;
        $usuario = $this->asistenteServicio->ObtenerInformacionDelAsistenteXEvento($idEvento, $cc);
        if ($usuario != NULL) {
            $respuestaConfirmacion = $this->asistenteServicio->ConfirmarAsistencia($idEvento, $usuario->id, $confirmaAsistencia);
            $informacionUsuario = array('usuario' => $usuario, 'respuestaConfirmacion' => $respuestaConfirmacion, 'Evento' => $this->eventoServicio->obtenerEvento($idEvento));
            return view('Evento/RespuestaConfirmarAsistencia', $informacionUsuario);
        }
        $informacionUsuario = array('usuario' => $cc, 'respuestaConfirmacion' => 'No esta Registrada en:', 'Evento' => $this->eventoServicio->obtenerEvento($idEvento));
        return view('Evento/RespuestaConfirmarAsistenciaNoUser', $informacionUsuario);
    }

    /*Metodo que me retorna el formulario para la lectura del qr con el evento al que se le va a leer el qr**/
    public function ObtenerFormularioConfirmacionAsistente($idEvento)
    {
        return view('Evento/ConfirmarAsistencia', ['Evento' => $this->eventoServicio->obtenerEvento($idEvento)]);
    }

    /*Metodo para  activar el PIN  de la boleta paga, recibe  como parametros el id del evento y PIN de la boleta**/
    public function ActivarPinPago($idEvento, $idPin)
    {
       // return $this->asistenteServicio->ActivarPinPago($idEvento, $idPin);
        return response()->json($this->asistenteServicio->ActivarPinPago($idEvento, $idPin));
    }

    /*Metodo para  Desactivar el qr del asistente al evento, recibe  como parametros el id del evento y el id  del asistente
   o usuario**/
    public function DesactivarQRAsistenteXEvento($idEvento,$idAsistente)
    {
        return $this->asistenteServicio->DesactivarQRAsistenteXEvento($idEvento,$idAsistente);
    }

    //metodo que registrar un usuario al evento desde el administrador
    public function obtenerFormularioUsuario(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $user = $request->user();
        $user->AutorizarUrlRecurso($urlinfo);
        $idSede = $user->Sede->id;
        $eventos=null;
        $idEmpreesa = $user->Sede->Empresa->id;
        if($user->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
        }else{
            if($user->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ListaDeEventosSede($idSede,'Evento');
            }
        }
        $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
        $ElementosArray = array('eventos' => $eventos, 'departamentos' => $departamentos,);
        return view('Evento/RegistrarUsuario', ['ElementosArray' => $ElementosArray])->with('respuestaError', false);
    }

    public function obtenerFormularioPromotor(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $request->user()->AutorizarUrlRecurso($urlinfo);
        $user = Auth::user();
        $sedes = $this->eventoServicio->ObtenerMisSedes($user->id);
        $departamentos = $this->departamentoServicio->obtenerDepartamento();// se obtiene la lista de departamentos para mostrar en el formulario
        $ElementosArray = array('sedes' => $sedes, 'departamentos' => $departamentos,);
        return view('Evento/RegistrarPromotor', ['ElementosArray' => $ElementosArray]);

    }

    //Metodo para obtener el formualario para registrar y enviar invitaciones masivamentes
    public  function obtenerFormularioInvitaciones(){
        $eventos = $this->eventoServicio->obtenerEventos();
        return view('Evento/RegistrarYEnviarInvitacion',['eventos'=>$eventos]);
    }

    //Metodo para obtener el formualario para registrar y Reenviar invitaciones
    public  function obtenerFormularioReenviarInvitacion(){
        $eventos = $this->eventoServicio->obtenerEventos();
        return view('Evento/ReenviarInvitacion',['eventos'=>$eventos]);
    }

    //Metodo para cargar  la vista de crear el tipo de documento
    public function CargarUsuariosXEvento($idEvento)
    {
        $listaUsuarios = $this->asistenteServicio->obtenerAsistentesXEvento($idEvento);
        $view = View::make('Evento/UsuariosXEvento')->with('listaUsuario',$listaUsuarios);;
        $sections = $view->renderSections();
        return Response::json($sections['UsuarioXEvento']);
    }

    public function  ActualizarEventosFecha(){
        $this->asistenteServicio->ActualizarEventosFecha();
    }

    public function obtenerPromotoresXEvento($idEvento){
    return response()->json($this->asistenteServicio->obtenerPromotoresXEvento($idEvento));
    }


}
