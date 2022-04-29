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

    Route::get('/existente', function () {return view('existente');});
	
	Route::get('/boleta', function () {return view('boletatest');});

    Route::get('/vistaCorreo', function () {return view('Email.correo');});

    Route::get('/habeasData', function () { return view('habeasData');});
	
	Route::get('/encuesta', function () { return view('encuesta');});
	
	Route::get('/calificacionjurados', function () { return view('calificacionjurado');});

    Route::get('/terminosCondiciones', function () {return view('terminosCondiciones');});
	
	Route::get('/ecupones', function () {return view('ecupones');});

    Route::get('/Cortesia', function () {return view('cortesia');});

    Route::get('/respuestaPago', function () {return view('respuestaPago');});
	
	Route::get('/siembravida', function () {return view('siembravida');});

    //Route::get('/confirmarAsistencia', function () {return view('Evento/ConfirmarAsistencia');});
    

/*FIN VISTAS SIN CONTROLADOR*/

// INICIO DE RUTAS PARA EL CONTROLADOR DE HOME//

    /**Retorna  el home de los usuario mostrando los eventos creados por él*/
    Route::get('/home', 'HomeController@index')->name('home');

// FIN DE RUTAS PARA EL CONTROLADOR DE HOME//

// INICIO DE RUTAS PARA EL CONTROLADOR DE ECOTICKETS//

    //Route::get('/', ['uses' =>'Ecotickets\EcoticketsController@welcome']);
    Route::get('/', ['uses' =>'Ecotickets\EcoticketsController@ObtenerEventos']);

    Route::get('Eventos', ['uses' =>'Ecotickets\EcoticketsController@ObtenerEventos']);

    Route::get('Cupones', ['uses' =>'Ecotickets\EcoticketsController@ObtenerCupones']);

    Route::get('FormularioAsistente/{idEvento}', ['uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistente']);/** Obtiene el formulario del evento*/

    Route::get('FormularioAsistentePago/{idEvento}', ['uses' =>'Ecotickets\EcoticketsController@obtenerFormularioAsistentePago']);/** Obtiene el formulario del evento pago*/

    Route::get('form-prom/{idEvento}/{idPromotor}', ['uses' =>'Ecotickets\EcoticketsController@obtenerFormularioProspectoPagoPromotor']);

    Route::post('pin/{idPin}',['uses' =>'Ecotickets\EcoticketsController@validarPIN']);/*Valida el pin*/

    Route::get('Tienda/{idEvento}', ['uses' =>'Ecotickets\EcoticketsController@obtenerProductosXEvento']);/** Obtiene el formulario de la tienda*/

    Route::get('ValidarCodigoPromo/{idEvento}/{CodigoPromocional}',['uses' =>'Ecotickets\EcoticketsController@obtenerBoletaPromo']);

    Route::get('probar',['uses' =>'Evento\AsistentesController@RespuestaPagos']); /**LINEA PARA BORRAR*/

    Route::get('ActualizarEventosFecha',['uses' => 'Evento\AsistentesController@ActualizarEventosFecha']);



// FIN DE RUTAS PARA EL CONTROLADOR DE ECOTICKETS//

