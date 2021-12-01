@extends('layouts.profile')

@section('content')
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                    @if(isset($listaTickets[0]))
                        <h4 class="card-title">{{$listaTickets[0]->Nombres .' '. $listaTickets[0]->Apellidos }} </h4>
                    @endif
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping">
                      <thead>
                        <tr>
                          <th class="th-description">Id</th>
                          <th class="th-description">Localidad</th>
                          <th class="th-description">Valor</th>
                           <th class="th-description">Vendedor</th>
                           <th class="th-description">Activado</th>
                            <th class="th-description">Hora de Creación</th>
                           <th class="th-description">Hora de Activación</th>
                           <th class="th-description">Anulado</th>
                            <th class="th-description">Hora de Anulación</th>
                            <th class="th-description">Usuario que Anula</th>
                          <th class="th-description">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($listaTickets as $ticket)
                        <tr>
                          <td class="td-name">{{$ticket->idAsistenteEvento}}</td>
						  <td class="td-name">
                            <a > {{$ticket->Localidad}}</a>
                          </td>
                          <td class="td-name">
                            <a>{{$ticket->precio}}</a>
                          </td>
						  <td class="td-name">
                            <a>{{$ticket->UsuarioVendedor}}</a>
                          </td>
                            <td class="td-name">
                                <a>
                                    @if($ticket->esActivo == 0 )
                                        No
                                    @else
                                        SI
                                    @endif
                                </a>
                            </td>
                            <td class="td-name">
                                <a>
                                        {{$ticket->created_at}}
                                </a>
                            </td>
                            <td class="td-name">
                                <a>
                                    @if( $ticket->created_at != $ticket->updated_at && $ticket->esActivo == 1 )
                                        {{$ticket->updated_at}}
                                    @endif
                                </a>
                            </td>
                            <td class="td-name">
                                <a>
                                    @if($ticket->esAnulado == 0 )
                                        No
                                    @else
                                        SI
                                    @endif
                                </a>
                            </td>
                            <td class="td-name">
                                <a>
                                    @if($ticket->created_at != $ticket->updated_at && $ticket->esAnulado == 1)
                                        {{$ticket->updated_at}}
                                    @endif
                                </a>
                            </td>
                            <td class="td-name">
                                <a>{{$ticket->UsuarioAnulaName}}</a>
                            </td>
                            <td class="td-name">
                                @if(Auth::user()->buscarRecurso('DescargarTicket'))
                                    @if($ticket->esActivo == 0 && $ticket->esAnulado == 0 )
                                        <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Descargar tickect">
                                            <a href="{{ url('descargarTicket/'.$idEvento.'/'.$ticket->idAsistenteEvento) }}"><i class="material-icons">group</i></a>
                                        </button>
                                    @endif
                                @endif
                                @if(Auth::user()->buscarRecurso('AnularTicket'))
                                    @if($ticket->esActivo == 0 && $ticket->esAnulado == 0 )
                                        <button type="button" rel="tooltip" class="btn btn-rose" data-toggle="tooltip" data-placement="top" title="Anular">
                                            <a onclick="ValidarAnulacion({{$ticket->idAsistenteEvento}})"><i class="material-icons">group</i></a>
                                        </button>
                                    @endif
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
<script src="{{ asset('js/Transversal/generales.js') }}"></script>
<script src="{{ asset('js/Evento/asistentes.js') }}"></script>
@endsection