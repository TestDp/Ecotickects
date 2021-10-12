@extends('layouts.profile')

@section('content')

    <div class="container">
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Enviar ticket</h3></div>
					<div style="text-align: left;" class="col-md-12">
                        <div class="panel-heading text-center"><a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a></div>
                    </div>
                <form id="formularioEvento" action="{{url('registrarUsuario')}}" method="POST">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="esActivo" name="esActivo" value="0">
                    <input type="hidden" id="esPerfilado" name="esPerfilado" value="0">
                    <input type="hidden" name="terminos" value="1" id="terminos" />
                    <input type="hidden" name="HabeasData" value="1" id="HabeasData" />
                    <input type="hidden" id="ComentarioEvento" name="ComentarioEvento"  value="BoletaGratis123" />
                    <input type="hidden" id="Promotor_id" name="Promotor_id"  value="0" />
                    <input type="hidden" id="esPago" name="esPago" value="1">
                    <div id="formAsistente" style="margin:0px !important;" class="row">
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Identificación
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-control" onchange="BuscarAsistente()"/>
                                </div>
                                <div class="col-md-6">
                                    Nombre
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Apellidos
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Celular/teléfono
                                    <input id="telefono" name="telefono" type="text" class="form-control" />
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Email
                                    <input id="Email" name="Email" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Confirmar Email
                                    <input id="confEmail" name="confEmail" type="text" class="form-control" />
                                </div>
                            </div>

                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control"  />
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Departamento persona
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["departamentos"] as $Departamento)
                                            <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Ciudad Persona
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-12">
                                    Evento al cual desea registrar el usuario
                                    <select id="Evento_id" name="Evento_id" class="form-control" onchange="CargarLocalidadesEvento()">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["eventos"] as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-3">
                                    Localidad
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-control">
                                        <option value="">Seleccionar</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    Precio Ecotickets
                                    <input id="valorBoleta" name="valorBoleta" type="text" class="form-control"  readonly/>
                                </div>
                                <div class="col-md-3">
                                    Cantidad De Ecotickets
                                    <input id="CantidadTickets" name="CantidadTickets" type="number" class="form-control" onkeyup="calcularPrecioTotal()"  />
                                </div>
                                <div class="col-md-3">
                                    Precio Total
                                    <input id="PrecioTotal" name="PrecioTotal" type="text" class="form-control"  readonly/>
                                </div>
                            </div>
                            <br>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-12">
                                    <button type="submit" onclick="validarCamposRegistrarUsuario()" class="btn btn-blue ripple trial-button">
                                        Enviar
                                    </button>
                                </div>
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
