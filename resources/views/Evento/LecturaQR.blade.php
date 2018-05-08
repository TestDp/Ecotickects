@extends('layouts.profile')

@section('titulo')
	Lectura QR
@endsection
@section('content')
	<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" id="idEvento" name="idEvento" value="{{$Evento ->id}}">
	<h2 style="text-align:center; font-size: 30px; font-weight: 700; font-family: sans-serif;">Entrada {{ $Evento ->Nombre_Evento }}</h2>
	<div class="row">
		<div class="col-md-12">
			Nombre
			<label id="nombre" class="form-control"></label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			Apellidos
			<label id="apellido" class="form-control"></label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			Identificación
			<label id="identificacion" class="form-control"></label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			Estado
			<label id="qrActivo" class="form-control" style="font-size:30px;"></label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			campo
			<label class="form-control"></label>
		</div>
	</div>
	<input type="hidden" id="pk_usuario">
	<label style="text-align:center; font-family: sans-serif; ">Ingresar Identificación</label>
	<div class="row">
		<div class="col-md-12">
			<div class="input-group">
				<input id="cc" name="cc" type="text" class="form-control" >
				<span class="input-group-btn">
        			<button class="btn btn-default" type="button" onclick="leerIdentificacion()">Buscar!</button>
      			</span>
			</div>
		</div>
	</div>

	<label style="text-align:center; font-family: sans-serif; ">Lector QR</label>
	<input  id="lectorQR" name="lectorQR"  style="background-color: lightskyblue; width:100%;" type="text" class="form-control" onkeyup="leerQR()"/>
	<input style="margin-left: 45%;" type="button" onclick="activarQRUsuario()" value="Ingresar" class="btn btn-blue ripple trial-button">




	<script src="{{ asset('js/Evento/eventos.js') }}"></script>


@endsection