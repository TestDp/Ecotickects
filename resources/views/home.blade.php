@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Eco</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-primary" href="{{ url('FormularioEvento') }}">Crear Evento</a>

                        <table id="TablaListaEventos"  class="table table-bordered">
                            <thead>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Tipo
                                </th>
                                <th >
                                    Nombre
                                </th>
                                <th >
                                    Lugar
                                </th>
                                <th >
                                    Ciudad
                                </th>
                                <th >
                                    Departamento
                                </th>
                                <th >
                                    Fecha del Evento
                                </th>
                                <th >
                                    Fecha Incial de resgistro
                                </th>
                                <th >
                                    Fecha Final de resgistro
                                </th>
                                <th >
                                    Asistentes
                                </th>
                                <th >
                                    Estadisticas
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Tipo
                                </th>
                                <th >
                                    Nombre
                                </th>
                                <th >
                                    Lugar
                                </th>
                                <th >
                                    Ciudad
                                </th>
                                <th >
                                    Departamento
                                </th>
                                <th >
                                    Fecha del Evento
                                </th>
                                <th >
                                    Fecha Incial de resgistro
                                </th>
                                <th >
                                    Fecha Final de resgistro
                                </th>
                                <th >
                                    Asistentes
                                </th>
                                <th >
                                    Estadisticas
                                </th>
                            </tr>
                            </tfoot>
                            <tbody >
                            @foreach($ListaEventos["eventos"] as $evento)
                                <tr>
                                    <td >
                                        {{ $evento->id }}
                                    </td>
                                    <td >
                                    {{ $evento->Tipo_Evento }}
                                    <td >
                                        {{ $evento->Nombre_Evento }}
                                    </td>
                                    <td >
                                        {{ $evento->Lugar_Evento }}
                                    </td>
                                    <td >

                                    </td>
                                    <td>

                                    </td>
                                    <td >
                                        {{ $evento->Fecha_Evento }}
                                    </td>
                                    <td >
                                        {{ $evento->Fecha_Inicial_Registro }}
                                    </td>
                                    <td>
                                        {{ $evento->Fecha_Final_Registro }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('/ListaAsistentes') }}">ver</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('/FormularioEvento') }}">ver</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
