@extends('layouts.app')

@section('content')
<table id="TablaListaEventos" class="table table-bordered">
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
            Fecha Inicial de registro
        </th>
        <th >
            Fecha Final de registro
        </th>
        <th></th>
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
            Fecha Inicial de registro
        </th>
        <th >
            Fecha Final de registro
        </th>
        <th></th>
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
                {{ $evento->Ciudad_Evento }}
            </td>
            <td>
                {{ $evento->Departamento_Evento }}
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
            <td><a class="btn btn-blue ripple trial-button" href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}">Registrarse</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection