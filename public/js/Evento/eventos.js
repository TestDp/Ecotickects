var urlBase = "/Ecotickects/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP


//funcion que me retorna las ciudades dependiendo del departamento seleccionado
function CargarMunicipiosDepartamento(idCiudad)
{
    var idDepartamento =$("#Departamento_id").val();
    var $idCiudad =$("#Ciudad_id");
    $.ajax({
        url: urlBase+'Ciudades/'+idDepartamento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idDepartamento: idDepartamento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                $idCiudad.find("option").remove();//Removemos las opciónes anteriores
                $idCiudad.append(new Option("Seleccionar", ""));// agregamos la opción de seleccionar
                $.each(result, function (ind, element) {
                    $idCiudad.append(new Option(element.Nombre_Ciudad, element.id));//agregamos las opciónes consultadas
                })
                if(idCiudad)
                {
                    $("#Ciudad_id").val(idCiudad);
                }
            }
        }
    });

}

var numeroPregunta = 0;
function AgregarPregunta()
{
    //funcionalidad de agregar y mostrar pregunta
    var divPregunta = $("#divPregunta").clone();
    divPregunta.attr("id","pregunta");
    divPregunta.attr("name","pregunta");
    divPregunta.find("a[name=tituloPregunta]").text('¿'+$("#enunciadoPregunta").val()+'?');
    divPregunta.find("a[name=tituloPregunta]").attr("href","#pregunta"+numeroPregunta);
    divPregunta.find("div[name=collapse]").attr("id","pregunta"+numeroPregunta);
    divPregunta.find("a[name=agregarRespuesta]").attr("data-target","#EnunciadoRespuesta"+numeroPregunta);
    divPregunta.find("div[name=EnunciadoRespuesta]").attr("id","EnunciadoRespuesta"+numeroPregunta);
    //funcioalidad de agregar los valores para ser guardados
    divPregunta.find("input[name = TextoPregunta]").val($("#enunciadoPregunta").val());
    numeroPregunta++;
    $("#ListaPreguntas").append(divPregunta);
}


function  AgregarRespuesta(element)
{
  var divPregunta = $(element).closest("div[name=pregunta]");
  var enunciadoRepuesta = divPregunta.find("input[name=Respuesta]").val();
  var htmlRespuesta = '<li class="list-group-item">'+enunciadoRepuesta+'<input id="TextoRespuesta" name="TextoRespuesta" type="hidden" value="'+enunciadoRepuesta+'" /></li>';
  divPregunta.find("ul[name=ListaRespuestas]").append(htmlRespuesta);
}

function EditarNombrePreguntasYRespuetas()
{
    $("#ListaPreguntas").find("div[name=pregunta]").each(function (i,pregunta) {
        $(pregunta).find("input[name=TextoPregunta]").attr("name","Enunciado[" + i+ "]");
        $(pregunta).find("input[name=TextoTipoPregunta]").attr("name","TipoPregunta_id[" + i + "]");
        $(pregunta).find("input[name=TextoRespuesta]").each(function (j,respuesta) {
            $(respuesta).attr("name","TextoRespuesta[" + i + "][" + j +"]");
        })
   });

}

function ValidarPin () {
    var idPin = $("#pinIngresar").val();
    $.ajax({
        url: urlBase+'pin/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                    $('#formAsistente').removeAttr("hidden");
            }else{
                $('#formAsistente').attr("hidden","hidden");
            }
        }
    });
}

function generarQRCode()
{
    var qr = create_qrcode($("#nomEvenQR").val() +" - CC - " + $("#Identificacion").val() + "ECOTICKETS" );
    var src = $(qr).attr('src');
    $("#imagen").val(src);
    validarFormulario();
}

