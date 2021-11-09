@extends('layouts.eventos')

@section('content')
          <div class="row row-30 justify-content-center">
		  @if ($ElementosArray["evento"] ->FlyerEvento)
			<div class="col-md-10 col-lg-6">
              <div><img src="{{ $ElementosArray["rutaImagenes"].$ElementosArray["evento"]->FlyerEvento }}" alt="" width="562" height="588"/>
            </div>
            </div>
            <div class="col-md-10 col-lg-6">
              <h4>Información General</h4>
			  <ul class="list-marked">
                <li>
					<h5>Fecha y hora del evento:</h5>
					<p>{{ $ElementosArray["evento"] ->Fecha_Evento }}</p>
                </li>
                <li>
					<h5>Lugar del evento:</h5>
					<p>{{ $ElementosArray["evento"] ->Lugar_Evento }}</p>
                </li>
				<li>
					<h5>Ciudad:</h5>
					<p>{{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}</p>
                </li>
				<li>
					<h5>Boletería y localidades:</h5>
				@foreach($ElementosArray["evento"] ->preciosBoletas as $Localidad)
                     <p value="{{ $Localidad->id }}" data-num="{{ $Localidad->precio }}"><p style="text-transform: capitalize;">{{ $Localidad->localidad }}: <b>$ {{ $Localidad->precio }}</b></p></p>
                @endforeach
                </li>
              </ul>
              <p class="paragraph-inset-right-25">{!! $ElementosArray["evento"] ->informacionEvento !!}</p>
            </div>			
			@endif
          </div>


    <div style="background:#fff; border-radius:5px; padding:2%;" class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioEvento" class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="imagen" name="imagen">
                    <input type="hidden" id="Evento_id" name="Evento_id" value="{{$ElementosArray["EventoId"]}}">
                    <input type="hidden" id="esActivo" name="esActivo" value="0">
                    <input type="hidden" id="esPerfilado" name="esPerfilado" value="0">
                    <input type="hidden" id="esPago" name="esPago" value="{{$ElementosArray["evento"]->esPago}}">
                    @if ($ElementosArray["evento"] ->SolicitarPIN)
                        <div class="row">
                            <div class="col-md-12">
                                PIN
                                <input id="pinIngresar" name="pinIngresar" type="text" class="form-input" onkeyup="ValidarPin()"/>

                            </div>
                        </div>
                        <div id="formAsistente" hidden>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Identificación</label>
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-input" onchange="BuscarAsistente()"/>
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Nombre</label>
                                    <input id="Nombres" name="Nombres" type="text" class="form-input"/>
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Apellidos</label>
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-input"/>
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Celular/teléfono</label>
                                    <input id="telefono" name="telefono" type="text" class="form-input" />
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Email</label>
                                    <input id="Email" name="Email" type="text" class="form-input" />
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Confirmar Email</label>
                                    <input id="confEmail" name="confEmail" type="text" class="form-input" />
                                </div>
								</div>
                            </div>

                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label"></label>Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-input" />
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Dirección</label>
                                    <input id="Dirección" name="Dirección" type="text" class="form-input" />
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Departamento persona</label>
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-input">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["departamentos"] as $Departamento)
                                            <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Ciudad Persona</label>
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-input">

                                    </select>
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Localidad</label>
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-input">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["evento"] ->preciosBoletas as $Localidad)
                                            <option value="{{ $Localidad->id }}" data-num="{{ $Localidad->precio }}">{{ $Localidad->localidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>
								<div class="form-wrap">
                                <div class="col-md-3">
                                    <label class="form-label">Precio Ecotickets</label>
                                    <input id="valorBoleta" name="valorBoleta" type="text" class="form-input"  readonly/>
                                </div>
								</div>
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Cantidad De Ecotickets</label>
                                    <input id="CantidadTickets" name="CantidadTickets" type="number" class="form-input" onkeyup="calcularPrecioTotal()"  />
                                </div>
								</div>
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Precio Total</label>
                                    <input id="PrecioTotal" name="PrecioTotal" type="text" class="form-input"  readonly/>
                                </div>
								</div>
                            </div>


                            <div class="row row-narrow row-20">

                                <div class="col-md-12">
                                    @if($ElementosArray["EventoId"] ==75)
                                        ¿Perteneces a algún colectivo, club, grupo o asociación juvenil? ¿cuál?
                                    @else
                                        Comentario
                                    @endif
                                    <input id="ComentarioEvento" name="ComentarioEvento" type="text" class="form-input" />
                                </div>

                            </div>
                            <div class="row row-narrow row-20">
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
                                    <input type="button" onclick="validarCamposRegistrarAsistente()" class="button button-lg button-primary" value="Comprar" data-triangle=".button-overlay"/>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="formAsistente">
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Identificación</label>
                                    <input id="Identificacion" name="Identificacion" type="number" class="form-input" onchange="BuscarAsistente()"/>
                                </div>
								</div>
                                <div class="col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Nombre</label>
                                    <input id="Nombres" name="Nombres" type="text" class="form-input" />
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Apellidos</label>
                                    <input id="Apellidos" name="Apellidos" type="text" class="form-input" />
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Celular/teléfono</label>
                                    <input id="telefono" name="telefono" type="text" class="form-input" />
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Email</label>
                                    <input id="Email" name="Email" type="text" class="form-input" />
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Confirmar Email</label>
                                    <input id="confEmail" name="confEmail" type="text" class="form-input" />
                                </div>
								</div>
                            </div>

                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label"></label>Fecha de nacimiento
                                    <input id="fechaNacimiento" name="fechaNacimiento" type="date" class="form-input" />
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Dirección</label>
                                    <input id="Dirección" name="Dirección" type="text" class="form-input"  />
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Departamento persona</label>
                                    <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-input">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["departamentos"] as $Departamento)
                                            <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>
                                <div class="col-md-6">
								<div class="form-wrap">
                                    <label class="form-label">Ciudad Persona</label>
                                    <select id="Ciudad_id" name="Ciudad_id" class="form-input">

                                    </select>
                                </div>
								</div>
                            </div>
                            <div class="row">							
                                <div class="col-md-6"> 
								<h4 style="text-align:center;">Ingresa tu cupón de descuento</h4>
								<div class="row">
								<div style="padding-right:0px !important;" class="col-md-6"> 
										<input id="Codigo" name="Codigo" type="text" class="form-input" placeholder="Código de Descuento " />
									</div>
									<div style="padding-left:0px !important;" class="col-md-6"> 									
										<input style="width:100%; font-size:25px !important;" onclick="validarCodigoPromocional({{$ElementosArray["EventoId"]}})" class="btn btn-blue ripple trial-button"  name="Validador" value="Validar Código"   /></input>
									</div>
							   </div>
								</div>
                                <div style="padding-top:3%;" class="col-md-6">                                 
										<h3 style="color:#74b12e !important;" id="mensaje-cupon"></h3>
								</div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Localidad</label>
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-input">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["evento"] ->preciosBoletas as $Localidad)
                                            <option value="{{ $Localidad->id }}" data-num="{{ $Localidad->precio }}">{{ $Localidad->localidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
								</div>
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Precio Ecotickets</label>
                                    <input id="valorBoleta" name="valorBoleta" type="text" class="form-input"  readonly/>
                                </div>
								</div>
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Cantidad De Ecotickets</label>
                                    <input id="CantidadTickets" name="CantidadTickets" type="number" class="form-input" onkeyup="calcularPrecioTotal()"  />
                                </div>
								</div>
                                <div class="col-md-3">
								<div class="form-wrap">
                                    <label class="form-label">Precio Total</label>
                                    <input id="PrecioTotal" name="PrecioTotal" type="text" class="form-input"  readonly/>
                                </div>
								</div>
                            </div>
                            <div class="row row-narrow row-20">
                                <div class="col-md-12">
								<div class="form-wrap">
                                    <label class="form-label">Comentario</label>
                                    <input id="ComentarioEvento" name="ComentarioEvento" type="text" class="form-input" />
                                </div>
								</div>
                            </div>
                            <br/>
                            <div class="row row-narrow row-20">
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
                            <div class="row row-narrow row-20">
                                <div class="col-md-12">
                                    <input type="button" onclick="validarCamposRegistrarAsistente()" class="button button-lg button-primary" value="Comprar" data-triangle=".button-overlay"/>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

        </div>
    </div>
    <div>
        <form method="post" id="formPago" action="{{env('URLPOSTPAGO')}}">
            <input id="merchantId"  name="merchantId"    type="hidden"  value="">
            <input id="accountId"   name="accountId"     type="hidden"  value="">
            <input id="description" name="description"   type="hidden"  value="">
            <input id="referenceCode" name="referenceCode" type="hidden"  value="">
            <input id="amount"  name="amount"        type="hidden"  value="">
            <input id="tax"  name="tax"           type="hidden"  value="">
            <input id="taxReturnBase" name="taxReturnBase" type="hidden"  value="">
            <input id="currency" name="currency"      type="hidden"  value="">
            <input id="signature" name="signature"     type="hidden"  value="">
            <input id="test" name="test"          type="hidden"  value="">
            <input id="buyerEmail" name="buyerEmail"    type="hidden"  value="">
            <input id="responseUrl"  name="responseUrl"    type="hidden"  value="">
            <input id="confirmationUrl" name="confirmationUrl"    type="hidden"  value="">
        </form>

    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/Qrcode/qrcode.js') }}"></script>
@endsection