// INICIO DE RUTAS PARA EL CONTROLADOR DE EVENTOS//


    Route::get('FormularioEvento', 'Evento\EventosController@obtenerFormularioEvento')->name('CrearEvento');/*Obtiene el formulario para guardar un evento*/

    Route::get('EditarEvento/{idEvento}', 'Evento\EventosController@obtenerFormularioEditarEvento')->name('EditarEvento');/*Obtiene el formulario para editar un evento*/

    Route::get('MisEventos', 'Evento\EventosController@ObtenerMisEventos')->name('MisEventos');/*Obtener mi eventos*/

    Route::get('ActivarFunciones', 'Evento\EventosController@FormularioActivarFunciones')->name('ActivarFunciones');

    Route::post('crearEvento',['uses' =>'Evento\EventosController@crearEvento']);/*Guarda el evento del organizador*/

   // Route::post('actualizarEvento',['uses' =>'Evento\EventosController@editarEvento']);/*Edita el evento del organizador*/

    Route::post('actualizarEvento', 'Evento\EventosController@editarEvento')->name('actualizarEvento');

    Route::get('ListaAsistentes/{idEvento}',['uses' =>'Evento\EventosController@ObtenerListaAsistentes']);

    Route::get('ListaTickets/{idEvento}',['uses' =>'Evento\EventosController@obtenerListaTickets']);

    Route::get('ListaAsistentesGuestList/{idEvento}',['uses' =>'Evento\EventosController@ObtenerListaAsistentesGuestList']);

    Route::get('Estadisticas/{idEvento}',['uses' =>'Evento\EventosController@obtenerEstadisticas']);

    Route::get('Liquidacion/{idEvento}',['uses' =>'Evento\EventosController@obtenerLiquidacion']);

    Route::post('LiquidacionGrafica/{idEvento}',['uses' =>'Evento\EventosController@obtenerLiquidacionGrafica']);

    Route::post('ActivarEventoPago/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarEventoPago']);

    Route::post('ActivarTienda/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarTienda']);

    Route::post('ActivarSolicitarPIN/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarSolicitarPIN']);

    Route::post('ActivarEsPublico/{idEvento}/{FlagEsActivo}',['uses' =>'Evento\EventosController@ActivarEsPublico']);

   // Route::post('ActualizarEventosFecha',['uses' =>'Evento\EventosController@ActualizarEventosFecha']);

    Route::get('EventosXUsuario/{idUsuario}',['uses' =>'Evento\EventosController@obtenerVistaEventosXUsuario']);

    Route::get('LocalidadesEvento/{idEvento}',['uses' => 'Evento\EventosController@obtenerLocalidadesEvento']);

    Route::get('InformePromotor/{idEvento}',['uses' =>'Evento\EventosController@obtenerInformePromotor']);

    Route::get('InformeUsuarioBoleta/{idEvento}',['uses' =>'Evento\EventosController@ObtenerInformeUsuarioBoleta']);

    Route::get('GenerarEnlacePromotor',['uses' =>'Evento\EventosController@generarEnlacePromotor']);



// FIN DE RUTAS PARA EL CONTROLADOR DE EVENTOS//