function validarFormulario(){
    $("#formularioEvento").validate({
        rules: {
            Nombres: {
                required: true
                // minlength: 2
            },
            Apellidos: {
                required: true
            },
            Identificacion: {
                required: true
            },
            telefono: {
                required: true
            },
            Email: {
                required: true
            },
            confEmail: {
                equalTo: "#Email"
            },
            Departamento_id: {
                required: true
            },
            Ciudad_id: {
                required: true
            },
            genero: {
                required: true
            },
            Edad: {
                required: true,
                //min: 18
            },
            terminos: {
                required: true
            },
            HabeasData: {
                required: true
            },
            'Respuesta_id[0]': {
                required: true
            },
            'Respuesta_id[1]': {
                required: true
            },
            'Respuesta_id[2]': {
                required: true
            },
            'Respuesta_id[3]': {
                required: true
            },
            'Respuesta_id[4]': {
                required: true
            },
            'Respuesta_id[5]': {
                required: true
            },
            'Respuesta_id[6]': {
                required: true
            },
            'Respuesta_id[7]': {
                required: true
            },
            'Respuesta_id[8]': {
                required: true
            },
            'Respuesta_id[9]': {
                required: true
            },
            'Respuesta_id[10]': {
                required: true
            },
            'Respuesta_id[11]': {
                required: true
            },
            'Respuesta_id[12]': {
                required: true
            },
            'Respuesta_id[13]': {
                required: true
            },
            'Respuesta_id[14]': {
                required: true
            },
            'Respuesta_id[15]': {
                required: true
            },
            'Respuesta_id[16]': {
                required: true
            },
            'Respuesta_id[17]': {
                required: true
            },
            'Respuesta_id[18]': {
                required: true
            },

        },
        messages: {
            Nombres: {
                required: "*El nombre es obligatorio"
            },
            Apellidos: {
                required: "*El apellido es obligatorio"
            },
            Identificacion: {
                required: "*La identificación es obligatorio"
            },
            telefono: {
                required: "*El telefono es obligatorio"
            },
            Email: {
                required: "*El email es obligatorio"
            },
            confEmail: {
                equalTo: "*Los correos debe ser iguales"
            },
            Departamento_id: {
                required: "*El departamento es obligatorio"
            },
            Ciudad_id: {
                required: "*La ciudad es obligatoria"
            },
            genero: {
                required: "*El rol es obligatorio"
            },
            Edad: {
                required: "*La edad es obligatoria"  ,
                //min: "*Debes ser mayor de edad para asistir al evento"
            },
            terminos: {
                required: "*Los términos son obligatorios"
            },
            HabeasData: {
                required: "*El  HabeasData es obligatorio"
            },
            'Respuesta_id[0]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[1]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[2]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[3]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[4]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[5]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[6]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[7]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[8]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[9]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[10]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[11]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[12]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[13]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[14]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[15]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[16]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[17]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[18]': {
                required: "*Seleccione una opción por favor"
            },

        }

    });

}

function validarCamposCrearEvento() {

    validarFormularioCrearEvento();
    if ($("#crearEvento").valid()) {
        EditarNombrePreguntasYRespuetas();
        $("#crearEvento").submit();
    }

}


function validarFormularioCrearEvento(){
    $("#crearEvento").validate({
        rules: {
            Nombre_Evento: {
                required: true
                // minlength: 2
            },
            Tipo_Evento: {
                required: true
            },
            SolicitarPIN: {
                required: true
            },
            Departamento_id: {
                required: true
            },
            Ciudad_id: {
                required: true
            },
            Lugar_Evento: {
                required: true
            },
            Fecha_Evento: {
                required: true
            },
            Fecha_Inicial_Registro: {
                required: true
            },
            Fecha_Final_Registro: {
                required: true
            },
            numeroAsistentes: {
                required: true
            },
            EsPublico: {
                required: true
            },
            CorreoEnviarInvitacion: {
                required: true
            },
            informacionEvento: {
                required: true
            }

        },
        messages: {
            Nombre_Evento: {
                required: "*El nombre del evento es obligatorio"
            },
            Tipo_Evento: {
                required: "*El tipo de evento es obligatorio"
            },
            SolicitarPIN: {
                required: "*Se debe seleccionar una opción"
            },
            Departamento_id: {
                required: "*El departamento es obligatorio"
            },
            Ciudad_id: {
                required: "*la ciudad es obligatoria"
            },
            Lugar_Evento: {
                equalTo: "*El lugar del evento  es obligatorio"
            },
            Fecha_Evento: {
                required: "*La fecha del evento es obligatoria"
            },
            Fecha_Inicial_Registro: {
                required: "*La fecha inicial es obligatoria"
            },
            Fecha_Final_Registro: {
                required: "*la fecha final es obligatoria"
            },
            numeroAsistentes: {
                required: "*El numero maximo de asistentes es obligatorio"
            },
            EsPublico: {
                required: "*Se debe  seleccionar una  opción"
            },
            CorreoEnviarInvitacion: {
                required: "*El correo de donde se debe enviar es obligatorio"
            },
            informacionEvento: {
                required: "*la información del evento es obligatorio"
            }

        }

    });

}

