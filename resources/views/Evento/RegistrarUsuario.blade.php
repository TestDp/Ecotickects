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
        @if (session('masivoResumen'))
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "Carga masiva finalizada",
                    text: "{{ session('masivoResumen') }}",
                    icon: "success",
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
                                    Nombres
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    Apellidos
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    Celular/teléfono
                                    <input id="telefono" name="telefono" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    Email
                                    <input id="Email" name="Email" type="text" class="form-control" />
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    Confirmar Email
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
							<div style="margin-bottom:50px !important;" class="col-sm-6">
							Departamento persona
                                <div class="form-group">
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
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
							<div style="margin:20px;" class="col-sm-12">
                                <div class="form-group">
									
                                </div>
                            </div>
							<div style="margin-bottom:50px !important;" class="col-sm-6">
							Evento al cual desea registrar el usuario
                                <div class="form-group">                               
                                    <select title="Seleccionar" id="Evento_id" name="Evento_id" class="form-control" onchange="CargarLocalidadesEvento()">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["eventos"] as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							<div class="col-sm-6">
							 Localidad
                                <div class="form-group">
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-control">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                            </div>
							<div style="margin:20px;" class="col-sm-12">
                                <div class="form-group">
									
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    Precio Ecotickets
                                    <input id="valorBoleta" name="valorBoleta" type="text" class="form-control"  readonly/>
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    Cantidad De Ecotickets
                                    <input id="CantidadTickets" name="CantidadTickets" type="number" class="form-control" onkeyup="calcularPrecioTotal()"  />
                                </div>
                            </div>
							<div class="col-sm-4">
                                <div class="form-group">
                                    Precio Total
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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Carga masiva (CSV / Excel)</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        Sube un archivo con la lista de usuarios para enviar cortesías sin registrarlos 1x1.
                        Descarga un ejemplo aquí: <a href="{{ url('plantilla-usuarios-cortesia.csv') }}" download>CSV de ejemplo</a>
                    </p>

                    <form class="form-horizontal" id="formularioEventoMasivo" action="{{url('registrarUsuariosMasivo')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_token_masivo" name="_token" value="{{csrf_token()}}">

                    {{-- Fila 1: Archivo --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Archivo (CSV o XLSX)</label>
                            
                                <input type="file" name="archivoUsuarios" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            
                        </div>
                    </div>

                    {{-- Fila 2: Evento | Localidad --}}
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-sm-6">
                            <label>Evento</label>
                            <div class="form-group">
                                <select id="EventoMasivo_id" name="Evento_id" class="form-control" onchange="CargarLocalidadesEventoMasivo()">
                                    <option value="">Seleccionar</option>
                                    @foreach($ElementosArray["eventos"] as $evento)
                                        <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Localidad</label>
                            <div class="form-group">
                                <select id="localidadMasivo" name="localidad" class="form-control">
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 3: Departamento | Ciudad --}}
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-sm-6">
                            <label>Departamento</label>
                            <div class="form-group">
                                <select id="DepartamentoMasivo_id" name="Departamento_id" onchange="CargarMunicipiosDepartamentoMasivo()" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($ElementosArray["departamentos"] as $Departamento)
                                        <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Ciudad</label>
                            <div class="form-group">
                                <select id="CiudadMasivo_id" name="Ciudad_id" class="form-control"></select>
                            </div>
                        </div>
                    </div>

                    {{-- Fila 4: Cantidad | Botón --}}
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-sm-3">
                            <label>Cantidad tickets por usuario</label>
                            <div class="form-group">
                                <input id="CantidadTicketsMasivo" name="CantidadTickets" type="number" class="form-control" min="1" value="1"/>
                            </div>
                        </div>
                        <div class="col-sm-3" style="padding-top: 25px;">
                            <button type="submit" class="btn btn-fill btn-rose">Procesar carga</button>
                        </div>
                    </div>

                    {{-- Nota columnas --}}
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-12">
                            <small class="text-muted">
                                Columnas esperadas en el archivo: <b>Identificacion, Nombres, Apellidos, telefono, Email</b>.
                            </small>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>



@endsection