// INICIO DE RUTAS PARA EL CONTROLADOR DE ASISTENTES//

    Route::post('registrarAsistente',['uses' =>'Evento\AsistentesController@registrarUsuario']);

   Route::post('GenerarQRS',['uses' =>'Evento\AsistentesController@GenerarQRS']);//linea temporal

    Route::post('FormularioAsistentePago',['uses' =>'Evento\AsistentesController@registrarAsistentePagoPost']);

    Route::get('FormularioUsuario',['uses' =>'Evento\AsistentesController@obtenerFormularioUsuario']);

    Route::get('FormularioPromotor',['uses' =>'Evento\AsistentesController@obtenerFormularioPromotor']);

    Route::get('FormularioReenviarInvitacion',['uses' =>'Evento\AsistentesController@obtenerFormularioReenviarInvitacion']);

    Route::get('RegistrarYEnviar',['uses' =>'Evento\AsistentesController@obtenerFormularioInvitaciones']);

    Route::get('UsuariosXEvento/{idEvento}',['uses' =>'Evento\AsistentesController@CargarUsuariosXEvento']);

    Route::post('registrarUsuario',['uses' =>'Evento\AsistentesController@registrarProspectoYEnviarTicket']);

    Route::post('registrarPromotor',['uses' =>'Evento\AsistentesController@registrarPromotor']);

    Route::post('RespuestaPagos',['uses' =>'Evento\AsistentesController@RespuestaPagos']);

    Route::get('RespuestaPagosUsuario',['uses' =>'Evento\AsistentesController@RespuestaPagosUsuario']);

    Route::post('ActivarQR/{idEvento}/{cc}/{identificacion}',['uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento']);

    Route::post('CantidadAsistentes/{idEvento}',['uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes']);

    Route::post('asistenteResgistrado/{cc}',['uses' =>'Evento\AsistentesController@ObtenerAsistente']);

    Route::get('LecturaQR/{idEvento}',['uses' =>'Evento\AsistentesController@FormularioQR']);

    Route::post('InformacionQR/{idEvento}/{numPdf}',['uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEventoWeb']);

    Route::get('ConfirmarAsistencia/{idEvento}',['uses' =>'Evento\AsistentesController@ObtenerFormularioConfirmacionAsistente']);
    
    //Route::post('ConfirmarAsistencia/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ConfirmarAsistente']);
    
    Route::post('ConfirmarAsistente',['uses' =>'Evento\AsistentesController@ConfirmarAsistente']);

    Route::get('listaPromotores/{idEvento}',['uses' =>'Evento\AsistentesController@obtenerPromotoresXEvento']);

    Route::get('ListaTickets/{idEvento}/{idAsistente}',['uses' =>'Evento\AsistentesController@obtenerListaTickets']);

    Route::post('anularTicket',['uses' =>'Evento\AsistentesController@anularTicket']);

    Route::get('descargarTicket/{idAsistente}/{idEvento}',['uses' =>'Evento\AsistentesController@descargarTicket']);

    
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

    Route::get('EventosAppXamarin/{idUser}', ['uses' =>'Ecotickets\EcoticketsController@EventosAppXamarin']);

    Route::get('InformacionQRApp/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ObtenerInformacionDelAsistenteXEvento']);

    Route::get('ActivarQRApp/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEvento']);

    Route::get('ActivarPinApp/{idEvento}/{idPin}',['uses' =>'Evento\AsistentesController@ActivarPinPago']);

    Route::get('DesactivarQRApp/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@DesactivarQRAsistenteXEvento']);

    Route::get('CantidadAsistentesApp/{idEvento}',['uses' =>'Evento\AsistentesController@ObtnerCantidadAsistentes']);

    Route::get('AsistentesXCiudadApp/{idEvento}',['uses' =>'Evento\EstadisticasController@ObtenerAsistentesXCiudad']);

    Route::get('EdadesAsistentesApp/{idEvento}',['uses' =>'Evento\EstadisticasController@RangoDeEdadesEvento']);

    Route::get('AsistentesXFechaApp/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroAsistentesXFecha']);

    Route::get('JuntasAsistentesApp/{idEvento}',['uses' =>'Evento\EstadisticasController@NumeroJuntasAsistentes']);

    Route::get('EstadisticasApp/{idEvento}',['uses' =>'Evento\EstadisticasController@EstadisticasApp']);

    Route::get('AsistentesActivosApp/{idEvento}',['uses' =>'Evento\AsistentesController@AsistentesActivos']);

    Route::get('ValidarYActivarQR/{idEvento}/{cc}',['uses' =>'Evento\AsistentesController@ActivarQRAsistenteXEventoApp']);


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

//INICIO DE RUTAS PARA EL CONTROLADOR DE  PRODUCTOS//

    Route::get('formularioProducto', 'Tienda\ProductosController@getFormularioProducto')->name('formularioProducto');

    Route::post('crearProducto',['uses' =>'Tienda\ProductosController@crearProducto']);/*Guarda el producto */

    Route::get('misproductos', 'Tienda\ProductosController@ObtenerMisProductos')->name('misproductos');

    Route::get('FormularioActivarProducto/{idProducto}',['uses' =>'Tienda\ProductosController@FormularioActivarProductos']);

    Route::post('ActivarProducto/{idProducto}/{idEvento}',['uses' =>'Tienda\ProductosController@agregarProductoXEventos']);

    Route::get('DesactivarProducto/{idProducto}/{idEvento}',['uses' =>'Tienda\ProductosController@eliminarProductoXEventos']);

//FIN DE RUTAS PARA EL CONTROLADOR DE  PRODUCTOS//

