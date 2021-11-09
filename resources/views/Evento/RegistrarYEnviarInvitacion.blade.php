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
                    <h4 class="card-title">Enviar invitaciones</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para enviar invitaciones</h4>
                </div>
                <div class="card-body ">
				
						<div class="row">
                        <div class="col-sm-4">
                            Evento para consultar usuarios
							<div class="form-group">
                            <select id="Evento_id" name="Evento_id" class="selectpicker" data-style="select-with-transition">
                                <option value="">Seleccionar</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                @endforeach
                            </select>
							</div>
						</div>
                        <div class="col-sm-8">
						<div class="form-group">
                            <button  onclick="ajaxRenderSectionCargarUsuarios()" class="btn btn-success">
                                Consultar Usuarios
                            </button>
                        </div>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            Evento para invitar los usuarios
							<div class="form-group">
                            <select id="EventoInvitacion_id" name="EventoInvitacion_id" class="selectpicker" data-style="select-with-transition">
                                <option value="">Seleccionar</option>
                                @foreach($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                                @endforeach
                            </select>
                        </div>
						</div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-sm-4">
						<div class="form-group">
                            <button  onclick="ajaxRenderSectionCargarUsuarios()" class="btn btn-danger">
                                Enviar Invitaciones
                            </button>
                        </div>
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
        </div>
    </div>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
