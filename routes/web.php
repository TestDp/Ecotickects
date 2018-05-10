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
Route::get('/', [
    'uses' =>'Ecotickets\EcoticketsController@welcome'
]);

Route::get('/respuesta', function () {
    return view('respuesta');
});

Route::get('/confirmarAsistencia', function () {
    return view('Evento/ConfirmarAsistencia');
});

Route::get('/existente', function () {
    return view('existente');
});

Route::get('vistaCorreo', function () {
    return view('Email.correo');
});

Route::get('Eventos', [
    'uses' =>'Ecotickets\EcoticketsController@ObtenerEventos'
]);

Route::get('Cupones', [
    'uses' =>'Ecotickets\EcoticketsController@ObtenerCupones'
]);

Auth::routes();

/** Obtiene el formulario del evento*/
Route::get('FormularioAsistente/{idEvento}', [
    'uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistente'
]);

/** Obtiene el formulario del evento pago*/
Route::get('FormularioAsistentePago/{idEvento}', [
    'uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistentePago'
]);

/**Retorna  el home de los usuario mostrando los eventos creados por él*/
Route::get('/home', 'HomeController@index')->name('home');


/*Obtiene el formularion para guardar un evento*/
Route::get('FormularioEvento', 'Evento\EventosController@obtenerFormularioEvento')->name('CrearEvento');

/*Obtener mi eventos*/
Route::get('MisEventos', 'Evento\EventosController@ObtenerMisEventos')->name('MisEventos');



/*Guarda el evento del organizador*/
Route::post('crearEvento',[
    'uses' =>'Evento\EventosController@crearEvento'
]);

/*Guarda el registro del asistente*/
Route::post('registrarAsistente',[
    'uses' =>'Evento\AsistentesController@registrarAsistente'
]);

Route::post('FormularioAsistentePago',[
    'uses' =>'Evento\AsistentesController@registrarAsistentePagoPost'
]);

Route::post('RespuestaPagos',[
    'uses' =>'Evento\AsistentesController@RespuestaPagos'
]);

Route::get('RespuestaPagosUsuario',[
    'uses' =>'Evento\AsistentesController@RespuestaPagosUsuario'
]);

Route::get('ListaAsistentes/{idEvento}',[
    'uses' =>'Evento\EventosController@ObtenerListaAsistentes'
]);

Route::get('Estadisticas/{idEvento}',[
    'uses' =>'Evento\EventosController@obtenerEstadisticas'
]);



/*Valida el pin*/
Route::post('pin/{idPin}',[
    'uses' =>'Ecotickets\EcoticketsController@validarPIN'
]);

Route::post('CantidadAsistentes/{idEvento}',[
    'uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes'
]);


Route::post('asistenteResgistrado/{cc}',[
    'uses' =>'Evento\AsistentesController@ObtenerAsistente'
]);

// inicio rutas relacionadas a estadisticas
Route::post('AsistentesXCiudad/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@ObtenerAsistentesXCiudad'
]);

Route::post('EdadesAsistentes/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@RangoDeEdadesEvento'
]);
Route::post('AsistentesXFecha/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@NumeroAsistentesXFecha'
]);
Route::post('JuntasAsistentes/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@NumeroJuntasAsistentes'
]);
// fin rutas relacionadas a estadisticas


//inicio de rutas para leer el codigo qr

Route::get('LecturaQR/{idEvento}',[
    'uses' =>'Evento\AsistentesController@FormularioQR'
]);

Route::post('InformacionQR/{idEvento}/{cc}',[
    'uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEvento'
]);

Route::post('ActivarQR/{idEvento}/{cc}',[
    'uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento'
]);

//fin de rutas para leer el codigo qr

// inicio rutas de prueba app
Route::get('CiudadesWS/{idDepartamento}',[
    'uses' =>'Evento\CiudadController@obtenerCiudades'
]);

Route::get('loginApp/{correo}/{password}',[
    'uses' =>'Auth\LoginController@loginApp'
]);

Route::get('logoutApp',[
    'uses' =>'Auth\LoginController@logoutApp'
]);

Route::get('EventosApp/{idUser}', [
    'uses' =>'Ecotickets\EcoticketsController@EventosApp'
]);

Route::get('InformacionQRApp/{idEvento}/{cc}',[
    'uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEvento'
]);

Route::get('ActivarQRApp/{idEvento}/{cc}',[
    'uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento'
]);

Route::get('CantidadAsistentesApp/{idEvento}',[
    'uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes'
]);

Route::get('AsistentesXCiudadApp/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@ObtenerAsistentesXCiudad'
]);

Route::get('EdadesAsistentesApp/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@RangoDeEdadesEvento'
]);
Route::get('AsistentesXFechaApp/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@NumeroAsistentesXFecha'
]);
Route::get('JuntasAsistentesApp/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@NumeroJuntasAsistentes'
]);

Route::get('EstadisticasApp/{idEvento}',[
    'uses' =>'Evento\EstadisticasController@EstadisticasApp'
]);

Route::get('AsistentesActivosApp/{idEvento}',[
    'uses' =>'Evento\AsistentesController@AsistentesActivos'
]);
// fin rutas de prueba app

Route::get('/habeasData', function () {
    return view('habeasData');
});

Route::get('/terminosCondiciones', function () {
    return view('terminosCondiciones');
});

Route::get('/respuestaPago', function () {
    return view('respuestaPago');
});

// INICIO DE RUTAS PARA EL CONTROLADOR DE CUPONES//

    Route::get('MisCupones', 'Cupon\CuponesController@ObtenerMisCupones')->name('MisCupones');

//FIN DE RUTAS PARA EL CONTROLADOR DE CUPONES//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  DEPARTAMENTOS//

    Route::get('departamentos', 'Recurso\DepartamentoController@ObtenerDepartamento')->name('Departamentos');

//FIN DE RUTAS PARA EL CONTROLADOR DE  DEPARTAMENTOS//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  CIUDADES//

    /*Obtiene las ciudades por departamento*/
    Route::post('Ciudades/{idDepartamento}',['uses' =>'Recurso\CiudadController@obtenerCiudades']);

    /*Obtiene las ciudades por departamento*/
    Route::get('ListaCiudades',['uses' =>'Recurso\CiudadController@obtenerListaCiudades']);

//FIN DE RUTAS PARA EL CONTROLADOR DE  CIUDADES//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  USUARIOS//

Route::get('usuarios', 'UsuarioYRol\UsuarioController@ObtenerUsuarios')->name('usuarios');

//FIN DE RUTAS PARA EL CONTROLADOR DE  USUARIOS//