@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Bievenido a Ecotickets</h3></div>

                    <form action="crearEvento" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-6">
                                Nombre del Evento
                                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                Tipo de Evento
                                <select id="Tipo_Evento" name="Tipo_Evento" class="form-control">
                                    <option value="Evento">Evento</option>
                                    <option value="Cupon">Cupón</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                Solicitar PIN
                                <select id="SolicitarPIN" name="SolicitarPIN" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">SI</option>
                                </select>
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">

                            <div class="col-md-4">
                                Departamento del Evento
                                <select id="Departamento_id" name="Departamento_id" onchange="CargarMunicipiosDepartamento()" class="form-control">
                                    <option value="">Seleccionar</option>
                                    @foreach($formulario["departamentos"] as $Departamento)
                                        <option value="{{ $Departamento->id }}">{{ $Departamento->Nombre_Departamento }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                Ciudad del Evento
                                <select id="Ciudad_id" name="Ciudad_id" class="form-control">

                                </select>
                            </div>
                            <div class="col-md-4">
                                Lugar del Evento
                                <input id="Lugar_Evento" name="Lugar_Evento" type="text" class="form-control" />
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-4">
                                Fecha del Evento
                                <input id="Fecha_Evento" name="Fecha_Evento" type="date" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                Fecha inicial de registro del Evento
                                <input id="Fecha_Inicial_Registro" name="Fecha_Inicial_Registro" type="date" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                Fecha final de registro del Evento
                                <input id="Fecha_Final_Registro" name="Fecha_Final_Registro" type="date" class="form-control" />
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-3">
                                Número máximo de Asistentes
                                <input id="numeroAsistentes" name="numeroAsistentes" type="text" class="form-control" />
                            </div>
                            <div class="col-md-3">
                                Evento Publico
                                <select id="EsPublico" name="EsPublico" class="form-control">
                                    <option value="1">SI</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                Correo para enviar invitación
                                <input id="CorreoEnviarInvitacion" name="CorreoEnviarInvitacion" type="text" class="form-control" />
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                Flyer del evento
                                <input type="file" class="form-control" name="ImagenFlyerEvento" >
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                Informacion para envio del la invitación
                                <textarea id="informacionEvento" name="informacionEvento"></textarea>
                            </div>
                        </div>
                        <br/>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                <input type="button" class="btn btn-blue ripple trial-button" data-toggle="modal" data-target="#EnunciadoPregunta" value="Agregar Pregunta"/>
                            </div>
                            <div id="EnunciadoPregunta" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Enunciado de la pregunta</h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center; color:black">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon alert-warning">
                                                            <span><strong>¿</strong></span>
                                                        </div>
                                                        <input class="form-control" type="text" id="enunciadoPregunta" name="enunciadoPregunta"   />
                                                        <div class="input-group-addon alert-warning">
                                                            <span><strong>?</strong> </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="AgregarPregunta()">Agregar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                <h3 class="col-md-12" >Preguntas</h3>
                                <hr style="border-top-color:lightslategray; width:100%" />
                                <div id="ListaPreguntas"></div>



                                <hr style="border-top-color:lightslategray; width:100%" />
                                <div class="row">
                                    <div style="margin-bottom:2%;" class="col-md-12">
                                        <button type="submit" class="btn btn-blue ripple trial-button" onclick="EditarNombrePreguntasYRespuetas()">
                                            Crear Evento
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div hidden="hidden">

        <div class="panel-group" id="divPregunta" name="divPregunta">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="form-group">
                        <div class="input-group">
                            <a id="tituloPregunta" name="tituloPregunta" data-toggle="collapse" href="#collapse"></a>
                            <input id="TextoPregunta" name="TextoPregunta" type="hidden" />
                            <input id="TextoTipoPregunta" name="TextoTipoPregunta" type="hidden"  value="1"/>
                            <div class="input-group-addon alert-warning">
                                <a id="agregarRespuesta" name="agregarRespuesta" title="Agregar Respuesta" data-toggle="modal" data-target="#EnunciadoRespuesta"><span class="glyphicon glyphicon-plus"  ></span></a>
                                <a  title="Eliminar Pregunta"><span class="glyphicon glyphicon-erase"></span></a>

                                <div id="EnunciadoRespuesta" name="EnunciadoRespuesta" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enunciado de la respuesta</h4>
                                            </div>
                                            <div class="modal-body" style="text-align:center; color:black">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input id="Respuesta" name="Respuesta" class="form-control" type="text" id="enunciadoPregunta" name="enunciadoPregunta"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-blue ripple trial-button" data-dismiss="modal" onclick="AgregarRespuesta(this)">Agregar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="collapse" name="collapse" class="panel-collapse collapse">
                    <ul class="list-group" id="ListaRespuestas" name="ListaRespuestas">
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>

    <script type="text/javascript">
            CKEDITOR.replace('informacionEvento');
    </script>

@endsection