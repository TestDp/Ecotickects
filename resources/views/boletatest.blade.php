<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<STYLE TYPE="text/css">
.buy {
               display: block;
               font-size: 12px;
               font-weight: bold;
               background: #8abd51;
               padding: 0 18px;
               line-height: 30px;
               border-radius: 0px;
               color: #fff;
               text-decoration: none;
            }

body {
   background: #1D2139;
   min-height: calc(100vh - 40px);
   margin: 20px;
   font-family: Arial,sans-serif;
   widget {
      filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
      &[type="ticket"] {
         width: 320px;
         height: 100%;
         .top,
         .bottom {
            >div {
               padding: 0 18px;
               &:first-child {
                  padding-top: 18px;
               }
               &:last-child {
                  padding-bottom: 18px;
               }
            }
            img {
               padding: 18px 0;
            }
         }
         .top,
         .bottom,
         .rip {
            background-color: #1D2139;
         }
         .top {
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
            .deetz {
               padding-bottom: 10px !important;
            }
         }
         .bottom {
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            padding: 18px;
            height: 30px;
            padding-top: 10px;
            .barcode {
               background-repeat: repeat-y;
               min-width: 58px;
            }
            .buy {
               display: block;
               font-size: 12px;
			   text-align: center;
			   font-family: Arial,sans-serif;
               font-weight: bold;
               background-color: #B0D416;
               padding: 0 18px;
               line-height: 30px;
               border-radius: 15px;
               color: #fff;
               text-decoration: none;
            }
         }
		 .date{color: #fff !important;}
         .rip {
            height: 20px;
            margin: 0 10px;
            background-size: 4px 2px;
            background-repeat: repeat-x;
            background-position: center;
            position: relative;
            box-shadow: 0 1px 0 0 #fff, 0 -1px 0 0 #fff;
            &:before,
            &:after {
               content: '';
               position: absolute;
               width: 20px;
               height: 20px;
               top: 50%;
               transform: translate(-50%, -50%) rotate(45deg);
               border: 5px solid transparent;
               border-top-color: #fff;
               border-right-color: #fff;
               border-radius: 100%;
               pointer-events:none;
            }
            &:before {
               left: -10px;
            }
            &:after {
               transform: translate(-50%, -50%) rotate(225deg);
               right: -40px;
            }
         }
      }
      .-bold {
         font-weight: bold;
		 font-family: Arial,sans-serif;
      }
   }
}
	</style>

	<title>Ecoticket</title>
</head>
<body style="background: #1D2139;">

<div type="ticket" class="--flex-column">
  <div class="top --flex-column">

    <center><img src="https://dpsoluciones.co/wp-content/uploads/2021/11/logo-correo.png" width="289" height="110" border="0"/></center>
    <br>
	<div style="font-family: Arial,sans-serif; padding-top:5%; padding-bottom: 5%; background:#B0D416; color: #1D2139 !important; float: left; width: 100%; text-align: center;">
			<div class="bandname -bold">{{ $ElementosArray["evento"] ->Nombre_Evento }}</div>
			<div class="tourname">LUGAR: {{ $ElementosArray["evento"] ->Lugar_Evento }}</div>
			<div class="tourname">FECHA: {{ $ElementosArray["evento"] ->Fecha_Evento }}</div>
			<div class="tourname">LOCALIDAD: {{ $ElementosArray["localidad"] ->localidad }}</div>
			<div class="tourname">PRECIO: {{ $ElementosArray["localidad"] ->precio }}</div>
			<div class="tourname">
			  <small>Presenta este código <b>en tu SMARTPHONE</b>.</small>
			  <div>	
			  <input type="hidden" id="nombreEvento" value="{{$ElementosArray['evento'] ->Nombre_Evento}}">
				<img src="data:image/png;base64,{!! $ElementosArray['qr']!!}">
			</div>
			 </div>
	</div>							
    <div class="deetz --flex-row-j!sb">
      <div class="event --flex-column">
	     <div class="location -bold">Para tener en cuenta:</div>
        <div class="date">El código QR es único, la primera persona que presente el Ecoticket podrá ingresar, los demás no podrán hacerlo.</div>
		<div class="date">El Ecoticket debe estar completo y legible.</div>
		<div class="date">Al ingresar al evento debe presentar: Su Ecoticket y cédula original.</div>
		<div class="date">Cualquier intento de fraude podrá ser reportado con las autoridades competentes y prohibirse su ingreso al evento.</div>
		<div class="date">No publique su Ecoticket, ni le tome fotos, puede ser víctima de falsificaciones.</div>
      </div>
    </div>
    <center><small>Términos y condiciones</small></center>
    <center><small>www.ecotickets.co</small></center>
  </div>
  <div class="rip"></div>
  <div class="bottom --flex-row-j!sb">
    <div class="barcode"></div>
    <a class="buy" href="#">NO LO IMPRIMAS | CUIDA EL MEDIO AMBIENTE</a>
    <br>

  </div>
  <br>
  </center>
</div>
<script src="js/Evento/eventoPago.js"></script>
<script src="js/Plugins/Qrcode/qrcode.js"></script>
<script src="js/Plugins/Jquery/jquery-3.1.1.js"></script>
</body>
</html>