@extends('layouts.profile')

@section('content')

        <div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Crear Evento</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para crear tu evento y cuidar el planeta.</h4>
                </div>
                <div class="card-body ">
					<form class="form-horizontal" id="crearEvento" action="crearEvento" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="esActivo" name="esActivo" value="1">
                        <input type="hidden" id="Tipo_Evento" name="Tipo_Evento" value="Evento">
                        <div class="row">
                            <div class="col-sm-12">
							<div class="form-group">
                                <label for="Nombre_Evento" class="bmd-label-floating">Nombre del Evento</label>
                                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
                            </div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-sm-4">
							Solicitar PIN
							<div class="form-group">                                
                                <select id="SolicitarPIN" name="SolicitarPIN" class="selectpicker" data-style="select-with-transition">
                                    <option value="">Seleccionar</option>
                                    <option value="0">No</option>
                                    <option value="1">SI</option>
                                </select>
							</div>	
                            </div>
                            <div class="col-sm-4">
							Departamento del Evento
							<div class="form-group">                                
                                <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="selectpicker" data-style="select-with-transition">
                                    <option value="">Seleccionar</option>
                                    @foreach($formulario["departamentos"] as $Departamento)
                                        <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                    @endforeach
                                </select>
                            </div>
							</div>
                            <div class="col-sm-4">
							Ciudad del Evento
							<div class="form-group">                                
                                <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                </select>
                            </div>
							</div>
                        </div>
                        <div class="row">
						    <div class="col-sm-4">
							<div class="form-group">
                                <label for="Lugar_Evento" class="bmd-label-floating">Lugar del Evento</label>
                                <input id="Lugar_Evento" name="Lugar_Evento" type="text" class="form-control" />
                            </div>
							</div>
                            <div class="col-sm-4">                               
								<div class="form-group">
								 Fecha del Evento
                                <input id="Fecha_Evento" name="Fecha_Evento" type="date" class="form-control datepicker" />
                            </div>
							</div>
                            <div class="col-sm-4">
							<div class="form-group">
                                Hora del Evento
                                <input type="time" name="Hora_Evento" class="form-control">
                            </div>
							</div>
						</div>	
						<div class="row">
                            <div class="col-sm-3">
							<div class="form-group">
                                Fecha inicial de registro
                                <input id="Fecha_Inicial_Registro" name="Fecha_Inicial_Registro" type="date" class="form-control datepicker" />
                            </div>
							</div>
                            <div class="col-sm-3">
							<div class="form-group">
                                Hora inicial de registro
                                <input type="time" name="Hora_Inicial_Registro" class="form-control">
                            </div>
							</div>
                            <div class="col-sm-3">
							<div class="form-group">
                                Fecha final de registro
                                <input id="Fecha_Final_Registro" name="Fecha_Final_Registro" type="date" class="form-control datepicker" />
                            </div>
							</div>
                            <div class="col-sm-3">
							<div class="form-group">
                                Hora final de registro
                                <input type="time" name="Hora_Final_Registro" class="form-control">
                            </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
							<div class="form-group">
                                <label for="numeroAsistentes" class="bmd-label-floating">Número máximo de Asistentes</label>
                                <input id="numeroAsistentes" name="numeroAsistentes" type="text" class="form-control" />
                            </div>
							</div>
                            <div class="col-sm-3">
							¿El evento público?
							<div class="form-group">                                
                                <select id="EsPublico" name="EsPublico" class="selectpicker" data-style="select-with-transition">
                                    <option value="">Seleccionar</option>
                                    <option value="1">SI</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
							</div>
                            {{--<div class="col-md-6">
                                Correo para enviar invitación
                                <input id="CorreoEnviarInvitacion" name="CorreoEnviarInvitacion" type="text" class="form-control" />
                            </div>--}}
                            <div class="col-sm-3">
							<div class="form-group">
                                <label for="CodigoPulep" class="bmd-label-floating">Codigo PULEP</label>
                                <input id="CodigoPulep" name="CodigoPulep" type="text" class="form-control" />
                            </div>
							</div>
                            <div class="col-sm-3">
							¿El evento es Pago?
							<div class="form-group">                                
                                <select id="esPago" name="esPago" onchange="MostrarDivBoletas()" class="selectpicker" data-style="select-with-transition">
                                    <option value="">Seleccionar</option>
                                    <option value="0">No</option>
                                    <option value="1">SI</option>
                                </select>
                            </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="divPromotor" hidden>
                                Activar Promotores
								<div class="form-group">
                                <select id="usoPromotor" name="usoPromotor" class="selectpicker" data-style="select-with-transition" >
                                    <option value="">Seleccionar</option>
                                    <option value="0">No</option>
                                    <option value="1">SI</option>
                                </select>
                            </div>
							</div>
                        </div>
                        <div id="divBoletas" hidden>
						<div class="card-header card-header-rose card-header-icon">
								  <div class="card-icon">
									<i class="material-icons">contacts</i>
								  </div>
								  <h4 class="card-title">Lista de precios: indica el nombre de las localidades, el precio y la cantidad de Ecotickes.</h4>
								</div>
                            <hr/>                               

                            <div class="row" id="PreciosBoletas" name="PreciosBoletas">
                                <div class="col-md-12">
                                    <div class="form-group">
                                            <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                                                Nombre de la localidad
                                                <input id="localidad" name="localidad" type="text" class="form-control" />
                                            </div>
                                            <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                                                Precio Ecoticket
                                                <input id="precio" name="precio" type="number" class="form-control" />
                                            </div>
                                            <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                                                Cantidad disponible
                                                <input id="cantidad" name="cantidad" type="number" class="form-control" />
                                            </div>
                                            <div style="background-color:#1D2139; color:#B0D416;" class="input-group-addon">
                                                <a id="agregarRespuesta" name="agregarRespuesta" title="Agregar nueva localidad" onclick="AgregarNuevaLocalidad()"><i class="material-icons">add</i></a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
								<h4 class="title">Flyer del evento</h4>
								  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail">
									  <img src="./assets/img/image_placeholder.jpg" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail"></div>
									<div>
									  <span class="btn btn-rose btn-round btn-file">
										<span class="fileinput-new">Seleccionar flyer</span>
										<span class="fileinput-exists">Cambiar</span>
										<input type="file" name="ImagenFlyerEvento" />
									  </span>
									  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
									</div>
								  </div>			
							</div>							
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
							<div class="form-group">
                                Información para envio del la invitación
                                <textarea id="informacionEvento" name="informacionEvento"></textarea>
                            </div>
							</div>
                        </div>
                        <br/>
                        <div style="margin:0px !important;" class="row" hidden>
                            <div class="col-md-12">
                                <input type="button" class="btn btn-blue ripple trial-button" onclick="AgregarPregunta()" value="Agregar Pregunta"/>
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                <h3 class="col-md-12" hidden="hidden">Preguntas</h3>
                                <div id="ListaPreguntas">
                                    <input id="CantidadPreguntas" name="CantidadPreguntas" type="hidden"  value="0"/>
                                </div>
                                <hr style="border-top-color:lightslategray; width:100%" />
                                <div class="row">
                                    <div class="col-sm-12">
									<div class="form-group">
                                        <button type="button" class="btn btn-fill btn-rose" onclick="validarCamposCrearEvento()">
                                            Crear Evento
                                        </button>
                                    </div>
									</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>				

              </div>
                </div>
              </div>
        </div>    


    <div hidden="hidden">

        <div class="panel-group" id="divPregunta" name="divPregunta">
            <hr style="border-top-color:lightslategray; width:100%" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-warning">
                                    <span><strong>¿</strong></span>
                                </div>
                                <input class="form-control" type="text" id="TextoPregunta" name="TextoPregunta"   />
                                <input id="TextoTipoPregunta" name="TextoTipoPregunta" type="hidden"  value="1"/>
                                <div class="input-group-addon alert-warning">
                                    <span><strong>?</strong> </span>
                                </div>
                                <div class="input-group-addon alert-warning">
                                    <a id="eliminarPregunta" name="eliminarPregunta" title="Eliminar Pregunta" data-toggle="modal" data-target="#modalElimianarPregunta"><span class="glyphicon glyphicon-minus"  ></span></a>
                                </div>
                                <div class="input-group-addon alert-warning">
                                    <a id="agregarRespuesta" name="agregarRespuesta" title="Agregar Respuesta" onclick="AgregarRespuesta(this)"><span class="glyphicon glyphicon-plus"  ></span></a>
                                </div>
                                <!-- Modal confirmación elimminar pregunta-->
                                <div id="modalElimianarPregunta" name="modalElimianarPregunta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la pregunta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    ¿Esta seguro que desea eliminar la pregunta?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarPregunta(this)">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal confirmación elimminar pregunta-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" name="Respuesta">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-warning">
                                    <span><strong>*</strong></span>
                                </div>
                                <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   />
                                <div class="input-group-addon alert-warning">
                                    <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                                <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la pregunta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    ¿Esta seguro que desea eliminar la respuesta?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" name="Respuesta">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-warning">
                                    <span><strong>*</strong></span>
                                </div>
                                <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   />
                                <div class="input-group-addon alert-warning">
                                    <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                                <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la pregunta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    ¿Esta seguro que desea eliminar la respuesta?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" name="Respuesta">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-warning">
                                    <span><strong>*</strong></span>
                                </div>
                                <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   />
                                <div class="input-group-addon alert-warning">
                                    <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                                <div id="modalElimianarRespuesta"  name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la pregunta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    ¿Esta seguro que desea eliminar la respuesta?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" name="Respuesta">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-warning">
                                    <span><strong>*</strong></span>
                                </div>
                                <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   />
                                <div class="input-group-addon alert-warning">
                                    <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                                <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la pregunta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    ¿Esta seguro que desea eliminar la respuesta?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal confirmación elimminar respuesta-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="row" id="RespuestaPlantilla" name="RespuestaPlantilla" hidden="hidden">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon alert-warning">
                        <span><strong>*</strong></span>
                    </div>
                    <input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"   />
                    <div class="input-group-addon alert-warning">
                        <a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta"><span class="glyphicon glyphicon-minus"  ></span></a>
                    </div>
                    <!-- Modal confirmación elimminar respuesta-->
                    <div id="modalElimianarRespuesta" name="modalElimianarRespuesta" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Enunciado de la pregunta</h4>
                                </div>
                                <div class="modal-body" style="text-align:center; color:black">
                                    <div class="row">
                                        ¿Esta seguro que desea eliminar la respuesta?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarRespuesta(this)">Eliminar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal confirmación elimminar respuesta-->
                </div>
            </div>
        </div>
    </div>

    <div class="row"  id="DivPreciosBoletas" hidden>
        <div class="col-md-12">
            <div class="form-group">
                <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                    Localidad
                    <input id="localidad" name="localidad" type="text" class="form-control" />
                </div>
                <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                    Precio Boleta
                    <input id="precio" name="precio" type="number" class="form-control" />
                </div>
                <div style="background-color:#fff; color:#1D2139;" class="input-group-addon" >
                    Cantidad
                    <input id="cantidad" name="cantidad" type="number" class="form-control" />
                </div>
                <div style="background-color:#1D2139; color:#B0D416;" class="input-group-addon">
                    <a id="elimminarLocalidad" name="elimminarLocalidad" title="Eliminar localidad" onclick="EliminarLocalidad(this)"><i class="material-icons">clear</i></a>
                </div>
            </div>
        </div>
    </div>

<div id="elmentosEliminados" hidden="hidden">

</div>

    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('informacionEvento');
    </script>

@endsection