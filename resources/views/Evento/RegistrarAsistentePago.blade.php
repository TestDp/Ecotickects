@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#74b12e;"><h1 style="text-align:center;">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h1></div>
                    <div class="panel-body">
                        @if ($ElementosArray["evento"] ->FlyerEvento)
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
                        <div style="display:none;" class="row">
                            <!--div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-md-7">Id:</label>
                                    <div class="col-md-10">
                                        {{$ElementosArray["evento"] ->id }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-md-8">Tipo:</label>
                                    <div class="col-md-10">
                                        {{$ElementosArray["evento"] ->Tipo_Evento }}
                                    </div>
                                </div>
                            </div-->
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="col-md-7">Evento:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"] ->Nombre_Evento }}
                                        <input type="hidden" id="nomEvenQR" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="col-md-7">Lugar del evento:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"] ->Lugar_Evento }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="col-md-8">Ciudad:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="col-md-7">Departamento:</label>
                                    <div class="col-md-10">
                                        {{ $ElementosArray["evento"]->ciudad->departamento->Nombre_Departamento }}
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div style="display:none;"  class="row">
                                <div class="col-sm-2">
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
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')

                                        @else
                                            <label class="col-md-8">Válido desde:</label>
                                            <div class="col-md-10">
                                                {{ $ElementosArray["evento"] ->Fecha_Inicial_Registro }}
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        @if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')

                                        @else
                                            <label class="col-md-7">Válido hasta:</label>
                                            <div class="col-md-10">
                                                {{ $ElementosArray["evento"] ->Fecha_Final_Registro }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div style="display:none;"  class="row">

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

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="background:#fff; border-radius:5px; padding:2%;" class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="formularioEvento">
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
                                    Edad
                                    <input id="Edad" name="Edad" type="number" class="form-control" />
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
                                <div class="col-md-3">
                                    Localidad
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["evento"] ->preciosBoletas as $Localidad)
                                            <option value="{{ $Localidad->id }}" data-num="{{ $Localidad->precio }}">{{ $Localidad->localidad }}</option>
                                        @endforeach
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


                            <div class="row">

                                <div class="col-md-12">
                                    @if($ElementosArray["EventoId"] ==75)
                                        ¿Perteneces a algún colectivo, club, grupo o asociación juvenil? ¿cuál?
                                    @else
                                        Comentario
                                    @endif
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
                                    <input onclick="validarCamposRegistrarAsistente()" class="btn btn-blue ripple trial-button" value="Comprar"/>
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
                                    Edad
                                    <input id="Edad" name="Edad" type="number" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    Dirección
                                    <input id="Dirección" name="Dirección" type="text" class="form-control"  />
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
                                <div class="col-md-3">
                                    Codigo de Descuento
                                    <input id="Codigo" name="Codigo" type="text" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                Validar
                                    <input  onclick="validarCodigoPromocional(this.Codigo,{{$ElementosArray["EventoId"]}})" class="btn btn-blue ripple trial-button"  name="Validador" value="Validar Codigo"   />
                                </div>
                                <div class="col-md-3">
                                    <label id="Mensaje" name="Mensaje" type="label" show="hide" class="form-control"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Localidad
                                    <select id="localidad" name="localidad" onchange="mostrarPrecioBoleta()" class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["evento"] ->preciosBoletas as $Localidad)
                                            <option value="{{ $Localidad->id }}" data-num="{{ $Localidad->precio }}">{{ $Localidad->localidad }}</option>
                                        @endforeach
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
                            <div class="row">
                                <div class="col-md-6">



                                        @if($ElementosArray["evento"] ->usoPromotor ==1)





                                   Seleccione  Promotor
                                    <select id="Promotor_id" name="Promotor_id"  class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($ElementosArray["evento"] ->promotores as $Promotor)
                                            <option value="{{ $Promotor->id }}">{{ $Promotor->Nombres }}</option>
                                        @endforeach
                                    </select>


                                    @else

                                    @endif



                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Comentario
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
                                    <input onclick="validarCamposRegistrarAsistente()" class="btn btn-blue ripple trial-button" value="Comprar"/>
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
