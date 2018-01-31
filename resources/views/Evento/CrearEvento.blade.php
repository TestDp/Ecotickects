@extends('layouts.app')

@section('content')
<header id="intro">
		<div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Bievenido a Ecotickets</div>
					
    <form action="crearEvento" method="POST">
        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6">
                Nombre del Evento
                <input id="Nombre_Evento" name="Nombre_Evento" type="text" class="form-control" />
            </div>
            <div class="col-md-6">
                Tipo de Evento
                <select id="Tipo_Evento" name="Tipo_Evento" class="form-control">
                    <option value="Evento">Evento</option>
                    <option value="Cupon">Cupón</option>
                </select>
            </div>
        </div>
        <div class="row">

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
        <div class="row">
            <div class="col-md-4">
                Fecha del Evento
                <input id="Fecha_Evento" name="Fecha_Evento" type="date" class="form-control" />
            </div>
            <div class="col-md-4">
                Fecha incial de registro del Evento
                <input id="Fecha_Inicial_Registro" name="Fecha_Inicial_Registro" type="date" class="form-control" />
            </div>
            <div class="col-md-4">
                Fecha final de registro del Evento
                <input id="Fecha_Final_Registro" name="Fecha_Final_Registro" type="date" class="form-control" />
            </div>
        </div>
        <br/>
         <div class="row">
            <div class="col-md-8 col-md-offset-4">
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
                         <button type="button" class="btn btn-success" data-dismiss="modal" onclick="AgregarPregunta()">Agregar</button>
                         <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                     </div>
                 </div>
             </div>
         </div>

        </div>

        <h3 class="col-md-8 col-md-offset-4" >Preguntas</h3>
        <hr style="border-top-color:lightslategray; width:100%" />
        <div id="ListaPreguntas"></div>



        <hr style="border-top-color:lightslategray; width:100%" />
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary" onclick="EditarNombrePreguntasYRespuetas()">
                    Crear Evento
                </button>
            </div>
        </div>
    </form>
	</div>
        </div>
    </div>
</header>

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
                                            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="AgregarRespuesta(this)">Agregar</button>
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



@endsection