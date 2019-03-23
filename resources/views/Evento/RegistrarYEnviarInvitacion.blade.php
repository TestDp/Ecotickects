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
                    <div class="panel-heading text-center"><h3>ENVIAR INVITACIÓNES</h3></div>
                    </br>
                    <div class="row">
                        <div class="col-md-8">
                            Evento para consultar usuarios
                            <select id="Evento_id" name="Evento_id" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button  onclick="ajaxRenderSectionCargarUsuarios()" class="btn btn-success form-control">
                                Consultar Usuarios
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            Evento para invitar los usuarios
                            <select id="EventoInvitacion_id" name="EventoInvitacion_id" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-4">
                            <button  onclick="ajaxRenderSectionCargarUsuarios()" class="btn btn-danger form-control">
                                Enviar Invitaciones
                            </button>
                        </div>
                    </div>
                    </br>
                    <div class="row" id="listaUsuarios">
                        @yield('UsuarioXEvento')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
