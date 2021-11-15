@extends('layouts.profile')

@section('content')

		<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Roles</h4>
				        <div class="row">
                        <div class="col-md-4">
                            <a class="btn btn-rose" href="{{ url('crearRol')}}">Nuevo Rol</a>
                        </div>
						</div>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping" id="tablaRoles">
                      <thead>
                        <tr>
                          <th class="th-description">Nombre</th>
                          <th class="th-description">Descripción</th>
                          <th class="text-right">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($listRoles as $roles)
                        <tr>
                            <td class="td-name">
                            <a >{{$roles->Nombre}}</a>
                          </td>
						  <td class="td-name">
                            <a>{{$roles->Descripcion}}</a>
                          </td>
                          <td class="td-actions text-right">
								<a href="{{ url('editarRol')}}/{{$roles->id}}" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Editar rol">
                                                <i class="material-icons">edit</i></a>
                                </a>							
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


    <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
	<script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <!-- Plugins-->
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
    <script src="{{ asset('js/MSistema/Rol.js') }}"></script>

    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaRoles').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page'
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
