<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
**/
Auth::routes();

/* INICIO VISTAS SIN CONTROLADOR*/

    Route::get('/respuesta', function () {return view('respuesta');});

    Route::get('/confirmarAsistencia', function () {return view('Evento/ConfirmarAsistencia');});

    Route::get('/existente', function () {return view('existente');});

    Route::get('vistaCorreo', function () {return view('Email.correo');});

    Route::get('/habeasData', function () { return view('habeasData');});

    Route::get('/terminosCondiciones', function () {return view('terminosCondiciones');});

    Route::get('/respuestaPago', function () {return view('respuestaPago');});

/*FIN VISTAS SIN CONTROLADOR*/

// INICIO DE RUTAS PARA EL CONTROLADOR DE HOME//

    /**Retorna  el home de los usuario mostrando los eventos creados por él*/
    Route::get('/home', 'HomeController@index')->name('home');

// FIN DE RUTAS PARA EL CONTROLADOR DE HOME//

// INICIO DE RUTAS PARA EL CONTROLADOR DE ECOTICKETS//

    Route::get('/', ['uses' =>'Ecotickets\EcoticketsController@welcome']);

    Route::get('Eventos', ['uses' =>'Ecotickets\EcoticketsController@ObtenerEventos']);

    Route::get('Cupones', ['uses' =>'Ecotickets\EcoticketsController@ObtenerCupones']);

    Route::get('FormularioAsistente/{idEvento}', ['uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistente']);/** Obtiene el formulario del evento*/

    Route::get('FormularioAsistentePago/{idEvento}', ['uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistentePago']);/** Obtiene el formulario del evento pago*/

    Route::post('pin/{idPin}',['uses' =>'Ecotickets\EcoticketsController@validarPIN']);/*Valida el pin*/

// FIN DE RUTAS PARA EL CONTROLADOR DE ECOTICKETS//

// INICIO DE RUTAS PARA EL CONTROLADOR DE EVENTOS//


    Route::get('FormularioEvento', 'Evento\EventosController@obtenerFormularioEvento')->name('CrearEvento');/*Obtiene el formulario para guardar un evento*/

    Route::get('MisEventos', 'Evento\EventosController@ObtenerMisEventos')->name('MisEventos');/*Obtener mi eventos*/

    Route::get('ActivarFunciones', 'Evento\EventosController@FormularioActivarFunciones')->name('ActivarFunciones');

    Route::post('crearEvento',['uses' =>'Evento\EventosController@crearEvento']);/*Guarda el evento del organizador*/

    Route::get('ListaAsistentes/{idEvento}',['uses' =>'Evento\EventosController@ObtenerListaAsistentes']);

    Route::get('Estadisticas/{idEvento}',['uses' =>'Evento\EventosController@obtenerEstadisticas']);

    Route::post('ActivarEventoPago/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarEventoPago']);

    Route::post('ActivarTienda/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarTienda']);

    Route::post('ActivarSolicitarPIN/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarSolicitarPIN']);

    Route::post('ActivarEsPublico/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarEsPublico']);

// FIN DE RUTAS PARA EL CONTROLADOR DE EVENTOS//

// INICIO DE RUTAS PARA EL CONTROLADOR DE ASISTENTES//

    Route::post('registrarAsistente',['uses' =>'Evento\AsistentesController@registrarAsistente']);

    Route::post('FormularioAsistentePago',['uses' =>'Evento\AsistentesController@registrarAsistentePagoPost']);

    Route::post('RespuestaPagos',['uses' =>'Evento\AsistentesController@RespuestaPagos']);

    Route::get('RespuestaPagosUsuario',['uses' =>'Evento\AsistentesController@RespuestaPagosUsuario']);

    Route::post('ActivarQR/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento']);

    Route::post('CantidadAsistentes/{idEvento}',['uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes']);

    Route::post('asistenteResgistrado/{cc}',['uses' =>'Evento\AsistentesController@ObtenerAsistente']);

    Route::get('LecturaQR/{idEvento}',['uses' =>'Evento\AsistentesController@FormularioQR']);

    Route::post('InformacionQR/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEvento']);

// FIN DE RUTAS PARA EL CONTROLADOR DE ASISTENTES//

// INICIO DE RUTAS PARA EL CONTROLADOR DE ESTADISTICAS //

    Route::post('AsistentesXCiudad/{idEvento}',['uses' =>'Evento\EstadisticasController@ObtenerAsistentesXCiudad']);

    Route::post('EdadesAsistentes/{idEvento}',['uses' =>'Evento\EstadisticasController@RangoDeEdadesEvento']);

    Route::post('AsistentesXFecha/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroAsistentesXFecha']);

    Route::post('JuntasAsistentes/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroJuntasAsistentes']);

// FIN DE RUTAS PARA EL CONTROLADOR DE ESTADISTICAS //


// INICIO DE RUTAS DE LOS WS DE LA APP//
    Route::get('CiudadesWS/{idDepartamento}',['uses' =>'Evento\CiudadController@obtenerCiudades']);

    Route::get('loginApp/{correo}/{password}',['uses' =>'Auth\LoginController@loginApp']);

    Route::get('logoutApp',['uses' =>'Auth\LoginController@logoutApp']);

    Route::get('EventosApp/{idUser}', ['uses' =>'Ecotickets\EcoticketsController@EventosApp']);

    Route::get('InformacionQRApp/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEvento']);

    Route::get('ActivarQRApp/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento']);

    Route::get('CantidadAsistentesApp/{idEvento}',['uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes']);

    Route::get('AsistentesXCiudadApp/{idEvento}',['uses' =>'Evento\EstadisticasController@ObtenerAsistentesXCiudad']);

    Route::get('EdadesAsistentesApp/{idEvento}',['uses' =>'Evento\EstadisticasController@RangoDeEdadesEvento']);

    Route::get('AsistentesXFechaApp/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroAsistentesXFecha']);

    Route::get('JuntasAsistentesApp/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroJuntasAsistentes']);

    Route::get('EstadisticasApp/{idEvento}',['uses' =>'Evento\EstadisticasController@EstadisticasApp']);

    Route::get('AsistentesActivosApp/{idEvento}',['uses' =>'Evento\AsistentesController@AsistentesActivos']);

// FIN DE RUTAS DE LOS WS DE LA APP//

// INICIO DE RUTAS PARA EL CONTROLADOR DE CUPONES//

    Route::get('MisCupones', 'Cupon\CuponesController@ObtenerMisCupones')->name('MisCupones');

//FIN DE RUTAS PARA EL CONTROLADOR DE CUPONES//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  DEPARTAMENTOS//

    Route::get('departamentos', 'Recurso\DepartamentoController@ObtenerDepartamento')->name('Departamentos');

//FIN DE RUTAS PARA EL CONTROLADOR DE  DEPARTAMENTOS//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  CIUDADES//

    Route::post('Ciudades/{idDepartamento}',['uses' =>'Recurso\CiudadController@obtenerCiudades']);/*Obtiene las ciudades por departamento*/

    Route::get('ListaCiudades',['uses' =>'Recurso\CiudadController@obtenerListaCiudades']);/*Obtiene las ciudades por departamento*/

//FIN DE RUTAS PARA EL CONTROLADOR DE  CIUDADES//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  USUARIOS//

    Route::get('usuarios', 'UsuarioYRol\UsuarioController@ObtenerUsuarios')->name('usuarios');

//FIN DE RUTAS PARA EL CONTROLADOR DE  USUARIOS//