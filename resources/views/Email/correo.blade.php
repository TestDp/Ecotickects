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
		en la entrada del evento y disfruta del mejor festival</br>
		de música electrónica del Oriente Antioqueño.</br></p>
		<p style="font-size:13px;">*No es necesario imprimirlo presenta tu SmartPhone</br>
		cuidemos el medio ambiente.</p></div>
		
		<div style="padding-left: 7%;">
		<h2 style="font-size: 15px; font-weight: 700; color:000000;">PARA TENER EN CUENTA</h2>
		<ul style="font-size: 13px;">
		<li>1. Presentar la cédula a la entrada del evento.</li>
		<li>2. Esta invitación es válida para ingresar al evento antes de las 3:00p.m del día 03/06/2018.</li>
		<li>3. Evento para mayores de edad.</li>
		<li>4. Se prohíbe la venta y/o reproducción de la presente invitación.</li>
		<li>5. Se prohíbe el ingreso de licor, alimentos y cualquier tipo de bebidas.</li>
		<li>4. Se prohíbe el ingreso con camisetas alusivas a equipos de fútbol.</li>
		<li>6. Se prohíbe el ingreso de mascotas.</li>
		</ul>
		</br></br>
		<p style="font-size: 13px; text-align:center;">Desarrollado por</br>
		<img style="width:32px;"src="http://dpsoluciones.co/wp-content/uploads/2016/06/Loader.png"></img></br>
		Síguenos en Facebook <a href="https://www.facebook.com/dpsolucionesrionegro/?fref=ts" target="blank">DPSoluciones</a></br></p>
		<p>CODIGO PULEP: DOZ319</p>
		</div>
		
</div>
</div>
</div>
    

<label> </label>


 <script src="{{asset('plugins/qrcode/qrcode.js')}}"></script>
 <script src="{{asset('js/Evento/evento.js')}}"></script>

 </body>
</html>

 