@extends('layouts.profile')

@section('content')
	<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Departamentos</h4>
                </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
						<div style="padding-bottom:2%;" class="row">
							<div style="text-align: left;" class="col-md-6">
							<a class="btn btn-rose" href="#">Agregar Ciudad</a>
							</div>
						</div>
						<div class="table-responsive">
						<table id="TablaListaEventos" class="table table-shopping">
                            <thead>
                            <tr >
                                <th >
                                    Codigo
                                </th>
                                <th >
                                    Nombre
                                </th>
                                <th >
                                  Accción
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($listaCiudades as $ciudad)
                                <tr>
                                    <td >
                                        {{ $ciudad->Codigo_Ciudad }}
                                    </td>
                                    <td >
                                        {{ $ciudad->Nombre_Ciudad }}
                                    </td>
                                    <td>
                                        <button onclick="" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Editar">
											<a href=""><i class="material-icons">edit</i></a>
										</button>
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


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

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
        });
    </script>
@endsection
