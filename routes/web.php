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
    'uses' =>'Ecotickets\EcoticketsController@ObtenerEventos'
]);
Auth::routes();

/** Obtiene el formulario del evento*/
Route::get('/FormularioAsistente/{idEvento}', [
    'uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistente'
]);

/**Retorna  el home de los usuario mostrando los eventos creados por él*/
Route::get('/home', 'HomeController@index')->name('home');

/*Obtiene el formularion para guardar un evento*/
Route::get('FormularioEvento', 'Evento\EventosController@obtenerFormularioEvento')->name('CrearEvento');

/*Obtiene las ciudades por departamento*/
Route::post('Ciudades/{idDepartamento}',[
    'uses' =>'Evento\EventosController@obtenerCiudades'
]);

/*Guarda el evento del organizador*/
Route::post('crearEvento',[
    'uses' =>'Evento\EventosController@crearEvento'
]);

/*Guarda el registro del asistente*/
Route::post('registrarAsistente',[
    'uses' =>'Evento\AsistentesController@registrarAsistente'
]);