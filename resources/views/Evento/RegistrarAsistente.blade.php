@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Información del Evento </div>
        <div class="panel-body">
            @foreach($ElementosArray["evento"] as $InformacionEvento)
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Id:</label>
                        <div class="col-md-10">
                            {{$InformacionEvento->id }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-8">Nombre:</label>
                        <div class="col-md-10">
                            {{$InformacionEvento->Tipo_Evento }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Tipo:</label>
                        <div class="col-md-10">
                            {{ $InformacionEvento->Nombre_Evento }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Lugar:</label>
                        <div class="col-md-10">
                            {{ $InformacionEvento->Lugar_Evento }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-8">Ciudad:</label>
                        <div class="col-md-10">

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Departamento:</label>
                        <div class="col-md-10">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Fecha:</label>
                        <div class="col-md-10">
                            {{ $InformacionEvento->Fecha_Evento }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-8">Fecha Incial de resgistro:</label>
                        <div class="col-md-10">
                            {{ $InformacionEvento->Fecha_Inicial_Registro }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-md-7">Fecha Final de resgistro:</label>
                        <div class="col-md-10">
                            {{ $InformacionEvento->Fecha_Final_Registro }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <form action="{{url('registrarAsistente')}}" method="POST">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="Evento_id" name="Evento_id" value="{{$ElementosArray["EventoId"]}}">
        <div class="row">
            <div class="col-md-6">
                Nombre
                <input id="Nombre" name="Nombre" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Apellidos
                <input id="Apellidos" name="Apellidos" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Identificación
                <input id="identificacion" name="identificacion" type="text" class="form-control" />
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
                Empresa/Institución
                <input id="Empresa" name="Empresa" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Sector Económico
                <input id="secEconomico" name="secEconomico" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Cargo/Rol
                <input id="Cargo" name="Cargo" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Edad
                <input id="edad" name="edad" type="number" class="form-control" />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                Departamento persona
                <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach($ElementosArray["departamentos"] as $Departamento)
                        <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                Ciudad Persona
                <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                </select>
            </div>
        </div>

        <br/>
        <div class="column one">

            <div class="hover_color_wrapper">
                <h2 style="font-size: 20px; font-family: sans-serif; color:#2297e1;">Responde por favor la siguiente encuesta</h2>
                @foreach($ElementosArray["preguntas"] as $PreguntasFormulario)
                    <fieldset>
                        <div style="font-weight:700; font-family: sans-serif; padding-top: 2%;" name ="id_pregunta" value = "{{ $PreguntasFormulario->id }}">{{ $PreguntasFormulario->Enunciado }} </div>
                        @foreach($PreguntasFormulario->Respuestas as $respuestas)
                            <div class="col-md-6" >
                                <div class="radio">
                                    <div style="font-family: sans-serif; line-height: 30px;"><input type="radio" value="{{$respuestas->id}}" id="Respuesta" name="fk_id_respuesta[{{$loop->parent->index}}]" >
                                        <b>{{$respuestas->EnunciadoRespuesta}}</b>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <label for="fk_id_respuesta[{{$loop->index}}]" class="error" style="display:none;">Please choose one.</label>
                    </fieldset>
                @endforeach
            </div>

        </div>
        <br/>
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Registrarse
                </button>
            </div>
        </div>
    </form>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
@endsection
