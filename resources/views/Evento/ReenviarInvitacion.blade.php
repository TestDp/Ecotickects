@extends('layouts.profile')

@section('content')

    <div class="row">
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
				<div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Reenviar invitación</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información reenviar una invitación a un evento.</h4>
                </div>
                <div class="card-body ">
						<form id="formularioEvento" action="{{url('GenerarQRS')}}" method="POST">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

                    <div class="form-horizontal" id="formAsistente" style="margin:0px !important;" class="row">
                            <div class="row">
                                <div class="col-sm-6">
								<div class="form-group">
                                    <label for="correo" class="bmd-label-floating">Correo electrónico</label>
                                    <input id="correo" name="correo" type="text" class="form-control" />
                                </div>
								</div>
                                <div class="col-sm-6">
								<div class="form-group">
                                    <label for="pin" class="bmd-label-floating">REFERENCIA DE PAGO</label>
                                    <input id="pin" name="pin" type="text" class="form-control" />
                                </div>
								</div>
                            </div>
       
                                <div class="col-sm-12">
								Evento al cual desea registrar el usuario
								<div class="form-group">                                    
                                    <select id="Evento_id" name="Evento_id" class="selectpicker" data-style="select-with-transition">
                                        <option value="">Seleccionar</option>
                                        @foreach($eventos as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>
                            <br>
                        
                                <div class="col-md-12">
								<div class="form-group">
                                    <button type="submit" onclick="validarCamposRegistrarUsuario()" class="btn btn-fill btn-rose">
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
        </div>
	</div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
