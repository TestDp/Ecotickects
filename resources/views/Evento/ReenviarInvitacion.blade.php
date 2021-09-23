@extends('layouts.profile')

@section('content')

    <div class="container">
        @if (session('status'))
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "transaccción exitosa!",
                    text: "Usuario registrado con exito!",
                    icon: "success",
                    button: "OK",
                });
            </script>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>REENVIAR INVITACION</h3></div>
					<div style="text-align: left;" class="col-md-12">
                        <div class="panel-heading text-center"><a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a></div>
                    </div>
                <form id="formularioEvento" action="{{url('GenerarQRS')}}" method="POST">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

                    <div id="formAsistente" style="margin:0px !important;" class="row">
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-6">
                                    Correo electrónico
                                    <input id="correo" name="correo" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    REFERENCIA DE PAGO
                                    <input id="pin" name="pin" type="text" class="form-control" />
                                </div>
                            </div>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-12">
                                    Evento al cual desea registrar el usuario
                                    <select id="Evento_id" name="Evento_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($eventos as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div style="margin:0px !important;" class="row">
                                <div class="col-md-12">
                                    <button type="submit" onclick="validarCamposRegistrarUsuario()" class="btn btn-blue ripple trial-button">
                                        Registrar
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
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
