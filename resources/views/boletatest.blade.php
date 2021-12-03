<!DOCTYPE html>
<html>
<head>
    <title>Aquí está tu Ecoticket</title>
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css" media="all">
        sup {
            font-size: 100% !important;
        }
    </style>

    <style type="text/css" media="screen">
        body {
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            background: #ffffff;
            -webkit-text-size-adjust: none
        }
		
		@media print {
	body{
        width: 21cm;
        height: 29.7cm;
        margin: 30mm 45mm 30mm 45mm; 
        /* change the margins as you want them to be. */
				} 
		}

        a {
            color: #55311f;
            text-decoration: none
        }

        p {
            padding: 0 !important;
            margin: 0 !important
        }

        img {
            -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */
        }

        /* Mobile styles */
        @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
            .mobile-shell {
                width: 100% !important;
                min-width: 100% !important;
            }

            .text-header,
            .m-center {
                text-align: center !important;
            }

            .center {
                margin: 0 auto !important;
            }

            .td {
                width: 100% !important;
                min-width: 100% !important;
            }

            .p30-15 {
                padding: 30px 15px !important;
            }

            .p30-0 {
                padding: 30px 0px !important;
            }

            .fluid-img img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            .column,
            .column-top,
            .column-empty2,
            .column-empty3,
            .column-empty2 {
                padding-bottom: 25px !important;
            }

            .column-empty3 {
                padding-bottom: 45px !important;
            }

            .content-spacing {
                width: 15px !important;
            }
        }
    </style>
</head>
<body class="body"
      style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#ffffff; -webkit-text-size-adjust:none;">
