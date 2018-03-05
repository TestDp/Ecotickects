
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
        @if($ElementosArray["EventoId"] ==38)
            Dirección
        @else
            Agencia/Empresa
        @endif
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
        Comentario
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

