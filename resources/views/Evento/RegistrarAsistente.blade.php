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
    <form action="registrarAsistente" method="POST">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6">
                Nombre
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Apellidos
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Identificación
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Celular/teléfono
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Email
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Confirmar Email
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Empresa/Institución
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Sector Económico
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Cargo/Rol
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Edad
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                Departamento
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