<table width="100%" bgcolor="#fff">
    <tr>
        <td align="center" valign="top">
            <table width="100%" bgcolor="#1D2139">
                    <td align="center">
                        <table width="650" class="mobile-shell">
                            <tr>
                                <td class="td" style="width:650px; min-width:650px;  font-weight:normal;">
                                    <table width="100%">
                                        <tr>
                                            <td class="p30-15" style="padding: 10px;">
                                                <table width="100%">
                                                    <tr>

                                                        <th class="column" width="173" style=" font-weight:normal;">
                                                            <table width="100%" border="0">
                                                                <tr>
                                                                    <td class="img-center" style="text-align:center;">
                                                                        <img src="https://dpsoluciones.co/wp-content/uploads/2021/11/logo-correo.png"
                                                                             width="289" height="110" border="0"
                                                                             alt=""/></td>
                                                                </tr>
                                                            </table>
                                                        </th>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- END Header -->

                <!-- Section Social -->
                <table width="100%" bgcolor="#1D2139">
                    <tr>
                        <td align="center" width="650" class="mobile-shell">
                            <table width="650" class="mobile-shell">
                                <tr>
                                    <td class="td"
                                        style="border-bottom: 3px solid #1D2139; width:650px; min-width:650px; font-weight:normal;">
                                        <table width="100%">
                                            <tr>
                                                <td background="images/t1_bg2.jpg" bgcolor="#9fba31" valign="top"
                                                    height="378" class="bg"
                                                    style="background-repeat:no-repeat; -webkit-background-size:cover; background-size:cover;">

                                                    <div>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="content-spacing" width="40"></td>
                                                                <td>
                                                                    <table width="100%" border="0">
                                                                        <tr>
                                                                            <td style="padding: 30px 0px;"
                                                                                class="p30-0">
                                                                                <table width="100%" border="0"
                                                                                >
                                                                                    <tr>
                                                                                        <td class="h5 white pb40"
                                                                                            style="font-family:Arial,sans-serif; font-size:14px; line-height:24px; text-align:center; text-transform:uppercase; color:#1D2139; padding-bottom:5px;">
                                                                                            AQUÍ ESTÁ TU ECOTICKET PARA

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="h2 white pb15"
                                                                                            style="font-family:Arial,sans-serif; font-size:32px; line-height:40px; text-align:center; color:#1D2139; padding-bottom:10px;">
                                                                                            {{ $ElementosArray["evento"] ->Nombre_Evento }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="h5 white pb40"
                                                                                            style="font-family:Arial,sans-serif; font-size:14px; line-height:24px; text-align:center; text-transform:uppercase; color:#1D2139; padding-bottom:5px;">

                                                                                                <b>Localidad:</b> {{ $ElementosArray["localidad"] ->localidad }}

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="h5 white pb40"
                                                                                            style="font-family:Arial,sans-serif; font-size:14px; line-height:24px; text-align:center; text-transform:uppercase; color:#1D2139; padding-bottom:25px;">

                                                                                                <b>Precio:</b> {{ $ElementosArray["localidad"] ->precio }}

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center"
                                                                                            style="padding-bottom:30px;">
                                                                                            <table border="0" >
                                                                                                <tr>
                                                                                                    <th class="column-top"
                                                                                                        style=" font-weight:normal; vertical-align:top;">
                                                                                                        <table width="100%" border="0"

                                                                                                        >
                                                                                                            <tr>
                                                                                                                <td class="img-center pb30"
                                                                                                                    style="text-align:center; padding-bottom:30px;">
                                                                                                                    <img src="https://dpsoluciones.co/wp-content/uploads/2021/11/ubi.png"
                                                                                                                         width="28"
                                                                                                                         height="28"
                                                                                                                         border="0"
                                                                                                                         alt=""/>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-center"
                                                                                                                    style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:30px; text-align:center;">

                                                                                                                        Lugar del evento
                                                                                                                        <br/>{{ $ElementosArray["evento"] ->Lugar_Evento }}

                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </th>
                                                                                                    <th class="column-empty3"
                                                                                                        width="40"
                                                                                                        style=" font-weight:normal;"></th>
                                                                                                    <th class="column-top"
                                                                                                        style=" font-weight:normal; vertical-align:top;">
                                                                                                        <table width="100%"
                                                                                                               border="0">
                                                                                                            <tr>
                                                                                                                <td class="img-center pb30"
                                                                                                                    style="text-align:center; padding-bottom:30px;">
                                                                                                                    <img src="https://dpsoluciones.co/wp-content/uploads/2021/11/fecha.png"
                                                                                                                         width="28"
                                                                                                                         height="28"
                                                                                                                         border="0"
                                                                                                                         alt=""/>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-center"
                                                                                                                    style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:30px; text-align:center;">

                                                                                                                        <span class="link-white"
                                                                                                                              style="color:#ffffff; text-decoration:none;">Fecha del evento: <br/>{{ $ElementosArray["evento"] ->Fecha_Evento }}</span>

                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </th>
                                                                                                    <th class="column-empty3"
                                                                                                        width="40"
                                                                                                        style=" font-weight:normal;"></th>
                                                                                                    <th class="column-top"
                                                                                                        style="  font-weight:normal; vertical-align:top;">
                                                                                                        <table width="100%"
                                                                                                               border="0">
                                                                                                            <tr>
                                                                                                                <td class="img-center pb30"
                                                                                                                    style="text-align:center; padding-bottom:30px;">
                                                                                                                    <img src="https://dpsoluciones.co/wp-content/uploads/2021/11/ubi.png"
                                                                                                                         width="28"
                                                                                                                         height="28"
                                                                                                                         border="0"
                                                                                                                         alt=""/>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td class="text-center"
                                                                                                                    style="color:#ffffff; font-family:Arial,sans-serif; font-size:14px; line-height:30px; text-align:center;">

                                                                                                                        <span class="link-white"
                                                                                                                              style="color:#ffffff; text-decoration:none;">Ciudad del evento: <br/>{{ $ElementosArray["evento"]->ciudad->Nombre_Ciudad }}</span>

                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="center">
                                                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                                                <tr>
                                                                                                    <td><img src="data:image/png;base64,{!! $ElementosArray["qr"]!!}" width="300" height="300" border="0"  /></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td class="content-spacing" width="40"></td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%"
                                                               bgcolor="#ffffff">
                                                            <tr>
                                                                <td class="p30-15" style="padding: 20px 20px;">
                                                                    <table width="100%" border="0">
                                                                        <tr>
                                                                            <td class="text center pb30"
                                                                                style="color:#1D2139; font-family:Arial,sans-serif; font-size:16px; line-height:28px; text-align:center; padding-bottom:30px;">
                                                                                    Presenta tu SmartPhone con el
                                                                                    CÓDIGO QR adjunto en la entrada del
                                                                                    evento para habilitar tu acceso.

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text center pb30"
                                                                                style="color:#1D2139; font-family:Arial,sans-serif; font-size:14px; line-height:28px; text-align:center; padding-bottom:30px;">
                                                                                    *No es necesario imprimirlo
                                                                                    presenta tu SmartPhone cuídemos el
                                                                                    medio ambiente.

                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- END Section Social -->
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

<script src={{asset("js/Evento/eventoPago.js")}}></script>
<script src={{asset("js/Plugins/Qrcode/qrcode.js")}}></script>
<script src={{asset("js/Plugins/Jquery/jquery-3.1.1.js")}}></script>
</body>
</html>