@extends('layouts.profile')

@section('content')
    <div class="row">	
			<div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Activar funciones</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para activar funciones de tu evento.</h4>
                </div>
                <div class="card-body ">
				
					                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
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
                                    Activar Pago
                                </th>
                                @if(Auth::user()->buscarRecurso('ActivarTienda'))
                                <th>
                                    Activar Tienda
                                </th>
                                @endif
                                <th >
                                    Activar PIN
                                </th>
                                <th >
                                    Activar Evento Publico
                                </th>
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
                                        @if($evento->esPago ==1)
                                            <input type="checkbox"  onclick="ActivarEsPago(this,{{ $evento->id }})" checked/>
                                        @else
                                            <input type="checkbox"  onclick="ActivarEsPago(this,{{ $evento->id }})" />
                                        @endif
                                    </td>
                                    @if(Auth::user()->buscarRecurso('ActivarTienda'))
                                    <td>
                                        @if($evento->activarTienda ==1)
                                            <input type="checkbox"  onclick="ActivarTienda(this,{{ $evento->id }})" checked/>
                                        @else
                                            <input type="checkbox"  onclick="ActivarTienda(this,{{ $evento->id }})" />
                                        @endif
                                    </td>
                                    @endif
                                    <td >
                                        @if($evento->SolicitarPIN ==1)
                                            <input type="checkbox"  onclick="ActivarSolicitarPIN(this,{{ $evento->id }})" checked/>
                                        @else
                                            <input type="checkbox"  onclick="ActivarSolicitarPIN(this,{{ $evento->id }})" />
                                        @endif
                                    </td>
                                    <td >
                                        @if($evento->EsPublico ==1)
                                            <input type="checkbox"  onclick="ActivarEsPublico(this,{{ $evento->id }})" checked/>
                                        @else
                                            <input type="checkbox"  onclick="ActivarEsPublico(this,{{ $evento->id }})" />
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
        </div>
		
		

    </div>

    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaEventos').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p class="btn btn-fill btn-rose">Exportar lista</p>' }
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
