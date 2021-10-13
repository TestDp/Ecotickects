@extends('layouts.profile')

@section('content')
@if(isset($respuestaProceso))
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @if($respuestaProceso)
        <script type="text/javascript">
            swal({
                title: "Transaccción exitosa!",
                text: "El evento  fue guardado con exito!",
                icon: "success",
                button: "OK",
            });
        </script>
        @else
            <script type="text/javascript">
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible guardar  el evento!",
                    icon: "error",
                    button: "OK",
                });
            </script>
        @endif
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Mis Eventos</h3></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Auth::user()->buscarRecurso('FormularioEvento'))
                            <div style="padding-bottom:2%;" class="row">
                                <div style="text-align: left;" class="col-md-6">
                                <a class="btn btn-blue ripple trial-button" href="{{ url('FormularioEvento') }}">Crear Evento</a>
                                </div>
                            </div>
                        @endif

                            <ul class="nav nav-tabs" >
                                <li class="active">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#EventosProximo" role="tab" aria-controls="home"
                                       aria-selected="true">Eventos Proximos</a>
                                </li>
                                <li>
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#EventosPasados" role="tab" aria-controls="profile"
                                       aria-selected="false">Eventos pasados</a>

                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade in active" id="EventosProximo" role="tabpanel" aria-labelledby="home-tab">
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
                                             @if(Auth::user()->buscarRecurso('ListaAsistentes'))
                                                    <th >
                                                        Usuarios
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('Estadisticas'))
                                                    <th>
                                                        Estadísticas
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('LecturaQR'))
                                                    <th>
                                                        Leer QR
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('EditarEvento'))
                                                    <th>
                                                    Editar
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('EditarEvento'))
                                                    <th>
                                                        Liquidación
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('EditarEvento'))
                                                    <th>
                                                        Informe Promotor
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('EditarEvento'))
                                                    <th>
                                                        Informe UsuarioxBoleta
                                                    </th>
                                                @endif

                                            </tr>
                                            </thead>
                                            <tbody >
                                            @foreach($ListaEventos["eventos"] as $evento)
                                                <tr>
                                                    <td >
                                                        {{ $evento->id }}
                                                    </td>
                                                    <td >
                                                        {{ $evento->Nombre_Evento }}
                                                    </td>
                                                    <td >
                                                        {{ $evento->Lugar_Evento }}
                                                    </td>
                                                    <td >
                                                        {{ $evento->Nombre_Ciudad }}
                                                    </td>
                                                    <td>
                                                        {{ $evento->Nombre_Departamento }}
                                                    </td>
                                                    <td >
                                                        {{ $evento->Fecha_Evento }}
                                                    </td>
                                                  @if(Auth::user()->buscarRecurso('ListaAsistentes'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/ListaAsistentes',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-users"></i></a>
                                                        </td>
                                                    @endif

                                                    @if(Auth::user()->buscarRecurso('Estadisticas'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/Estadisticas',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-calculator"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('LecturaQR'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/LecturaQR',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-qrcode"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('EditarEvento'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/EditarEvento',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-edit"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('Liquidacion'))
                                                    <td style="text-align:center;">
                                                        <a href="{{ url('/Liquidacion',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-archive"></i></i></a>
                                                    </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('InformePromotor'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/InformePromotor',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-columns"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('InformeUsuarioBoleta'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/InformeUsuarioBoleta',['idEvento' => $evento->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fa fa-clipboard"></i></a>
                                                        </td>
                                                    @endif
                                             </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="EventosPasados" role="tabpanel" aria-labelledby="profile-tab">
                                    <!-- poner la tabla de eventos pasados-->
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaEventos2" class="table table-bordered">
                                            <thead>
                                            <tr >
                                                <th >
                                                    Id
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
                                              @if(Auth::user()->buscarRecurso('ListaAsistentes'))
                                                    <th >
                                                        Usuarios
                                                    </th>
                                                @endif
                                                 @if(Auth::user()->buscarRecurso('Estadisticas'))
                                                    <th>
                                                        Estadísticas
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('LecturaQR'))
                                                    <th>
                                                        Leer QR
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('Liquidacion'))
                                                <th>
												    Liquidación
                                                </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('InformePromotor'))
                                                    <th>
                                                        Informe Promotor
                                                    </th>
                                                @endif
                                                @if(Auth::user()->buscarRecurso('InformeUsuarioBoleta'))
                                                    <th>
                                                        Informe UsuarioxBoleta
                                                    </th>
                                            @endif
                                          </thead>
                                            <tbody >
                                            @foreach($ListaEventosPasados["eventosPasados"] as $eventoPasado)
                                                <tr>
                                                    <td >
                                                        {{ $eventoPasado->id }}
                                                    </td>
                                                    <td >
                                                        {{ $eventoPasado->Nombre_Evento }}
                                                    </td>
                                                    <td >
                                                        {{ $eventoPasado->Lugar_Evento }}
                                                    </td>
                                                    <td >
                                                        {{ $eventoPasado->Nombre_Ciudad }}
                                                    </td>
                                                    <td>
                                                        {{ $eventoPasado->Nombre_Departamento }}
                                                    </td>
                                                    <td >
                                                        {{ $eventoPasado->Fecha_Evento }}
                                                    </td>
                                                   @if(Auth::user()->buscarRecurso('ListaAsistentes'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/ListaAsistentes',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-users"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('Estadisticas'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/Estadisticas',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-chart-bar"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('LecturaQR'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/LecturaQR',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-qrcode"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('Liquidacion'))
                                                    <td style="text-align:center;">
                                                        <a href="{{ url('/Liquidacion',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-chart-line"></i></a>
                                                    </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('InformePromotor'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/InformePromotor',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-chart-line"></i></a>
                                                        </td>
                                                    @endif
                                                    @if(Auth::user()->buscarRecurso('InformeUsuarioBoleta'))
                                                        <td style="text-align:center;">
                                                            <a href="{{ url('/InformeUsuarioBoleta',['idEvento' => $eventoPasado->id ]) }}"><i style="font-size: 25px; color: #8abd51;" class="fas fa-chart-line"></i></a>
                                                        </td>
                                                    @endif
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
        </div>
    </div>


   <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
$(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#home-tab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaEventos').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p style="color: green !important; font-size: 20px; text-align: center;"><img src="http://estebanquinteroc.com/wp-content/uploads/2017/10/icono-excel.png"></img>Exportar lista</p>' }
                    ]
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
			
			var table2 = $('#TablaListaEventos2').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p style="color: green !important; font-size: 20px; text-align: center;"><img src="http://estebanquinteroc.com/wp-content/uploads/2017/10/icono-excel.png"></img>Exportar lista</p>' }
                    ]
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
			
			
		
        });
    </script>
@endsection
