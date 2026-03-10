<?php

namespace Ecotickets\Http\Controllers\Evento;


use Eco\Datos\Modelos\PrecioBoleta;
use Eco\Negocio\Logica\ConvenioServicio;
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
    protected $convenioServicio;

    /**Metodo constructor de la clase.*/
    public function __construct(AsistenteServicio $asistenteServicio, EventosServicio $eventoServicio,
                                EstadisticasServicio $EstadisticasServicios, DepartamentoServicio $departamentoServicio,
                                ConvenioServicio $convenioServicio)
    {
        //$this->middleware('auth');
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
        $this->EstadisticasServicios = $EstadisticasServicios;
        $this->departamentoServicio = $departamentoServicio;
       $this->convenioServicio = $convenioServicio;
    }

    public function registrarAsistentetem(Request $formRegistro)
    {
        $this->GenerarQRS($formRegistro);
    }

    /* Metodo para  realizar la prueba de concepto del envio del correo cambiando de cuenta.**/
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
                $msj->subject('¡Importante! Este es tu Ecoticket.');
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
                $msj->subject('¡Importante! Este es tu Ecoticket.');
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
            //return redirect("FormularioUsuario")->with('status', true);
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

    //Cuando se esta registrando un propecto(persona que posiblemente asistirá al evento)
    public function registrarProspectoYEnviarTicket(Request $formRegistro){

        try {
            // Defaults para que no sea obligatorio fechaNacimiento ni Dirección desde el módulo admin
            $this->aplicarDefaultsRegistroProspectoAdmin($formRegistro);
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
                    $msj->subject('¡Importante! Este es tu Ecoticket.');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
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

    public function descargarPlantillaUsuariosCortesia()
    {
        $csv = "Identificacion,Nombres,Apellidos,telefono,Email\n";
        $csv .= "1234567890,Camilo,Blandon,3001234567,camilo@example.com\n";

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="plantilla-usuarios-cortesia.csv"',
        ]);
    }

    public function registrarProspectoMasivoYEnviarTicket(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'archivoUsuarios' => 'required|file|mimes:csv,txt,xlsx',
                'Evento_id' => 'required',
                'Departamento_id' => 'required',
                'Ciudad_id' => 'required',
                'localidad' => 'required',
                'CantidadTickets' => 'required|integer|min:1',
            ]);

            $archivo = $request->file('archivoUsuarios');
            $extension = strtolower($archivo->getClientOriginalExtension());
            $path = $archivo->getRealPath();

            $usuarios = $this->leerUsuariosDesdeArchivo($path, $extension);

            $ok = 0;
            $fail = 0;
            $errores = [];

            foreach ($usuarios as $idx => $u) {
                $rowNumber = $idx + 2; // asumiendo encabezados en la fila 1

                $payload = [
                    'Identificacion' => trim($u['Identificacion'] ?? ''),
                    'Nombres' => trim($u['Nombres'] ?? ''),
                    'Apellidos' => trim($u['Apellidos'] ?? ''),
                    'telefono' => trim($u['telefono'] ?? ''),
                    'Email' => trim($u['Email'] ?? ''),
                    'confEmail' => trim($u['Email'] ?? ''),
                    'fechaNacimiento' => $u['fechaNacimiento'] ?? null,
                    'Dirección' => $u['Dirección'] ?? ($u['Direccion'] ?? null),
                    'Edad' => isset($u['Edad']) && $u['Edad'] !== '' ? (int)$u['Edad'] : 0,
                    'Departamento_id' => $request->Departamento_id,
                    'Ciudad_id' => $request->Ciudad_id,
                    'Evento_id' => $request->Evento_id,
                    'localidad' => $request->localidad,
                    'CantidadTickets' => (int)$request->CantidadTickets,
                    'esActivo' => 0,
                    'esPerfilado' => 0,
                    'terminos' => 1,
                    'HabeasData' => 1,
                    'ComentarioEvento' => 'BoletaEnviadaModuloUsuarioMasivo',
                    'Promotor_id' => 0,
                    'esPago' => 1,
                ];

                if ($payload['Identificacion'] === '' || $payload['Email'] === '') {
                    $fail++;
                    $errores[] = "Fila {$rowNumber}: faltan Identificacion o Email";
                    continue;
                }

                $rowRequest = new Request();
                $rowRequest->replace($payload);
                $this->aplicarDefaultsRegistroProspectoAdmin($rowRequest);

                $respuesta = $this->asistenteServicio->registrarProspecto($rowRequest, $user->id);
                if (!isset($respuesta['respuesta']) || $respuesta['respuesta'] !== true) {
                    $fail++;
                    $errores[] = "Fila {$rowNumber}: no se pudo registrar (Email: {$payload['Email']})";
                    continue;
                }

                $correoElectronico = $payload['Email'];
                $this->asistenteServicio->ActualizarPinBusquedaCorreo($correoElectronico);

                $listaAsistentesXEventosPines = $this->asistenteServicio->crearTicket($respuesta['infoPagoObject']);
                $evento = $this->eventoServicio->obtenerEvento($listaAsistentesXEventosPines['ListaAsistesEventoPines']->first()->Evento_id);
                $localidad = $listaAsistentesXEventosPines['localidad'];
                $ElementosArray = array('evento' => $evento);
                $correoSaliente = $evento->CorreoEnviarInvitacion;
                $nombreEvento = $evento->Nombre_Evento;
                $pinesImagenes = $listaAsistentesXEventosPines['ListaAsistesEventoPines'];

                Mail::send('Email/correo', ['ElementosArray' => $ElementosArray], function ($msj) use ($pinesImagenes, $correoElectronico, $correoSaliente, $nombreEvento, $evento, $localidad) {
                    $msj->from($correoSaliente, 'Invitación ' . $nombreEvento);
                    $msj->subject('¡Importante! Este es tu Ecoticket.');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
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

                $ok++;
            }

            $resumen = "Enviados: {$ok}. Fallidos: {$fail}.";
            if (count($errores) > 0) {
                $resumen .= " Revisa log para detalles.";
                $archivoLog = fopen(storage_path('app') . '/log_carga_masiva.txt', 'a');
                fwrite($archivoLog, "\n" . date('Y-m-d H:i:s') . " - Errores carga masiva:\n" . implode("\n", $errores) . "\n");
                fclose($archivoLog);
            }

            return redirect("FormularioUsuario")->with('masivoResumen', $resumen);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $archivoLog = fopen(storage_path('app') . '/log_carga_masiva.txt', 'a');
            fwrite($archivoLog, "\n" . date('Y-m-d H:i:s') . " - ERROR: " . $error . "\n");
            fclose($archivoLog);
            return redirect("FormularioUsuario")->with('respuestaError', true);
        }
    }

    private function aplicarDefaultsRegistroProspectoAdmin(Request $request)
    {
        if (!$request->has('confEmail') && $request->has('Email')) {
            $request->merge(['confEmail' => $request->Email]);
        }
        if (!$request->has('Edad')) {
            $request->merge(['Edad' => 0]);
        }
        $direccion = $request->input('Dirección');
        if ($direccion === null || trim((string)$direccion) === '') {
            $request->merge(['Dirección' => 'NA']);
        }
    }

    private function leerUsuariosDesdeArchivo($path, $extension)
    {
        if ($extension === 'csv' || $extension === 'txt') {
            return $this->leerUsuariosCsv($path);
        }
        if ($extension === 'xlsx') {
            return $this->leerUsuariosXlsx($path);
        }
        throw new \Exception("Formato no soportado: {$extension}");
    }

    private function leerUsuariosCsv($path)
    {
        $handle = fopen($path, 'r');
        if (!$handle) {
            throw new \Exception("No fue posible leer el archivo CSV");
        }

        $firstLine = fgets($handle);
        if ($firstLine === false) {
            fclose($handle);
            return [];
        }

        $delimiter = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
        $headersRaw = str_getcsv(trim($firstLine), $delimiter);
        $headers = $this->normalizarHeaders($headersRaw);

        $rows = [];
        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            if (count($data) === 1 && trim((string)$data[0]) === '') {
                continue;
            }
            $row = [];
            foreach ($headers as $i => $key) {
                $row[$key] = $data[$i] ?? null;
            }
            $rows[] = $this->mapearRowUsuario($row);
        }
        fclose($handle);

        return $rows;
    }

    private function leerUsuariosXlsx($path)
    {
        if (!class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            throw new \Exception("Falta dependencia para leer Excel (PhpSpreadsheet).");
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, false);
        if (!$data || count($data) < 2) {
            return [];
        }

        $headersRaw = $data[0];
        $headers = $this->normalizarHeaders($headersRaw);

        $rows = [];
        for ($i = 1; $i < count($data); $i++) {
            $line = $data[$i];
            $row = [];
            foreach ($headers as $colIdx => $key) {
                $row[$key] = $line[$colIdx] ?? null;
            }
            $rows[] = $this->mapearRowUsuario($row);
        }

        return $rows;
    }

    private function normalizarHeaders($headersRaw)
    {
        $headers = [];
        foreach ($headersRaw as $h) {
            $h = trim((string)$h);
            $hLower = mb_strtolower($h);
            $hLower = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $hLower);
            $hLower = preg_replace('/\s+/', '', $hLower);
            $headers[] = $hLower;
        }
        return $headers;
    }

    private function mapearRowUsuario($row)
    {
        // Acepta variantes de encabezados
        return [
            'Identificacion' => $row['identificacion'] ?? null,
            'Nombres' => $row['nombres'] ?? null,
            'Apellidos' => $row['apellidos'] ?? null,
            'telefono' => $row['telefono'] ?? ($row['celular'] ?? null),
            'Email' => $row['email'] ?? ($row['correo'] ?? null),
            'Direccion' => $row['direccion'] ?? null,
            'Dirección' => $row['direccion'] ?? null,
            'fechaNacimiento' => $row['fechanacimiento'] ?? null,
            'Edad' => $row['edad'] ?? null,
        ];
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
            $msj->subject('¡Importante! Este es tu Ecoticket.');
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
            $archivo =  fopen(storage_path('app').'/log.txt','a');
            fwrite($archivo,'CORREO ELECTRONICO: '. $correoElectronico . 'MEDIO DE PAGO: ' . $medioPago . 'MERCHANNT ID : '.
                $merchantId . 'REFERENCIA DE VENTA: ' . $referenciaVenta . 'VALOR: '.$valor. 'MONEDA: '.$moneda. 'ESTADO VENTA: '.$estadoVenta.
                'FIRMA: ' . $firmaVenta .'verificar firma: ' . $verficarFirma);
            fclose($archivo);
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
                    $msj->subject('¡Importante! Este es tu Ecoticket.');
                    $msj->to($correoElectronico);
                    $msj->bcc('soporteecotickets@gmail.com');
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
        $CantidadRegistrados = $CantidadRegistrados - $CantidadAsistentes;
        $cantidadAsistentes = ['CantidadEsperada' => $CantidadEsperada, 'CantidadRegistrados' => $CantidadRegistrados,
            'CantidadAsistentes' => $CantidadAsistentes];
        return response()->json($cantidadAsistentes);
    }

    /**Metodo que me retorna un asistente o usuario registrado al evento, se realiza la busqueda por mmedio de la
     * identificación.*/
    public function ObtenerAsistente($cc, $idEvento)
    {
        try {
            // Obtener el convenio
            $convenio = $this->convenioServicio->obtenerConveniosPorEvento($idEvento);
            
            // Si no hay convenio, tratar como asistente normal sin descuentos
            if (!$convenio) {
                \Log::channel('daily')->info('Evento sin convenio', ['idEvento' => $idEvento]);
                return response()->json(['asistente' => $this->asistenteServicio->ObtenerAsistente($cc)]);
            }
            
            // Intentar consultar afiliación con timeout
            $resultAfiliación = null;
            try {
                // Establecer un timeout para esta operación
                $resultAfiliación = $this->convenioServicio->consultarAfiliacion($cc, $convenio);
                
                // Verificar si la respuesta es un array con error (compatible con tu código actual)
                if (is_array($resultAfiliación) && isset($resultAfiliación['error'])) {
                    \Log::channel('daily')->warning('Error al consultar afiliación', [
                        'mensaje' => $resultAfiliación['mensaje'] ?? 'Error desconocido',
                        'cc' => $cc,
                        'idEvento' => $idEvento
                    ]);
                    // Si hay error en la afiliación, tratarlo como usuario normal sin descuentos
                    return response()->json(['asistente' => $this->asistenteServicio->ObtenerAsistente($cc)]);
                }
            } catch (\Exception $e) {
                \Log::channel('daily')->error('Excepción al consultar afiliación', [
                    'mensaje' => $e->getMessage(),
                    'cc' => $cc,
                    'idEvento' => $idEvento
                ]);
                // Si hay excepción, tratarlo como usuario normal sin descuentos
                return response()->json(['asistente' => $this->asistenteServicio->ObtenerAsistente($cc)]);
            }
            
            // Verificar si tenemos la propiedad datosBasicos y nomTarifa
            // Este es un extra de validación para evitar errores por estructura incorrecta
            if (!isset($resultAfiliación->datosBasicos) || 
                !isset($resultAfiliación->datosBasicos->nomTarifa)) {
                \Log::channel('daily')->warning('Respuesta de afiliación incompleta', [
                    'cc' => $cc,
                    'idEvento' => $idEvento
                ]);
                // Si falta información en la respuesta, tratarlo como usuario normal sin descuentos
                return response()->json(['asistente' => $this->asistenteServicio->ObtenerAsistente($cc)]);
            }
            
            // Ya tenemos una respuesta válida, ahora validamos la tarifa o compra previa
            if ($resultAfiliación->datosBasicos->nomTarifa == 'Tarifa D' || 
                $this->convenioServicio->yaTieneCompraConvenio($idEvento, $cc) > 0) {
                return response()->json(['asistente' => $this->asistenteServicio->ObtenerAsistente($cc)]);
            } else {
                return response()->json([
                    'asistente' => $this->asistenteServicio->ObtenerAsistente($cc),
                    "preciosBoletas" => $this->convenioServicio->generarPreciosBoletasDesc($resultAfiliación, $idEvento)
                ]);
            }
        } catch (\Exception $e) {
            \Log::channel('daily')->error('Error general en ObtenerAsistente', [
                'mensaje' => $e->getMessage(),
                'cc' => $cc,
                'idEvento' => $idEvento,
                'trace' => $e->getTraceAsString()
            ]);
            
            // En caso de error general, devolver una respuesta de error amigable
            return response()->json([
                'error' => true,
                'mensaje' => 'Ocurrió un error al procesar la solicitud. Por favor, intente nuevamente.'
            ], 500);
        }
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

    /*Metodo que me retorna la informacion del asistente, se realza la busqueda por id del evento y por el id del pdf**/
    public function ObtenerInformacionDelAsistenteXEventoWeb($idEvento, $numPdf)
    {
        return response()->json($this->asistenteServicio->ObtenerInformacionDelAsistenteXEventoWeb($idEvento, $numPdf));
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
    public function ActivarPinPago($idEvento, $idPin, $idUsuarioLectura)
    {
        return response()->json($this->asistenteServicio->ActivarPinPago($idEvento, $idPin, $idUsuarioLectura));
    }

    /*Metodo para  Desactivar el qr del asistente al evento, recibe  como parametros el id del evento y el id  del asistente
   o usuario**/
    public function DesactivarQRAsistenteXEvento($idEvento,$idAsistente)
    {
        return $this->asistenteServicio->DesactivarQRAsistenteXEvento($idEvento,$idAsistente);
    }

    //metodo que cargar el formulario para registrar un prospecto(persona que posiblemente ira el evento) desde el admin
    public function obtenerFormularioUsuario(Request $request)
    {
        $urlinfo= $request->getPathInfo();
        $user = $request->user();
        $user->AutorizarUrlRecurso($urlinfo);
        $eventos=null;
        $idEmpreesa = $user->Sede->Empresa->id;
        $idUser = Auth::user()->id;
        if($user->hasRole(env('IdRolSuperAdmin'))){
            $eventos = $this->eventoServicio->ListaDeEventosSuperAdmin('Evento');
        }else{
            if($user->hasRole(env('IdRolAdmin'))){
                $eventos = $this->eventoServicio->ListaDeEventosEmpresa($idEmpreesa,'Evento');
            }else{
                $eventos = $this->eventoServicio->ObtenerEventosUsuario($idUser);
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

    public function ObtenerListaTickets(Request $request,$idEvento,$idAsistente)
    {
        $urlinfo= $request->getPathInfo();
        $user = $request->user();
        //$user->AutorizarUrlRecurso($urlinfo);
        $idUser = Auth::user()->id;
        $listaTickets = null;
        if($user->hasRole(env('IdRolUsuarioComprador'))){
            $listaTickets = $this -> asistenteServicio ->obtenerListaTicketsPorComprador($idEvento,$idUser);
        }else{
            if($user->hasRole(env('IdRolSuperAdmin'))){
                $listaTickets = $this -> asistenteServicio ->obtenerListaTicketsPorCompradorSAdmin($idEvento,$idAsistente);
            }else{
                if($user->hasRole(env('IdRolAdmin'))){
                    $listaTickets = $this -> asistenteServicio ->obtenerListaTicketsPorCompradorAdmin($idEvento,$idAsistente);
                }else{
                    $listaTickets = $this -> asistenteServicio ->obtenerListaTicketsPorCompradorOtroRol($idEvento,$idAsistente,$idUser);
                }
            }
        }
        return view('Evento/ListaTickets',['listaTickets'=>$listaTickets,'idEvento'=>$idEvento]);
    }
    public function anularTicket(Request $request){
        $urlinfo= $request->getPathInfo();
        $user = $request->user();
        $user->AutorizarUrlRecurso($urlinfo);
        $idAsistenteEvento =  $request['idTicket'];
        $idUser = Auth::user()->id;
        $respuesta = $this->asistenteServicio->anularTicket($idAsistenteEvento,$idUser);
        if($respuesta == true){
            return Response::json(['STATUS'=>'SUCCESS']);
        }else{
            return Response::json(['STATUS'=>'ERROR']);
        }

    }

    public function descargarTicket(Request $request,$idEvento,$idAsistente){
        $urlinfo= $request->getPathInfo();
        $user = $request->user();
        $user->AutorizarUrlRecurso($urlinfo);
        $file=storage_path('app') . '/boletas/' . $idEvento . '/ECOTICKET' . $idAsistente . '.pdf';
        return Response::download($file);
    }



}
