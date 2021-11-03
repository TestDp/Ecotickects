@extends('layouts.profile')

@section('content')

	<div class="row">
        @if (session('status'))
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "transaccción exitosa!",
                    text: "Ticket enviada con exito!",
                    icon: "success",
                    button: "OK",
                });
            </script>
        @endif
        @if (session('respuestaError'))
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    swal({
                        title: "Transacción con error!",
                        text: "No fue posible enviar el ticket!",
                        icon: "error",
                        button: "OK",
                    });
                </script>
        @endif

        <div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Enviar ticket</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para enviar el Ecoticket</h4>
                </div>
                <div class="card-body ">
                 <form class="form-horizontal" id="formularioEvento" action="{{url('registrarUsuario')}}" method="POST">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="esActivo" name="esActivo" value="0">
                    <input type="hidden" id="esPerfilado" name="esPerfilado" value="0">
                    <input type="hidden" name="terminos" value="1" id="terminos" />
                    <input type="hidden" name="HabeasData" value="1" id="HabeasData" />
                    <input type="hidden" id="ComentarioEvento" name="ComentarioEvento"  value="BoletaEnviadaModuloUsuario" />
                    <input type="hidden" id="Promotor_id" name="Promotor_id"  value="0" />
                    <input type="hidden" id="esPago" name="esPago" value="1">
                    <div id="formAsistente" style="margin:0px !important;" class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Identificacion" class="bmd-label-floating">Identificación</label>
                                    <input id="Identificacion" name="Identificacion" type="text" class="form-control" onchange="BuscarAsistente()"/>
                                </div>
							</div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="Nombres" class="bmd-label-floating">Nombres</label>
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="Apellidos" class="bmd-label-floating">Apellidos</label>
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="telefono" class="bmd-label-floating">Celular/teléfono</label>
                                    <input id="telefono" name="telefono" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Email" class="bmd-label-floating">Email</label>
                                    <input id="Email" name="Email" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label for="confEmail" class="bmd-label-floating">Confirmar Email</label>
                                    <input id="confEmail" name="confEmail" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control datepicker" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control"  />
                                </div>
                            </div>
							<div class="col-sm-6">
							Departamento persona
                                <div class="form-group">
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="selectpicker" data-style="select-with-transition">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["departamentos"] as $Departamento)
                                            <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6">
							Ciudad Persona
                                <div class="form-group">
                                    
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6">
							Evento al cual desea registrar el usuario
                                <div class="form-group">                               
                                    <select title="Seleccionar" id="Evento_id" name="Evento_id" class="selectpicker" data-style="select-with-transition" onchange="CargarLocalidadesEvento()">
                                        @foreach($ElementosArray["eventos"] as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6">
							 Localidad
                                <div class="form-group">
                                    <select data-style="select-with-transition" title="Seleccionar" id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="selectpicker">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="valorBoleta" class="bmd-label-floating">Precio Ecotickets</label>
                                    <input id="valorBoleta" name="valorBoleta" type="text" class="form-control"  readonly/>
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="CantidadTickets" class="bmd-label-floating">Cantidad De Ecotickets</label>
                                    <input id="CantidadTickets" name="CantidadTickets" type="number" class="form-control" onkeyup="calcularPrecioTotal()"  />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    <label for="CantidadTickets" class="bmd-label-floating">Precio Total</label>
                                    <input id="PrecioTotal" name="PrecioTotal" type="text" class="form-control"  readonly/>
                                </div>
                            </div>
							<div class="col-sm-12">
                                <div class="form-group">
								<button type="submit" onclick="validarCamposRegistrarUsuario()" class="btn btn-fill btn-rose">Enviar</button>
								</div>
                            </div>
                    </div>
					</form>
                </div>				

              </div>
                </div>
              </div>
        </div>
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>



@endsection
