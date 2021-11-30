@extends('layouts.profile')

@section('content')

    <div class="row">
        @if (session('status'))
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "transaccción exitosa!",
                    text: "Promotor registrado con exito!",
                    icon: "success",
                    button: "OK",
                });
            </script>
        @endif
		
		<div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Registrar promotores</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para registrar un promotor</h4>
                </div>
                <div class="card-body ">
					 <form class="form-horizontal" id="formularioEvento" action="{{url('registrarPromotor')}}" method="POST">
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="esActivo" name="esActivo" value="0">
                        <input type="hidden" id="esPerfilado" name="esPerfilado" value="0">
                        <input type="hidden" name="terminos" value="1" id="terminos" />
                        <input type="hidden" name="HabeasData" value="1" id="HabeasData" />
                        <input type="hidden" id="esPromotor" name="esPromotor" value="1">
                        <div id="formAsistente" style="margin:0px !important;" class="row">
                                <div class="col-sm-6">
								<div class="form-group">
                                    Identificación
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-control" onchange="BuscarAsistente()"/>
                                </div>
								</div>
                                <div class="col-sm-6">
								<div class="form-group">
                                    Nombre
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
								</div>
                                <div class="col-sm-6">
								<div class="form-group">
                                    Apellidos
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
								</div>
                                <div class="col-sm-6">
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
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" />
                                </div>
								</div>
                                <div class="col-sm-6">
								<div class="form-group">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control"  />
                                </div>
								</div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    Ciudad Persona
									<div class="form-group">
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                    </select>
									</div>
								</div>
                                <div class="col-sm-4">
                                    Sede a la cual quiere registrar el Promotor
									<div class="form-group">
                                    <select id="Sede_id" name="Sede_id" class="selectpicker" data-style="select-with-transition">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["sedes"] as $sede)
                                            <option value="{{ $sede->id }}">{{ $sede->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>

                            <br>
          
                                <div class="col-sm-12">
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
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
