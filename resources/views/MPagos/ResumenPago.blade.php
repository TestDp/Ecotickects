
@section('ResumenPago')

      <section class="section section-lg bg-default" style="padding: 0px 0 !important;">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-md-10 col-lg-6">

		  		<form id="formPagPy" class="rd-form rd-mailform" >
				<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
				<input type="hidden" id="InfoPId" name="InfoPId" value="{{$InfoPago->InfoPId}}" />
				<input type="hidden" id="Email" name="Email" value="{{$InfoPago->Email}}" />
				<input type="hidden" id="Direccion" name="Direccion" value="{{$InfoPago->Direccion}}" />
                      <div class="container">
					  <h4>Información del comprador</h4>
						  <div class="table-custom-responsive">
							<table class="table-custom table-custom-secondary">
							<tbody id="TablasDetallePedido">
									<tr>
												<td>Nombre</td>
												<td>{{$InfoPago->NombreComprador}}</td>
									</tr>
									<tr>
												<td>Email</td>
												<td>{{$InfoPago->Email}} </td>
									</tr>
									<tr>
												<td>Dirección</td>
												<td>{{$InfoPago->Direccion}} </td>
									</tr>
									<tr>
												<td>Telefono</td>
												<td>{{$InfoPago->Telefono}} </td>
									</tr>
							</tbody>
							</table>
						  </div>
					</div>
      <div class="divider divider-gray-900 text-center"></div>		  
						<div class="panel panel-success">
									<div class="panel-heading">
										Selecciona el medio de pago
										<div class="btn-group pull-right">
												<span onclick="CargarFormularioMediosDePago()" style="cursor:pointer;" class="badge-promo-text">Cambiar Medio de Pago</span>
										</div>
									</div>
									<div class="panel-body" id="divMediosDePago">
										<div id="divTC">
											<h4>Tarjetas de credito</h4>									
											
											<div class="row">
												<div class="col-md-3">
													<a id="aVisa" name="aVisa" class="navbar-brand"  onclick="AgregarVlrPagoTC('VISA')" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_visa.png" data-active-url="../img/icono_visa.png" alt=""  width="100%" height="100%"/>
													</a>
												</div>
												<div class="col-md-3">
													<a id="aMasterCard" name="aMasterCard" class="navbar-brand" onclick="AgregarVlrPagoTC('MASTERCARD')" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_mastercard.png" data-active-url="../img/icono_visa.png" alt=""  width="100%" height="100%"/>
													</a>
												</div>
												<div class="col-md-3">
													<a id="aAmex" name="aAmex" class="navbar-brand" onclick="AgregarVlrPagoTC('AMEX')" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_amex.png" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
													</a>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<a id="aDiners" name="aDiners" class="navbar-brand" onclick="AgregarVlrPagoTC('DINERS')" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_diners.png" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
													</a>
												</div>
												<div class="col-md-3">
													<a id="aCodensa" name="aCodensa" class="navbar-brand" onclick="AgregarVlrPagoTC('CODENSA')" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_codensa.jpg" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
													</a>
												</div>
											</div>
											<hr>
										</div>
										<div id="divPSE">
											<h4>Débito bancario PSE</h4>
											<div class="row">
												<div class="col-md-4">
													<a id="aPSE" name="aPSE" class="navbar-brand" onclick="cargarFormularioPagoPSE()" style="cursor:pointer;">
														<img style="height: auto !important;" src="../img/icono_pse.jpg" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
													</a>
												</div>
												<div class="col-md-8">
													<div>
														<label>
															Recuerda verificar el monto máximo que tienes habilitado para pagos por internet.
														</label>
													</div>
												</div>
											</div>
											<hr>
										</div>
									</div>
								</div> 
            </div>
            <div class="col-md-10 col-lg-6">
			
					<div class="panel panel-success">
								<div class="panel-heading">Resumen de Compra</div>
								<div class="panel-body">
									<h4>Referencia pago :</h4>{{$InfoPago->Referencia}}
									<h4>Descripción :</h4>{{$InfoPago->Descripcion}}
									<hr>
									<table style="width:100%" class="table table-bordered">
										<thead>
										<tr >
											<th>Cantidad</th>
											<th>Producto</th>
											<th>Vlr Unitario</th>
											<th>Vlr total</th>
										</tr>
										</thead>
										<tbody id="TablasDetalleFactura">
										<tr>
											<td>{{$InfoPago->CantidadTickets}} </td>
											<td>{{$InfoPago->nombreBoleta}}</td>
											<td>{{$InfoPago->PrecioUnidad}}</td>
											<td>{{$InfoPago->PrecioSubTotal}}</td>
										</tr>
										</tbody>
										<tfoot>
										<tr>
											<th colspan="3">Total</th>
											<td id="tdTotalAPagar">{{$InfoPago->PrecioSubTotal}}</td>
											<input type="hidden" id="subTotal" name="subTotal" value="{{$InfoPago->PrecioSubTotal}}" />
										</tr>
										</tfoot>
									</table>
								</div>
							</div>
            </div>
          </div>
		  </form>
        </div>
      </section>
@endsection
