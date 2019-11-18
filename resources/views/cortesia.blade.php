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
               background-color: #4e558f;
               padding: 0 18px;
               line-height: 30px;
               border-radius: 0px;
               color: #fff;
               text-decoration: none;
            }

body {
   background-image: linear-gradient(-45deg, #8067B7, #EC87C0);
   min-height: calc(100vh - 40px);
   margin: 20px;
   font-family: 'Arial';
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
            background-color: #fff;
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
               background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF4AAAABCAYAAABXChlMAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAYdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuOWwzfk4AAACPSURBVChTXVAJDsMgDOsrVpELiqb+/4c0DgStQ7JMYogNh2gdvg5VfXFCRIZaC6BOtnoNFpvaumNmwb/71Frrm8XvgYkker1/g9WzMOsohaOGNziRs5inDsAn8yEPengTapJ5bmdZ2Yv7VvfPN6AH2NJx7nOWPTf1/78hoqgxhzw3ZqYG1Dr/9ur3y8vMxgNZhcAUnR4xKgAAAABJRU5ErkJggg==);
               background-repeat: repeat-y;
               min-width: 58px;
            }
            .buy {
               display: block;
               font-size: 12px;
               font-weight: bold;
               background-color: #5D9CEC;
               padding: 0 18px;
               line-height: 30px;
               border-radius: 15px;
               color: #fff;
               text-decoration: none;
            }
         }
         .rip {
            height: 20px;
            margin: 0 10px;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAACCAYAAAB7Xa1eAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAYdEVYdFNvZnR3YXJlAHBhaW50Lm5ldCA0LjAuOWwzfk4AAAAaSURBVBhXY5g7f97/2XPn/AcCBmSMQ+I/AwB2eyNBlrqzUQAAAABJRU5ErkJggg==);
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
      }
   }
}
	</style>

	<title>Cortesía</title>
</head>
<body style="background-image: linear-gradient(-45deg, #8067B7, #EC87C0);">

<div type="ticket" class="--flex-column">
  <div class="top --flex-column">

    <center><a class="buy" href="#">ECOTICKET CORTESÍA</a></center>
    <br>
	<div style="padding-top:5%; padding-bottom: 5%; background:#dddddd; float: left; width: 100%; text-align: center; border: dashed 2px blue;">
			<div class="bandname -bold">{{ $ElementosArray["evento"] ->Nombre_Evento }}</div>
			<div class="tourname">LUGAR: {{ $ElementosArray["evento"] ->Lugar_Evento }}</div>
			<div class="tourname">FECHA: {{ $ElementosArray["evento"] ->Fecha_Evento }}</div>
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