
	<div class="row">
		<div class="col-md-12">
			<div style="padding-top:1%;border: 8px solid #8abd51; font-family: sans-serif; width: 100%;height: 100%;" id="qrcode">
				<div style="text-align:center;">
					<img src="http://dpsoluciones.co/wp-content/uploads/2018/02/logo.png"></img>
					<h2 style="font-size: 20px; font-weight: 700; color:#8abd51;">HAS SIDO REGISTRADO COMO PROMOTOR OFICIAL DE  {{ $ElementosArray["sede"] ->Nombre }}</h2>
					<p><b style="font-size:16px;">Empresa: </b>{{ $ElementosArray["sede"]->Empresa->RazonSocial }}</p>
					</br></br>
					<p>De ahora en adelante, tus conocidos podran comprar por <b>ECOTICKETS</b> y podran seleccionarte a ti, como su promotor de confianza</br>
						de esta forma te daremos los beneficios que acordadamos previamente.</br></p>
					<p style="font-size:13px;">*Queremos seguir consintiendo a nuestros promotores </br>
						y de esta forma tambien cuidar el medio ambiente.</p></div>

				<div style="padding-left: 7%;">

					<p style="font-size: 13px; text-align:center;">Desarrollado por</br>
						<img style="width:32px;"src="http://dpsoluciones.co/wp-content/uploads/2016/06/Loader.png"></img></br>
						Visítanos <a href="http://www.dpsoluciones.co" target="blank">DPSoluciones.co</a></br></p>
				</div>

			</div>
		</div>
	</div>




<script src="{{asset('plugins/qrcode/qrcode.js')}}"></script>
<script src="{{asset('js/Evento/evento.js')}}"></script>



 