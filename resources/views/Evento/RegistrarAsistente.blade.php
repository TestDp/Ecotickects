@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#74b12e;"><h1 style="text-align:center;">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h1></div>
                    <div class="panel-body">
					@if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
                        @if ($ElementosArray["evento"] ->FlyerEvento)
                            <div class="row">
                                <div class="col-sm-4">
                                    <img class="img-responsive" src="{{ $ElementosArray["rutaImagenes"].$ElementosArray["evento"]->FlyerEvento }}"></img>
                                </div>
                            @endif
							   <div style="padding:1%; color:#000;" class="col-sm-4">
									<div class="form-group">
										<label class="col-md-7">Lugar:</label>
										<div class="col-md-10">
											{{ $ElementosArray["evento"] ->Lugar_Evento }}
										</div>
									</div>
								</div>
								 <div style="padding:1%; color:#000;" class="col-sm-4">
									<div class="form-group">
										<label class="col-md-8">Ciudad de ubicación:</label>
										<div class="col-md-10">
											{{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}
										</div>
									</div>
								</div>
								<div style="border: dashed 2px #fff; padding:2%; background:#ff8000; color:#fff;" class="col-sm-8">
									<div class="form-group">
										@if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
											<label class="col-md-7">Cupón válido hasta:</label>
										@else
											<label class="col-md-7">Fecha:</label>
										@endif
										<div class="col-md-10">
											{{ $ElementosArray["evento"] ->Fecha_Evento }}
										</div>
									</div>
								</div>
								<div style="border: solid 2px #74b12e; padding:2%; color:#000;" class="col-sm-8">
                                    <div class="form-group">
                                        @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
                                            <label class="col-md-8">Recomendaciones:</label>
                                            <div class="col-md-10">
                                                {!! $ElementosArray["evento"] ->informacionEvento !!}
                                            </div>
                                        @else
                                        @endif
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<h4 style="color:#000 !important; font-size:20px !important; text-align:center;">Diligencia la siguiente información para obtener tu código QR luego revisa tu correo electrónico y ¡DISFRUTA! (recuerda revisar tu bandeja de spam).</h4>
								</div>
							</div>	
                        <div style="display:none;" class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-md-7">Nombre:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"] ->Nombre_Evento }}
                                        <input type="hidden" id="nomEvenQR" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-md-7">Lugar:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"] ->Lugar_Evento }}
                                    </div>
                                </div>
                            </div>
                            <div style="display:none;" class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-md-8">Ciudad:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}
                                    </div>
                                </div>
                            </div>
                            <div style="display:none;" class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-md-7">Departamento:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"]->ciudad->departamento->Nombre_Departamento }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" class="row">
                            <div class="col-sm-4">
                            <div class="form-group">
                                @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
                                    <label class="col-md-7">Fecha Expiración del Cupon:</label>
                                @else
                                    <label class="col-md-7">Fecha:</label>
                                @endif
                                <div class="col-md-10">
                                    {{ $ElementosArray["evento"] ->Fecha_Evento }}
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')

                                    @else
                                        <label class="col-md-8">Fecha Inicial de registro:</label>
                                        <div class="col-md-10">
                                            {{ $ElementosArray["evento"] ->Fecha_Inicial_Registro }}
                                        </div>
                                    @endif


                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')

                                    @else
                                    <label class="col-md-7">Fecha Final de registro:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"] ->Fecha_Final_Registro }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div style="display:none;" class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
                                            <label class="col-md-8">Recomendaciones:</label>
                                            <div class="col-md-10">
                                                {!! $ElementosArray["evento"] ->informacionEvento !!}
                                            </div>
                                        @else
                                        @endif
                                    </div>
                                </div>

                            </div>
						@else
						 <div class="row">
								 <div class="col-sm-6">
                                    <img class="img-responsive" src="{{ $ElementosArray["rutaImagenes"].$ElementosArray["evento"]->FlyerEvento }}"></img>
                                </div>
								<div style="text-align:center; border-top: 2px solid #74b12e; border-left: 2px solid #74b12e; border-right: 2px solid #74b12e;  padding:1%;" class="col-sm-3">
								<label>Evento:</label> {{ $ElementosArray["evento"] ->Nombre_Evento }}
								</div>
								<div style="text-align:center; border-top: 2px solid #74b12e; border-right: 2px solid #74b12e; border-left: 2px solid #74b12e; padding:1%;" class="col-sm-3">
								<label>Ciudad:</label> {{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}
								</div>
								<div style="text-align:center; border: 2px solid #74b12e; padding:1%;" class="col-sm-6">
								<label>Lugar del evento:</label> {{ $ElementosArray["evento"] ->Lugar_Evento }}</br>
								<label>Fecha del evento:</label> {{ $ElementosArray["evento"] ->Fecha_Evento }}
								</div>
								<div style="text-align:center; border: 2px solid #d7d7d7; background:#d7d7d7; padding:2%;" class="col-sm-3">
								<label>Lanzamiento:</label></br>{{ $ElementosArray["evento"] ->Fecha_Inicial_Registro }}
								</div>
								<div style="text-align:center; border: 2px solid #d7d7d7; background:#d7d7d7; padding:2%;" class="col-sm-3">
								<label>Finalización:</label></br>{{ $ElementosArray["evento"] ->Fecha_Final_Registro }}
								</div>
                            </div>
					@endif	
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="background:#fff; border-radius:5px; padding:2%;" class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioEvento" action="{{url('registrarAsistente')}}" method="POST">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="imagen" name="imagen">
                    <input type="hidden" id="Evento_id" name="Evento_id" value="{{$ElementosArray["EventoId"]}}">
                    <input type="hidden" id="esActivo" name="esActivo" value="0">
                    <input type="hidden" id="esPerfilado" name="esPerfilado" value="0">
                    @if ($ElementosArray["evento"] ->SolicitarPIN)
                        <div class="row">
                            <div class="col-md-12">
                                PIN
                                <input id="pinIngresar" name="pinIngresar" type="text" class="form-control" onkeyup="ValidarPin()"/>

                            </div>
                        </div>
                        <div id="formAsistente" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    Identificación
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-control" onchange="BuscarAsistente()"/>
                                </div>
                                <div class="col-md-6">
                                    Nombre
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Apellidos
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Celular/teléfono
                                    <input id="telefono" name="telefono" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Email
                                    <input id="Email" name="Email" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Confirmar Email
                                    <input id="confEmail" name="confEmail" type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">

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
                            <div class="row">
                                <div class="col-md-12">
                                    Comentario (Opcional)
                                    <input id="ComentarioEvento" name="ComentarioEvento" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
								<span style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
									<input type="checkbox" name="terminos" value="1" id="terminos" /> Estoy de acuerdo con los términos y condiciones. <a href="{{ url('terminosCondiciones') }}" target="_blank">Ver más</a>
								</span>
                                </div>
                                <div class="col-md-6">
								<span style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
                                    <input type="checkbox" name="HabeasData" value="1" id="HabeasData" /> Estoy de acuerdo con las políticas HABEAS DATA. <a href="{{ url('habeasData') }}" target="_blank">Ver más</a>
								</span>
                                </div>
                            </div>
                            <br/>
                            <div class="column one">
                                @if(count($ElementosArray["evento"]->preguntas) >0)
                                <div class="hover_color_wrapper">
                                    <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                                    @foreach($ElementosArray["evento"] ->preguntas as $PreguntasFormulario)
                                        <fieldset>
                                            <div style="font-weight:700; font-family: sans-serif; padding-top: 2%;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}">{{ $PreguntasFormulario->Enunciado }} </div>
                                            @foreach($PreguntasFormulario->Respuestas as $respuestas)
                                                <div class="col-md-6" >
                                                    <div class="radio">
                                                        <div style="font-family: sans-serif; line-height: 30px;"><input type="radio" value="{{$respuestas->id}}" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" >
                                                            <b>{{$respuestas->EnunciadoRespuesta}}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <label for="Respuesta_id[{{$loop->index}}]" class="error" style="display:none;">Please choose one.</label>
                                        </fieldset>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" onclick="generarQRCode()" class="btn btn-blue ripple trial-button">
                                        Registrarse
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="formAsistente">
                            <div class="row">
                                <div class="col-md-6">
                                    Identificación
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-control" onchange="BuscarAsistente()"/>
                                </div>
                                <div class="col-md-6">
                                    Nombre
                                    <input id="Nombres" name="Nombres" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Apellidos
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Celular/teléfono
                                    <input id="telefono" name="telefono" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    Email
                                    <input id="Email" name="Email" type="text" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Confirmar Email
                                    <input id="confEmail" name="confEmail" type="text" class="form-control" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control"  />
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    Departamento
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["departamentos"] as $Departamento)
                                            <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Ciudad
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Comentario (Opcional)
                                    <input id="ComentarioEvento" name="ComentarioEvento" type="text" class="form-control" />
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
								<span style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
									<input type="checkbox" name="terminos" value="1" id="terminos" /> Estoy de acuerdo con los términos y condiciones.<a href="{{ url('terminosCondiciones') }}" target="_blank">Ver más</a>
								</span>
                                </div>
                                <div class="col-md-6">
								<span style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
									<input type="checkbox" name="HabeasData" value="1" id="HabeasData" /> Estoy de acuerdo con las políticas HABEAS DATA. <a href="{{ url('habeasData') }}" target="_blank">Ver más</a>
								</span>
                                </div>
                            </div>
                            <br/>
                            <div class="column one">
                                @if(count($ElementosArray["evento"]->preguntas) >0)
                                <div class="hover_color_wrapper">
                                    <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                                    @foreach($ElementosArray["evento"] ->preguntas as $PreguntasFormulario)
                                        <fieldset>
                                            <div style="font-size: 20px; font-weight:700; font-family: sans-serif; padding-top: 2%;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}">{{ $PreguntasFormulario->Enunciado }} </div>
                                            @foreach($PreguntasFormulario->Respuestas as $respuestas)
                                                <div class="col-md-12" >
                                                    <div class="radio">
                                                        <div style="font-family: sans-serif; line-height: 30px;"><input type="radio" value="{{$respuestas->id}}" id="Respuesta_id" name="Respuesta_id[{{$loop->parent->index}}]" >
                                                            <p>{{$respuestas->EnunciadoRespuesta}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <label for="Respuesta_id[{{$loop->index}}]" class="error" style="display:none;">Please choose one.</label>
                                        </fieldset>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" onclick="generarQRCode()" class="btn btn-blue ripple trial-button">
                                        Registrarse
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/Qrcode/qrcode.js') }}"></script>


@endsection