//INICIO DE RUTAS PARA EL CONTROLADOR DE  FACTURA//

    Route::post('RegistrarCompra',['uses' =>'Tienda\FacturaController@crearFactura']);

    Route::post('RespuestaPagosTiendaPayu',['uses' =>'Tienda\FacturaController@RespuestaPagosTiendaPayu']);

    Route::get('RespuestaPagosUsuarioTienda',['uses' =>'Tienda\FacturaController@RespuestaPagosUsuarioTienda']);

    Route::get('EventoConVentas',['uses' =>'Tienda\FacturaController@EventosConVentas']);

    Route::get('VentasPorEvento/{idEvento}',['uses' =>'Tienda\FacturaController@VentasPorEvento']);

    Route::get('DetalleVenta/{idFactura}',['uses' =>'Tienda\FacturaController@obtenerDetalleFactura']);

    Route::post('DespacharPedido/{idfactura}/{estadoDespachada}',['uses' =>'Tienda\FacturaController@actualizarEstadoFacturaDespachada']);


//FIN DE RUTAS PARA EL CONTROLADOR DE  FACTURA//


//CONTROLADOR ROL
Route::get('crearRol', 'UsuarioYRol\RolController@CrearRol')->name('crearRol');//cargar la vista para crear un rol
Route::get('editarRol/{idRol}', 'UsuarioYRol\RolController@EditarRol')->name('editarRol');//cargar la vista para editar un rol
Route::post('guardarRol', 'UsuarioYRol\RolController@GuardarRol')->name('guardarRol');//Guardar la informacion del rol
Route::get('roles', 'UsuarioYRol\RolController@ObtenerRoles')->name('roles');//Obtiene la lista de tipos de roles

//CONTROLADOR USUARIOS
Route::get('crearUsuario', 'UsuarioYRol\UsuarioController@CrearUsuarioEmpresa')->name('crearUsuario');//cargar la vista para crear un usuario
Route::get('FormularioEditarUsuario/{idUsuario}','UsuarioYRol\UsuarioController@EditarUsuarioEmpresa')->name('FormularioEditarUsuario');//Cargar la vista para editar un usuario
Route::post('guardarUsuario', 'UsuarioYRol\UsuarioController@GuardarUsuarioEmpresa')->name('guardarUsuario');//Guardar la informacion del usuario
Route::post('EditarUsuario', 'UsuarioYRol\UsuarioController@EditarUsuario')->name('EditarUsuario');
Route::post('CambiarContrasena', 'UsuarioYRol\UsuarioController@CambiarContrasenaUsuario')->name('CambiarContrasena');
Route::get('usuarios', 'UsuarioYRol\UsuarioController@ObtenerUsuarios')->name('usuarios');//Obtiene la lista de usuarios
Route::get('/register/verify/{code}', 'UsuarioYRol\UsuarioController@verifarCorreo'); //verificar correo electronico
Route::post('ActivarPermisoEvento/{idEvento}/{idUsuario}/{esActivo}',['uses' =>'UsuarioYRol\UsuarioController@ActivarPermisoXEvento']);


//CONTROLADOR SEDE
Route::get('sedes', 'MEmpresa\SedeController@ObtenerSedes')->name('sedes');//Obtiene la lista de sedes
Route::get('crearSede', 'MEmpresa\SedeController@CrearSede')->name('crearSede');//cargar la vista para crear una sede
Route::get('editarSede/{idSede}', 'MEmpresa\SedeController@EditarSede')->name('editarSede');//cargar la vista para editar una sede
Route::post('guardarSede', 'MEmpresa\SedeController@GuardarSede')->name('guardarSede');//Guardar la informacion de la sede

//CONTROLADOR PAGOPAYU
Route::post('pagarTC',['uses' =>'Evento\PagosController@PagarTC']);
Route::post('pagarPSE',['uses' =>'Evento\PagosController@PagarPSE']);
Route::get('FormularioPagoTc/{tipoTC}',['uses' =>'Evento\PagosController@CargarFormularioPagoTC']);
Route::get('FormularioPagoPSE',['uses' =>'Evento\PagosController@CargarFormularioPagoPSE']);
Route::get('FormularioMediosDePago',['uses' =>'Evento\PagosController@CargarFormularioMediosDePago']);
Route::get('RespuestaPagoPSE',['uses' =>'Evento\PagosController@RespuestaPagoPSE']);

//Route::get('pagar',['uses' =>'Evento\PagosController@Pagar']);