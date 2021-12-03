@extends('layouts.profile')

@section('content')
			<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Usuarios</h4>
				  <button onclick="ajaxRenderSectionCrearUsuario()" type="button" class="btn btn-fill btn-rose">Nuevo Usuario</button>
                </div>
				<div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping" id="tablaUsuarios">
                      <thead>
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="th-description">Nombre y apellido</th>
                          <th class="th-description">Usuario</th>
						  <th class="th-description">Correo</th>
                          <th class="text-right">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($listUsuarios as $usuario)
                        <tr>
                          <td class="text-center">{{$usuario->id}}</td>
                          <td class="td-name">
                            <a >{{$usuario->name}}</a>
                            <br />
                            <small>{{$usuario->last_name}}</small>
                          </td>
                          <td class="td-name">
                            <a>{{$usuario->username}}</a>
                          </td>
						  <td class="td-name">
                            <a>{{$usuario->email}}</a>
                          </td>
                          <td class="td-actions text-right">
                            <a class="btn btn-rose" style="cursor:pointer;" type="button" onclick="ajaxRenderSectionEditarUsuario({{$usuario->id}})"><i class="material-icons">edit</i></a>
                            {{--<button data-toggle="modal" data-target="#modalContrasena{{$usuario->id}}" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Cambiar contraseña">--}}
                            {{--</button>--}}
                              <a data-toggle="modal" data-target="#modalContrasena{{$usuario->id}}" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Cambiar contraseña"><i class="material-icons">password</i></a>
                              <a onclick="ajaxRenderSectionCargarEventosXUsuario({{$usuario->id}})" data-toggle="modal" data-target="#modalPermisosEvento{{$usuario->id}}" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Asignar permisos"><i class="material-icons">settings</i></a>
							{{--<button onclick="ajaxRenderSectionCargarEventosXUsuario({{$usuario->id}})" data-toggle="modal" data-target="#modalPermisosEvento{{$usuario->id}}" type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Asignar permisos">

                            </button>--}}
							
							 <!--modal cambio de contraseña-->
                                            <form id="formContrasena" name="formContrasena">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" id="id" name="id" value="{{$usuario->id}}">
                                            <div class="modal fade" id="modalContrasena{{$usuario->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Cambiar Contraseña a {{$usuario->name}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    Contraseña
                                                                    <input id="password" name="password" type="password" class="form-control">
                                                                    <span class="invalid-feedback" role="alert" id="errorpassword"></span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    Confirmar Contraseña
                                                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                                                    <span class="invalid-feedback" role="alert" id="errorpassword_confirmation"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button onclick="CambiarContrasena(this)" type="button" class="btn btn-default" data-dismiss="modal">Cambiar</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            </form>
                                            <!--modal cambio de contraseña-->
                                            <!-- modal asignar permissos a eventos-->
                                            <div class="modal fade" id="modalPermisosEvento{{$usuario->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Asignar permisos a eventos: {{$usuario->name}}</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div id="panelPermisosUsuarios{{$usuario->id}}" name="panelPermisosUsuarios{{$usuario->id}}">
                                                                    @yield('content')
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- modal asignar permissos a eventos-->
							
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
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
    <!-- propias-->
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/MSistema/Usuario.js') }}"></script>
	 <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable({
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
