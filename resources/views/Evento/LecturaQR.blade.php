@extends('layouts.profile')

@section('titulo')
    Lectura QR
@endsection
@section('content')
    <div class="row">

            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-text">
                        <h4 class="card-title">Lectura de código QR</h4>
                    </div>
                </div>


                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">contacts</i>
                    </div>
                    <h4 class="card-title">lector QR o ingresa la cédula del usuario</h4>
                </div>

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="idEvento" name="idEvento" value="{{$Evento ->id}}">
                <input type="hidden" id="userName" name="userName" value="{{ Auth::user()->id }}">
                <h2 style="text-align:center; font-size: 30px; font-weight: 700; font-family: sans-serif;">
                    Entrada {{ $Evento ->Nombre_Evento }}</h2>
                <input type="hidden" id="pk_usuario">


<div class="row">
    <div class="col-md-4">
        <span class="input-group-btn">
        <label style="text-align:center; font-family: sans-serif; ">Ingresar Identificación</label>
        <input id="cc" name="cc" type="text" class="form-control">
        </span>
    </div>
    <div class="col-md-4">
        <span class="input-group-btn">
        <button class="form-control btn btn-fill btn-rose" type="button"
            onclick="leerIdentificacion()">Buscar!</button>
        </span>
    </div>
    <div class="col-md-4">
        <span class="input-group-btn">
        <button  type="button" onclick="activarQRUsuario()"
            class="form-control btn btn-fill btn-rose">Ingresar</button>
        </span>
    </div>

</div>
                <label style="text-align:center; font-family: sans-serif; ">Lector QR</label>
                <div class="row text-center">
                    <div class="col-md-12">
                        <a id="btn-scan-qr" href="#">
                            <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg"
                                 class="img-fluid text-center" width="175">
                            <a/>
                            <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
                    </div>

                </div>
                <div class="row text-center">
                    <div class="col-md-6">
				<span class="input-group-btn">
				<button class="form-control btn btn-success btn-sm rounded-3 mb-2" onclick="encenderCamara()">Encender camara</button>
				</span>
                    </div>
                    <div class="col-md-6">
				<span class="input-group-btn">
				<button class="form-control btn btn-danger btn-sm rounded-3"
                        onclick="cerrarCamara()">Detener camara</button>
				</span>
                    </div>

                </div>
            </div>

    </div>


    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Evento/leerQrWeb.js') }}"></script>

@endsection