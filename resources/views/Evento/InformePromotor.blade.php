@extends('layouts.internas')

@section('content')
    <div class="row">
	
			<div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Informe Promotor {{ $ListaPromotor["Promotor"]->evento ->Nombre_Evento }}</h4>
                  </div>
                </div>
                <div class="card-body ">
					              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Este es en informe del evento por promotor</h4>
                </div>
                <div class="card-body ">
				
				<div class="table-responsive">
                    <table class="table table-shopping">
                            <thead>
                            <tr >
                                <th>
                                    Precio Etapa
                                </th>
                                <th>
                                    Promotor
                                </th>
                                <th>
                                    Cantidad Boletas
                                </th>
                                <th>
                                    Total Etapa
                                </th>

                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaPromotor["Promotor"] as $promotor)
                            <tr >
                                <td>
                                  {{$promotor->PrecioEtapa}}
                                </td>
                                <td>
                                    {{$promotor->Promotor}}
                                </td>
                                <td>
                                    {{$promotor->CantidadBoletas}}
                                </td>
                                <td>
                                    {{$promotor->TotalEtapa}}
                                </td>

                            </tr>
                            @endforeach

                            </tbody>

                        </table>
						
					<div class="table-responsive">
                    <table class="table table-shopping">
                            <thead>
                            <tr >
                                <th>
                                    <b>Total Boletas</b>
                                </th>
                                <th>
                                    <h4>{{$ListaPromotor["Promotor"]->CantidadTotal}}</h4>
                                </th>
                                <th style="visibility: hidden">>
                                    Total Etapa
                                </th>
                                <th style="visibility: hidden">>
                                    Porcentaje
                                </th>
                                <th>
                                    <b>Total Liquidar</b>
                                </th>
                                <th>
                                    <h4>{{$ListaPromotor["Promotor"]->Total}}</h4>
                                </th>
                            </tr>
                            </thead>

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
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script src="{{ asset('js/Plugins/Gauge/gauge.js') }}"></script>
    <!--script src="{{ asset('http://bernii.github.com/gauge.js/dist/gauge.js') }}"></script-->


@endsection