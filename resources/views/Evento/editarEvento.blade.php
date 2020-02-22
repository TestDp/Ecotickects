@extends('layouts.profile')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><h3>EDITAR EVENTO</h3></div>
					<div style="text-align: left;" class="col-md-12">
						<div class="panel-heading text-center"><a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a></div>
					</div>
					<form id="crearEvento" action="{{url('actualizarEvento')}}" method="POST" enctype="multipart/form-data">
						<input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}"/>
						<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
						<input type="hidden" id="id" name="id" value="{{$evento->id}}">
						<div style="margin:0px !important;" class="row">
							<div class="col-md-6">
								Nombre del Evento
								<input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" value="{{$evento->Nombre_Evento}}"/>
							</div>
							<div class="col-md-3">
								Tipo de Evento
								<select id="Tipo_Evento" name="Tipo_Evento" class="form-control">
									<option value="">Seleccionar</option>
									@if ($evento->Tipo_Evento =='Evento')
										<option value="Evento" selected>Evento</option>
										<option value="Cupon">Cupón</option>
									@else
										<option value="Evento">Evento</option>
										<option value="Cupon" selected>Cupón</option>
									@endif
								</select>
							</div>
							<div class="col-md-3">
								Solicitar PIN
								<select id="SolicitarPIN" name="SolicitarPIN" class="form-control">
									<option value="">Seleccionar</option>
									@if ($evento->SolicitarPIN ==0)
										<option value="0" selected>No</option>
										<option value="1">SI</option>
									@else
										<option value="0">No</option>
										<option value="1" selected>SI</option>
									@endif
								</select>
							</div>
						</div>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-4">
								Departamento del Evento
								<select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
									<option value="">Seleccionar</option>
									@foreach($formulario["departamentos"] as $Departamento)
										@if ($Departamento->id == $evento->ciudad->Departamento_id)
											<option value="{{ $Departamento->id }}" selected>{{ $Departamento->Nombre_Departamento }}</option>
										@else
											<option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								Ciudad del Evento
								<select id="Ciudad_id" name="Ciudad_id" class="form-control">
									<option value="">Seleccionar</option>
									@foreach($ciudades as $ciudad)
										@if ($ciudad->id == $evento->ciudad->id)
											<option value="{{ $ciudad->id }}" selected>{{ $ciudad->Nombre_Ciudad }}</option>
										@else
											<option value="{{ $ciudad->id }}">{{ $ciudad->Nombre_Ciudad }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								Lugar del Evento
								<input id="Lugar_Evento" name="Lugar_Evento" type="text" class="form-control" value="{{$evento->Lugar_Evento}}"/>
							</div>
						</div>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-2">
								Fecha del Evento
								<input id="Fecha_Evento" name="Fecha_Evento" type="date" class="form-control" value="{{$evento->fechaEventoSinHora}}"/>
							</div>
							<div class="col-md-2">
								Hora del Evento
								<input type="time" name="Hora_Evento" class="form-control" value="{{$evento->horaEvento}}">
							</div>
							<div class="col-md-2">
								Fecha inicial de registro
								<input id="Fecha_Inicial_Registro" name="Fecha_Inicial_Registro" type="date" class="form-control" value="{{$evento->fechaIniRegistroSinHora}}"/>
							</div>
							<div class="col-md-2">
								Hora inicial de registro
								<input type="time" name="Hora_Inicial_Registro" class="form-control" value="{{$evento->horaIniRegistro}}">
							</div>
							<div class="col-md-2">
								Fecha final de registro
								<input id="Fecha_Final_Registro" name="Fecha_Final_Registro" type="date" class="form-control" value="{{$evento->fechaFinRegistroSinHora}}"/>
							</div>
							<div class="col-md-2">
								Hora final de registro
								<input type="time" name="Hora_Final_Registro" class="form-control" value="{{$evento->horaFinRegistro}}">
							</div>
						</div>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-3">
								Número máximo de Asistentes
								<input id="numeroAsistentes" name="numeroAsistentes" type="text" class="form-control" value="{{$evento->numeroAsistentes}}"/>
							</div>
							<div class="col-md-3">
								Evento Publico
								<select id="EsPublico" name="EsPublico" class="form-control">
									<option value="">Seleccionar</option>
									@if ($evento->EsPublico ==1)
										<option value="1" selected>SI</option>
										<option value="0">No</option>
									@else
										<option value="1" >SI</option>
										<option value="0" selected>No</option>
									@endif
								</select>
							</div>
							<div class="col-md-6">
								Correo para enviar invitación
								<input id="CorreoEnviarInvitacion" name="CorreoEnviarInvitacion" type="text" class="form-control" value="{{$evento->CorreoEnviarInvitacion}}"/>
							</div>
						</div>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-6">
								Codigo PULEP
								<input id="CodigoPulep" name="CodigoPulep" type="text" class="form-control" value="{{$evento->CodigoPulep}}"/>
							</div>
							<div class="col-md-3">
								Evento Pago
								<select id="esPago" name="esPago" class="form-control" onchange="MostrarDivBoletas()">
									<option value="">Seleccionar</option>
									@if ($evento->esPago ==1)
										<option value="0">No</option>
										<option value="1" selected>SI</option>
									@else
										<option value="0" selected>No</option>
										<option value="1">SI</option>
									@endif
								</select>
							</div>
							<div class="col-md-3">
								Activar Evento
								<select id="esActivo" name="esActivo" class="form-control"
									<option value="">Seleccionar</option>
									@if ($evento->esActivo ==1)
										<option value="0">No</option>
										<option value="1" selected>SI</option>
									@else
										<option value="0" selected>No</option>
										<option value="1">SI</option>
									@endif
								</select>
							</div>
						</div>
						@if ($evento->esPago ==1)
							<div id="divBoletas" name="divBoletas">
								<hr/>
								<div class="panel-heading text-center"><h4>Lista de Precios</h4></div>
								@foreach($evento->preciosBoletas as $precioBoleta)
									<div class="row" id="PreciosBoletas" name="PreciosBoletas">
                                        <input id="idPrecioBoleta" name="idPrecioBoleta" type="hidden"  value="{{$precioBoleta->id}}"/>
                                        <input id="PrecioBoletaPadre_Id" name="PrecioBoletaPadre_Id" type="hidden"  value="{{$precioBoleta->idHijo}}"/>
										<div class="col-md-12">
											<div class="form-group" id="rowPrecio" name="rowPrecio">
												<div class="input-group-addon" >
													Localidad
													<input id="localidad" name="localidad" type="text" class="form-control" value="{{$precioBoleta->localidad}}"/>
												</div>
												<div class="input-group-addon" >
													Precio Boleta
													<input id="precio" name="precio" type="number" class="form-control" value="{{$precioBoleta->precio}}"/>
												</div>
                                                <div class="input-group-addon" >
                                                    Cantidad
                                                    <input id="cantidad" name="cantidad" type="number" value="{{$precioBoleta->cantidad}}" class="form-control" />
                                                </div>
                                                <div class="input-group-addon" >
                                                    Activar
                                                    <input type="hidden" id="Activa" name="Activa" class="form-control" />
                                                    @if($precioBoleta->esActiva ==1)
                                                        <input type="checkbox" id="esActiva" name="esActiva"  class="form-control"  checked/>
                                                    @else
                                                        <input type="checkbox" id="esActiva" name="esActiva" class="form-control"  />
                                                    @endif
                                                </div>
                                                @if($precioBoleta->esCodigoPromo ==1)
                                                    <div class="input-group-addon" >
                                                        <input type="hidden" id="esPromo" name="esPromo" class="form-control" />
                                                        Activar Cod-Promo
                                                        <input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)" checked/>
                                                    </div>
                                                    <div class="input-group-addon" id="divCodigo" name="divCodigo" >
                                                        Código
                                                        <input id="Codigo" name="Codigo" type="text" class="form-control" value="{{$precioBoleta->Codigo}}"/>
                                                    </div>
                                                    <div class="input-group-addon"  id="divPorcentaje" name="divPorcentaje" >
                                                        Porcentaje
                                                        <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" value="{{$precioBoleta->Porcentaje}}"/>
                                                    </div>
                                                @else
                                                    <div class="input-group-addon" >
                                                        <input type="hidden" id="esPromo" name="esPromo" class="form-control" />
                                                        Activar Cod-Promo
                                                        <input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)"/>
                                                    </div>
                                                    <div  id="divCodigo" name="divCodigo" hidden="hidden">
                                                        Código
                                                        <input id="Codigo" name="Codigo" type="text" class="form-control" />
                                                    </div>
                                                    <div   id="divPorcentaje" name="divPorcentaje" hidden="hidden" >
                                                        Porcentaje
                                                        <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" />
                                                    </div>
                                                @endif
												@if($loop->index ==0)
												<div class="input-group-addon">
													<a id="agregarRespuesta" name="agregarRespuesta" title="Agregar nueva localidad" onclick="AgregarNuevaLocalidad()"><span class="glyphicon glyphicon-plus"  ></span></a>
												</div>
												@else
													<div class="input-group-addon">
														<a id="elimminarLocalidad" name="elimminarLocalidad"  title="No se puede eliminar localidad" ><span class="glyphicon glyphicon-ban-circle"  ></span></a>
													</div>
												@endif
											</div>
										</div>
									</div>
								@endforeach
							</div>
						@else
                            @if(count($evento->preciosBoletas)>0)
                                <div id="divBoletas" name="divBoletas" hidden>
                                    <hr/>
                                    <div class="panel-heading text-center"><h4>Lista de Precios</h4></div>
                                    @foreach($evento->preciosBoletas as $precioBoleta)
                                        <div class="row" id="PreciosBoletas" name="PreciosBoletas">
                                            <input id="idPrecioBoleta" name="idPrecioBoleta" type="hidden"  value="{{$precioBoleta->id}}"/>
                                            <div class="col-md-12">
                                                <div class="form-group" id="rowPrecio" name="rowPrecio">
                                                    <div class="input-group-addon" >
                                                        Localidad
                                                        <input id="localidad" name="localidad" type="text" class="form-control" value="{{$precioBoleta->localidad}}"/>
                                                    </div>
                                                    <div class="input-group-addon" >
                                                        Precio Boleta
                                                        <input id="precio" name="precio" type="number" class="form-control" value="{{$precioBoleta->precio}}"/>
                                                    </div>
                                                    <div class="input-group-addon" >
                                                        Activar
                                                        <input type="hidden" id="Activa" name="Activa" class="form-control" />
                                                        @if($precioBoleta->esActiva ==1)
                                                            <input type="checkbox" id="esActiva" name="esActiva"  class="form-control"  checked/>
                                                        @else
                                                            <input type="checkbox" id="esActiva" name="esActiva" class="form-control"  />
                                                        @endif
                                                    </div>
                                                    @if($precioBoleta->esPromo ==1)
                                                        <div class="input-group-addon" >
                                                            <input type="hidden" id="esPromo" name="esPromo" class="form-control" />
                                                            Activar Cod-Promo
                                                            <input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)" checked/>
                                                        </div>
                                                        <div class="input-group-addon" id="divCodigo" name="divCodigo" >
                                                            Código
                                                            <input id="Codigo" name="Codigo" type="text" class="form-control" value="{{$precioBoleta->Codigo}}"/>
                                                        </div>
                                                        <div class="input-group-addon"  id="divPorcentaje" name="divPorcentaje" >
                                                            Porcentaje
                                                            <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" value="{{$precioBoleta->Porcentaje}}"/>
                                                        </div>
                                                    @else
                                                        <div class="input-group-addon" >
                                                            <input type="hidden" id="esPromo" name="esPromo" class="form-control" />
                                                            Activar Cod-Promo
                                                            <input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)"/>
                                                        </div>
                                                        <div  id="divCodigo" name="divCodigo" hidden="hidden">
                                                            Código
                                                            <input id="Codigo" name="Codigo" type="text" class="form-control" />
                                                        </div>
                                                        <div   id="divPorcentaje" name="divPorcentaje" hidden="hidden" >
                                                            Porcentaje
                                                            <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" />
                                                        </div>
                                                    @endif
                                                    @if($loop->index ==0)
                                                        <div class="input-group-addon">
                                                            <a id="agregarLocalidad" name="agregarLocalidad" title="Agregar nueva localidad" onclick="AgregarNuevaLocalidad()"><span class="glyphicon glyphicon-plus"  ></span></a>
                                                        </div>
                                                    @else
                                                        <div class="input-group-addon">
                                                            <a id="elimminarLocalidad" name="elimminarLocalidad"  title="No se puede eliminar localidad" ><span class="glyphicon glyphicon-ban-circle"  ></span></a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
							<div id="divBoletas" name="divBoletas" hidden>
								<hr/>
								<div class="panel-heading text-center"><h4>Lista de Precios</h4></div>
								<div class="row" id="PreciosBoletas" name="PreciosBoletas">
                                    <input id="idPrecioBoleta" name="idPrecioBoleta" type="hidden" class="form-control" value="0"/>
									<div class="col-md-12">
										<div class="form-group" id="rowPrecio" name="rowPrecio">
											<div class="input-group-addon" >
												Localidad
												<input id="localidad" name="localidad" type="text" class="form-control" />
											</div>
											<div class="input-group-addon" >
												Precio Boleta
												<input id="precio" name="precio" type="number" class="form-control" />
											</div>
                                            <div class="input-group-addon" >
                                                Activar
                                                <input type="hidden" id="Activa" name="Activa" class="form-control" />
                                                <input type="checkbox" id="esActiva" name="esActiva" class="form-control" />
                                            </div>
                                            <div class="input-group-addon" >
                                                <input type="hidden" id="esPromo" name="esPromo" class="form-control" />
                                                Activar Cod-Promo
                                                <input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)"/>
                                            </div>
                                            <div  id="divCodigo" name="divCodigo" hidden="hidden">
                                                Código
                                                <input id="Codigo" name="Codigo" type="text" class="form-control" />
                                            </div>
                                            <div   id="divPorcentaje" name="divPorcentaje" hidden="hidden" >
                                                Porcentaje
                                                <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" />
                                            </div>
											<div class="input-group-addon">
												<a id="agregarRespuesta" name="agregarRespuesta" title="Agregar nueva localidad" onclick="AgregarNuevaLocalidad()"><span class="glyphicon glyphicon-plus"  ></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
                            @endif
						@endif
						<hr/>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-12">
								Flyer del evento
								<input type="file" class="form-control" name="ImagenFlyerEvento" value="c:/passwords.txt" />

							</div>
						</div>
						<div style="margin:0px !important;" class="row">
							<div class="col-md-12">
								Información para envio del la invitación
								<textarea id="informacionEvento" name="informacionEvento">
                                    {{$evento->informacionEvento}}
                                </textarea>
							</div>
						</div>
						<br/>
						<div style="margin:0px !important;" class="row" hidden>
							<div class="col-md-12">
								<input type="button" class="btn btn-blue ripple trial-button" onclick="AgregarPregunta()" value="Agregar Pregunta"/>
							</div>
						</div>
						<div style="margin:0px !important;" class="row" hidden>
							<div class="col-md-12">
								<h3 class="col-md-12" >Preguntas</h3>
								<div id="ListaPreguntas">
									@if(count($evento->preguntas) >0)
										<input id="CantidadPreguntas" name="CantidadPreguntas" type="hidden"  value="{{count($evento->preguntas)}}"/>
										@foreach($evento->preguntas as $pregunta)
											<div class="panel-group" id="pregunta" name="pregunta">
												<hr style="border-top-color:lightslategray; width:100%" />
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<div class="input-group">
																<div class="input-group-addon alert-warning">
																	<span><strong>¿</strong></span>
																</div>
																<input class="form-control" type="text" id="TextoPregunta" name="TextoPregunta"   value="{{$pregunta->Enunciado}}"/>
																<input id="TextoTipoPregunta" name="TextoTipoPregunta" type="hidden"  value="1"/>
																<input id="PreguntaId" name="PreguntaId" type="hidden"  value="{{$pregunta->id}}"/>
																<div class="input-group-addon alert-warning">
																	<span><strong>?</strong> </span>
																</div>
																<div class="input-group-addon alert-warning">
																	<a id="eliminarPregunta" name="eliminarPregunta" title="Eliminar Pregunta" data-toggle="modal" data-target="#modalElimianarPregunta{{$loop->index}}"><span class="glyphicon glyphicon-minus"  ></span></a>
																</div>
																<div class="input-group-addon alert-warning">
																	<a id="agregarRespuesta" name="agregarRespuesta" title="Agregar Respuesta" onclick="AgregarRespuesta(this)"><span class="glyphicon glyphicon-plus"  ></span></a>
																</div>
																<!-- Modal confirmación elimminar pregunta-->
																<div id="modalElimianarPregunta{{$loop->index}}" name="modalElimianarPregunta{{$loop->index}}" class="modal fade" role="dialog">
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
																				<button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarPregunta(this)">Elimminar</button>
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
												@foreach($pregunta->respuestas as $respuesta)
													<div class="row" name="Respuesta">
														<div class="col-md-1"></div>
														<div class="col-md-10">
															<div class="form-group">
																<div class="input-group">
																	<div class="input-group-addon alert-warning">
																		<span><strong>*</strong></span>
																	</div>
																	<input class="form-control" type="text" id="TextoRespuesta" name="TextoRespuesta"  value="{{$respuesta->EnunciadoRespuesta}}" />
																	<input id="Respuesta_Id" name="Respuesta_Id" type="hidden"  value="{{$respuesta->id}}"/>
																	<div class="input-group-addon alert-warning">
																		<a id="eliminarRespuesta" name="eliminarRespuesta" title="Eliminar Respuesta" data-toggle="modal" data-target="#modalElimianarRespuesta{{$loop->index}}{{$loop->parent->index}}"><span class="glyphicon glyphicon-minus"  ></span></a>
																	</div>
																	<!-- Modal confirmación elimminar respuesta-->
																	<div id="modalElimianarRespuesta{{$loop->index}}{{$loop->parent->index}}" name="modalElimianarRespuesta{{$loop->index}}{{$loop->parent->index}}" class="modal fade" role="dialog">
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
												@endforeach
											</div>
										@endforeach
									@endif
								</div>

							</div>
						</div>
                        <hr style="border-top-color:lightslategray; width:100%" />
                        <div class="row">
                            <div style="margin-bottom:2%;" class="col-md-12">
                                <button type="button" class="btn btn-blue ripple trial-button" onclick="validarCamposCrearEvento()">
                                    Guardar Evento
                                </button>
                            </div>
                        </div>
					</form>
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
							<input id="TextoTipoPregunta" name="TextoTipoPregunta" type="hidden"  />
							<input id="PreguntaId" name="PreguntaId" type="hidden"  value="0"/>
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
											<button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="EliminarPregunta(this)">Elimminar</button>
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
							<input id="Respuesta_Id" name="Respuesta_Id" type="hidden"  value="0"/>
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
        <input id="idPrecioBoleta" name="idPrecioBoleta" type="hidden"  value="0"/>
		<div class="col-md-12">
			<div class="form-group" id="rowPrecio" name="rowPrecio">
				<div class="input-group-addon" >
					Localidad
					<input id="localidad" name="localidad" type="text" class="form-control" />
				</div>
				<div class="input-group-addon" >
					Precio Boleta
					<input id="precio" name="precio" type="number" class="form-control" />
				</div>
                <div class="input-group-addon" >
                    Cantidad
                    <input id="cantidad" name="cantidad" type="number" class="form-control" />
                </div>
                <div class="input-group-addon" >
                    <input type="hidden" id="Activa" name="Activa" class="form-control" />
                    Activar
                    <input type="checkbox" id="esActiva" name="esActiva" class="form-control" />
                </div>
				<div class="input-group-addon" >
					<input type="hidden" id="esPromo" name="esPromo" class="form-control" />
					Activar Cod-Promo
					<input type="checkbox" id="boletaPromo" name="boletaPromo" class="form-control" onchange="MostrarDivBoletaPromocional(this)"/>
				</div>
                <div  id="divCodigo" name="divCodigo" hidden="hidden">
                    Código
                    <input id="Codigo" name="Codigo" type="text" class="form-control" />
                </div>
                <div   id="divPorcentaje" name="divPorcentaje" hidden="hidden" >
                    Porcentaje
                    <input id="Porcentaje" name="Porcentaje" type="number" class="form-control" />
                </div>

				<div class="input-group-addon">
					<a id="elimminarLocalidad" name="elimminarLocalidad" title="Eliminar localidad" onclick="EliminarLocalidad(this)"><span class="glyphicon glyphicon-minus"  ></span></a>
				</div>
			</div>
		</div>
	</div>

	<div id="elmentosEliminados" hidden="hidden">

	</div>


	<script src="{{ asset('js/Evento/eventos.js') }}"></script>
	<script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	<script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>

	<script type="text/javascript">
        CKEDITOR.replace('informacionEvento');
	</script>

@endsection
