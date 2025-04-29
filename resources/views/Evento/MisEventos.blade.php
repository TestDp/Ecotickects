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
	
	    <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Próximos Eventos</h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping" id="TablaListaEventos">
                      <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="th-description">Evento</th>
                          <th class="th-description">Ubicación</th>
                          <th class="th-description">Fecha</th>
                          <th class="text-right">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($ListaEventos["eventos"] as $evento)
                        <tr>
                          <td class="text-center">{{ $evento->id }}</td>
                          <td class="td-name">
                            <a href="#">{{ $evento->Nombre_Evento }}</a>
                            <br />
                            <small>{{ $evento->Lugar_Evento }}</small>
                          </td>
                          <td class="td-name">
                            <a href="#">{{ $evento->Nombre_Ciudad }}</a>
                            <br />
                            <small>{{ $evento->Nombre_Departamento }}</small>
                          </td>
						  <td class="td-name">
                            <a href="#">{{ $evento->Fecha_Evento }}</a>
                          </td>
                          <td class="td-actions text-right">
							@if(Auth::user()->buscarRecurso('ListaAsistentes'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Personas Registradas">
                              <a href="{{ url('/ListaAsistentes',['idEvento' => $evento->id ]) }}"><i class="material-icons">group</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('Estadisticas'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Estadísticas">
                              <a href="{{ url('/Estadisticas',['idEvento' => $evento->id ]) }}"><i class="material-icons">analytics</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('LecturaQR'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Leer QR">
                              <a href="{{ url('/LecturaQR',['idEvento' => $evento->id ]) }}"><i class="material-icons">qr_code_scanner</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('EditarEvento'))
							<button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Editar">
                              <a href="{{ url('/EditarEvento',['idEvento' => $evento->id ]) }}"><i class="material-icons">edit</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('Liquidacion'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Liquidación">
                              <a href="{{ url('/Liquidacion',['idEvento' => $evento->id ]) }}"><i class="material-icons">paid</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('InformePromotor'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Informe promotor">
                              <a href="{{ url('/InformePromotor',['idEvento' => $evento->id ]) }}"><i class="material-icons">contact_mail</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('InformeUsuarioBoleta'))
							<button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Informe UsuariosXBoleta">
                              <a href="{{ url('/InformeUsuarioBoleta',['idEvento' => $evento->id ]) }}"><i class="material-icons">badge</i></a>
                            </button>
							@endif
                            @if(Auth::user()->buscarRecurso('ListaTickets'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Mis tickets">
                                <a href="{{ url('/ListaTickets',['idEvento' => $evento->id,'$idAsistente'=> 0]) }}"><i class="material-icons">group</i></a>
                            </button>
                            @endif
                            @if(Auth::user()->buscarRecurso('GenerarQREvento'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Generar QR Evento">
                                <a href="{{ url('/GenerarQREnlaceEvento',['idEvento' => $evento->id]) }}"><span class="material-icons">move_to_inbox</span></a>
                            </button>
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
		
			    <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Eventos pasados</h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping" id="TablaListaEventos2">
                      <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="th-description">Evento</th>
                          <th class="th-description">Ubicación</th>
                          <th class="th-description">Fecha</th>
                          <th class="text-right">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($ListaEventosPasados["eventosPasados"] as $eventoPasado)
                        <tr>
                          <td class="text-center">{{ $eventoPasado->id }}</td>
                          <td class="td-name">
                            <a href="#">{{ $eventoPasado->Nombre_Evento }}</a>
                            <br />
                            <small>{{ $eventoPasado->Lugar_Evento }}</small>
                          </td>
                          <td class="td-name">
                            <a href="#">{{ $eventoPasado->Nombre_Ciudad }}</a>
                            <br />
                            <small>{{ $eventoPasado->Nombre_Departamento }}</small>
                          </td>
						  <td class="td-name">
                            <a href="#">{{ $eventoPasado->Fecha_Evento }}</a>
                          </td>
                          <td class="td-actions text-right">
							@if(Auth::user()->buscarRecurso('ListaAsistentes'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Personas registradas">
                              <a href="{{ url('/ListaAsistentes',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">group</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('Estadisticas'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Estadísticas">
                              <a href="{{ url('/Estadisticas',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">analytics</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('LecturaQR'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Leer QR">
                              <a href="{{ url('/LecturaQR',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">qr_code_scanner</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('EditarEvento'))
							<button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Editar">
                              <a href="{{ url('/EditarEvento',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">edit</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('Liquidacion'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Liquidación">
                              <a href="{{ url('/Liquidacion',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">paid</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('InformePromotor'))
                            <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Informe promotor">
                              <a href="{{ url('/InformePromotor',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">contact_mail</i></a>
                            </button>
							@endif
							@if(Auth::user()->buscarRecurso('InformeUsuarioBoleta'))
							<button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Informe UsuariosXBoleta">
                              <a href="{{ url('/InformeUsuarioBoleta',['idEvento' => $eventoPasado->id ]) }}"><i class="material-icons">badge</i></a>
                            </button>
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

    <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
   <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaEventos').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p class="btn btn-rose" style="color: green !important; font-size: 20px; text-align: center;">Exportar lista</p>' }
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
                        { extend: 'excel', text: '<p class="btn btn-rose" style="color: green !important; font-size: 20px; text-align: center;">Exportar lista</p>' }
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
