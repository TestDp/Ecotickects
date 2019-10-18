@if($ElementosArray["evento"] ->Tipo_Evento =='Cupón')
	<div class="row">
		<div class="col-md-12">
			<div style="padding-top:1%; border: 8px solid #ffffff; font-family: sans-serif;width: 100%; height: 100%;"id="qrcode">
				<div style="padding:5%; text-align:center;">
					<h2 style="font-size: 30px; font-weight: 700; color:#184c8b;">Prepárate para una tarde llena de risas</h2>
					<p style="color:#86c440; text-align: center; font-family: sans-serif; font-size:20px;"><b>Lugar del evento:</b>{{ $ElementosArray["evento"] ->Lugar_Evento }}</br>
						<b>Fecha:</b> {{ $ElementosArray["evento"] ->Fecha_Evento }}</br>
						<b style="font-size:16px;">Ciudad: </b>{{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}</br>
					<p style="color:#000000;">DEBES PRESENTAR EL CÓDIGO QR EN LA ENTRADA DEL EVENTO </b></p>
					</p>
					<img style="width:100%;" src="http://colasistencia.net/wp-content/uploads/2018/01/correo-1.png"></img>
				</div>
			</div>
		</div>
	</div>
@else
	<div class="row">
		<div class="col-md-12">
			<div style="padding-top:1%;border: 8px solid #8abd51; font-family: sans-serif; width: 100%;height: 100%;" id="qrcode">
				<div style="text-align:center;">
					<img src="http://dpsoluciones.co/wp-content/uploads/2018/02/logo.png"></img>
					<h2 style="font-size: 20px; font-weight: 700; color:#8abd51;">BIENVENIDO A {{ $ElementosArray["evento"] ->Nombre_Evento }}</h2>
					<p><b style="font-size:16px;">Lugar: </b>{{ $ElementosArray["evento"] ->Lugar_Evento }}</p> </br></br>
					<p><b style="font-size:16px;">Fecha: </b>{{ $ElementosArray["evento"] ->Fecha_Evento }}</p></br></br>
					<p><b style="font-size:16px;">Ciudad: </b>{{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}</p>
					</br></br>
					<p>Presenta tu SmartPhone con el <b>CÓDIGO QR</b> adjunto</br>
						en la entrada del evento para habilitar tu acceso.</br></p>
					<p style="font-size:13px;">*No es necesario imprimirlo presenta tu SmartPhone</br>
						cuidemos el medio ambiente.</p></div>

				<div style="padding-left: 7%;">
					<h2 style="font-size: 15px; font-weight: 700; color:000000;">PARA TENER EN CUENTA</h2>
					{!!$ElementosArray["evento"] ->informacionEvento!!}
					</br></br>
					<p style="font-size: 13px; text-align:center;">Desarrollado por</br>
						<img style="width:32px;"src="http://dpsoluciones.co/wp-content/uploads/2016/06/Loader.png"></img></br>
						Visítanos <a href="http://www.dpsoluciones.co" target="blank">DPSoluciones.co</a></br></p>
				</div>

			</div>
		</div>
	</div>
@endif




<script src="{{asset('plugins/qrcode/qrcode.js')}}"></script>
<script src="{{asset('js/Evento/evento.js')}}"></script>



 