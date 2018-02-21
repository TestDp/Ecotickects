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

/**Retorna  el home de los usuario mostrando los eventos creados por él*/
Route::get('/home', 'HomeController@index')->name('home');

/*Obtiene el formularion para guardar un evento*/
Route::get('FormularioEvento', 'Evento\EventosController@obtenerFormularioEvento')->name('CrearEvento');

/*Obtiene las ciudades por departamento*/
Route::post('Ciudades/{idDepartamento}',[
    'uses' =>'Evento\CiudadController@obtenerCiudades'
]);

/*Guarda el evento del organizador*/
Route::post('crearEvento',[
    'uses' =>'Evento\EventosController@crearEvento'
]);

/*Guarda el registro del asistente*/
Route::post('registrarAsistente',[
    'uses' =>'Evento\AsistentesController@registrarAsistente'
]);

Route::get('ListaAsistentes/{idEvento}',[
    'uses' =>'Evento\EventosController@ObtenerListaAsistentes'
]);

Route::get('Estadisticas/{idEvento}',[
    'uses' =>'Evento\EventosController@obtenerEstadisticas'
]);



/*Valida el pin*/
Route::post('pin/{idPin}',[
    'uses' =>'Evento\AsistentesController@validarPIN'
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

//rutas de prueba
Route::get('CiudadesWS/{idDepartamento}',[
    'uses' =>'Evento\CiudadController@obtenerCiudades'
]);

Route::get('loginApp/{correo}/{password}',[
    'uses' =>'Auth\LoginController@loginApp'
]);