function construirGrafico() {
    var idPin = $("#idevento").val();
    $.ajax({
        url: urlBase+'CantidadAsistentes/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvas");
                var data = {
                    labels: [
                        "Asistentes Esperados",
                        "Asistentes Registrados"
                    ],
                    datasets: [
                        {
                            data: [result.CantidadEsperada, result.CantidadRegistrados],
                            backgroundColor: [
                                "#E5E8E8",
                                "#82E0AA"
                            ],
                            hoverBackgroundColor: [
                                "#E5E8E8",
                                "#82E0AA"
                            ]
                        }]
                }
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            }
        }
    });




}

function construirBarras() {
    var idEvento = $("#idevento").val();
    $.ajax({
        url: urlBase+'AsistentesXCiudad/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idEvento: idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasBarra");
                var data = {
                    labels: result.nombreCiudades,
                    datasets: [
                        {
                            data:result.Cantidad,
                            label: "Cantidad Asistentes",
                            backgroundColor: ["#000033","#0000CC","#003300","#0033FF","#006600","#006699",
                            "#0066CC","#009966","#009999","#0099CC","#0099FF","#00CC99","#00CCCC","#00CCFF","#00FF00","#00FF33",
                            "#00FF66","#00FF99","#330033","#330066","#330099","#3300CC","#3300FF","#333300","#333333","#333366","#333399","#3333CC","#3333FF",
                            "#336600","#336633","#336666","#336699","#3366CC","#3366FF","#339900","#339933","#339966","#339999","#3399CC","#3399FF","#33CC00","#33CC33","#33CC66","#33CC99",
                            "#66FF33","#66FF66","#66FF99","#66FFCC","#99CC00","#99CC33","#99CC66","#99FF00","#99FF33","#99FF66",
                            "#99FF99","#99FFCC","#99FFFF","#CC0000","#CC00CC","#CC00FF","#CC3300","#CC3333","#CC3366","#CC3399","#CC33CC","#CC33FF","#CC6600",
                            "#CC6633","#FF0066","#FF0099","#FF00CC","#FF00FF","#FF3300","#FF3333","#FF3366","#FF3399","#FF33CC","#FF33FF","#FF6600","#FF6633","#FF6666","#FF6699","#FF66CC",
                            "#FF66FF","#FF9900","#FF9933","#FF9966","#FF9999"]
                        }]
                        
                        
                }
                
              
                var myBarChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: 'Cantidad de Inscritos por ciudad',
                            top: 'bottom',
                            fontSize: 12
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: result.Maximo
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: "Cantidad"
                                }
                            }],
                                yAxes: [{
                        ticks: {
                        autoSkip: false
                    }
                }]
                        }
                    }

                });
            }
        }
    });

}

function BuscarAsistente() {
    var cc = $("#Identificacion").val();
    $.ajax({
        url: urlBase+'asistenteResgistrado/'+cc,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            cc: cc,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (!jQuery.isEmptyObject(result)) {
                $("#Nombres").val(result.Nombres);
                $("#Nombres").attr("readonly","readonly");
                $("#Apellidos").val(result.Apellidos);
                $("#Apellidos").attr("readonly","readonly");
                $("#telefono").val(result.telefono);
                $("#Email").val(result.Email);
               // $("#confEmail").val(result.Email);
                $("#Edad").val(result.Edad);
                $("#Dirección").val(result.Dirección);
                $("#Departamento_id").val(result.ciudad.Departamento_id);
                CargarMunicipiosDepartamento(result.ciudad.id);
            }else{
                $("#Nombres").val("");
                $("#Nombres").removeAttrs("readonly");
                $("#Apellidos").val(result.Apellidos);
                $("#Apellidos").removeAttrs("readonly");
                $("#telefono").val("");
                $("#Email").val("");
                //$("#confEmail").val("");
                $("#Edad").val("");
                $("#Dirección").val("");
                $("#Departamento_id").val("");
                $("#Ciudad_id").find("option").remove();//Removemos las opciónes anteriores
            }
        }
    });
}
