@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
						<div style="overflow-x:auto;">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaEventos" class="table table-bordered">
                            <thead>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Nombre
                                </th>
                                <th>
                                    Activar
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($listEventos as $evento)
                                <tr>
                                    <td >
                                        {{ $evento->id }}
                                    </td>
                                    <td >
                                        {{ $evento->Nombre_Evento }}
                                    </td>
                                    <td >
                                        @php ($b = false)
                                        @foreach($eventosUsuario as $eventoUsuario)
                                            @if($eventoUsuario->Evento_id == $evento->id)
                                                @php ($b = true)
                                                @break
                                            @endif
                                        @endforeach
                                        @if($b)
                                            <input type="checkbox"  onclick="ActivarPermisoEvento(this,{{ $evento->id }},{{$idUsuario}})" checked/>
                                        @else
                                            <input type="checkbox"  onclick="ActivarPermisoEvento(this,{{ $evento->id }},{{$idUsuario}})" />
                                        @endif

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
    </div>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
@endsection
