try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};

var arrayColores= ["#6FBEEE","#0000CC","#003300","#0033FF","#006600","#006699",
    "#0066CC","#009966","#009999","#0099CC","#0099FF","#00CC99","#00CCCC","#00CCFF","#00FF00","#00FF33",
    "#00FF66","#00FF99","#330033","#330066","#330099","#3300CC","#3300FF","#333300","#333333","#333366","#333399","#3333CC","#3333FF",
    "#336600","#336633","#336666","#336699","#3366CC","#3366FF","#339900","#339933","#339966","#339999","#3399CC","#3399FF","#33CC00","#33CC33","#33CC66","#33CC99",
    "#66FF33","#66FF66","#66FF99","#66FFCC","#99CC00","#99CC33","#99CC66","#99FF00","#99FF33","#99FF66",
    "#99FF99","#99FFCC","#99FFFF","#CC0000","#CC00CC","#CC00FF","#CC3300","#CC3333","#CC3366","#CC3399","#CC33CC","#CC33FF","#CC6600",
    "#CC6633","#FF0066","#FF0099","#FF00CC","#FF00FF","#FF3300","#FF3333","#FF3366","#FF3399","#FF33CC","#FF33FF","#FF6600","#FF6633","#FF6666","#FF6699","#FF66CC",
    "#FF66FF","#FF9900","#FF9933","#FF9966","#FF9999"];
var numeroPregunta = 0;
var numeroRespuesta = 0;

//funcion que me retorna las ciudades dependiendo del departamento seleccionado
function CargarMunicipiosDepartamento(idCiudad){
    var idDepartamento =$("#Departamento_id").val();
    var $idCiudad =$("#Ciudad_id");
    $.ajax({
        url: urlBase+'/Ciudades/'+idDepartamento,//primero el modulo/controlador/metodo que esta en el controlador
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

function AgregarPregunta(){

    if(numeroPregunta == 0)//para validar la cantidad de preguntas que ya se tienen, esto se hace es para la parte de editar evento
        numeroPregunta = $("#CantidadPreguntas").val();

    //funcionalidad de agregar y mostrar pregunta
    var divPregunta = $("#divPregunta").clone();
    divPregunta.attr("id","pregunta");
    divPregunta.attr("name","pregunta");
    divPregunta.find("a[name=eliminarPregunta]").attr("data-target","#modalElimianarPregunta"+numeroPregunta);
    divPregunta.find("div[name=modalElimianarPregunta]").attr("id","modalElimianarPregunta"+numeroPregunta);
        //bloque para asignar id diferentes a los modales de eliminar pregunta
            divPregunta.find("div[name=Respuesta]").each(function(ind,element){
                $(element).find("a[name=eliminarRespuesta]").attr("data-target","#modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
                $(element).find("div[name=modalElimianarRespuesta]").attr("id","modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
                numeroRespuesta++;
            });
    numeroPregunta++;
    $("#ListaPreguntas").append(divPregunta);
}

function  EliminarPregunta(element) {
    $("#elmentosEliminados").append($(element).closest("div[name=pregunta]"));
}

function  AgregarRespuesta(element){
    var divRespuesta = $("#RespuestaPlantilla").clone();
    divRespuesta.removeAttrs('hidden')
    divRespuesta.attr("id","Respuesta");
    divRespuesta.attr("name","Respuesta");
    divRespuesta.find("a[name=eliminarRespuesta]").attr("data-target","#modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
    divRespuesta.find("div[name=modalElimianarRespuesta]").attr("id","modalElimianarRespuesta"+numeroRespuesta+numeroPregunta);
    $(element).closest("div[name=pregunta]").append(divRespuesta);
    numeroRespuesta++;
}

function  EliminarRespuesta(element) {
    $("#elmentosEliminados").append($(element).closest("div[name=Respuesta]"));
}

//Metodo para  editar los nombres  de los  elementos para  ser enviados  al  controlador
function EditarNombrePreguntasYRespuetas(){
    $("#ListaPreguntas").find("div[name=pregunta]").each(function (i,pregunta) {
        $(pregunta).find("input[name=TextoPregunta]").attr("name","Enunciado[" + i+ "]");
        $(pregunta).find("input[name=TextoTipoPregunta]").attr("name","TipoPregunta_id[" + i + "]");
        $(pregunta).find("input[name=PreguntaId]").attr("name","Pregunta_id[" + i + "]");
        $(pregunta).find("input[name=TextoRespuesta]").each(function (j,respuesta) {
            $(respuesta).attr("name","TextoRespuesta[" + i + "][" + j +"]");
        });
        $(pregunta).find("input[name=Respuesta_Id]").each(function (j,respuesta) {
            $(respuesta).attr("name","Respuesta_Id[" + i + "][" + j +"]");
        });
   });
    //editar los  nommbres de los  campos  cuando el evento es pago
    if($("#esPago").val() ==1){
        $("#divBoletas").find("div[name=PreciosBoletas]").each(function (i,precioBoleta) {
            $(precioBoleta).find("input[name=idPrecioBoleta]").attr("name","idPrecioBoleta["+ i +"]");
            $(precioBoleta).find("input[name=PrecioBoletaPadre_Id]").attr("name","PrecioBoletaPadre_Id["+ i +"]");
            $(precioBoleta).find("input[name=localidad]").attr("name","localidad["+ i +"]");
            $(precioBoleta).find("input[name=precio]").attr("name","precio["+ i +"]");
            $(precioBoleta).find("input[name=cantidad]").attr("name","cantidad["+ i +"]");
            $(precioBoleta).find("input[name=Codigo]").attr("name","Codigo["+ i +"]");
            $(precioBoleta).find("input[name=Porcentaje]").attr("name","Porcentaje["+ i +"]");
            $(precioBoleta).find("input[name=CantidadCod]").attr("name","CantidadCod["+ i +"]");
            if($(precioBoleta).find("input[name=esActiva]").prop( "checked" ))
            {
                $(precioBoleta).find("input[name=Activa]").val('1');
            }else{
                $(precioBoleta).find("input[name=Activa]").val('0');
            }
            if($(precioBoleta).find("input[name=boletaPromo]").prop( "checked" ))
            {
                $(precioBoleta).find("input[name=esPromo]").val('1');
            }else{
                $(precioBoleta).find("input[name=esPromo]").val('0');
            }
            if($(precioBoleta).find("input[name=boletaConvenio]").prop( "checked" ))
            {
                $(precioBoleta).find("input[name=esConvenio]").val('1');
            }else{
                $(precioBoleta).find("input[name=esConvenio]").val('0');
            }
            $(precioBoleta).find("input[name=esPromo]").attr("name","esPromo["+ i +"]");
            $(precioBoleta).find("input[name=Activa]").attr("name","Activa["+ i +"]");
            $(precioBoleta).find("input[name=esConvenio]").attr("name","esConvenio["+ i +"]");
        });
    }
}

function ValidarPin () {
    var idPin = $("#pinIngresar").val();
    $.ajax({
        url: urlBase+'/pin/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
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

function generarQRCode(){
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
                required: true,
                email: true
            },
            confEmail: {
                equalTo: "#Email",
                email: true
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
            Evento_id:{
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
                required: "*El email es obligatorio",
                email: "Se debe  ingresar un correo valido"
            },
            confEmail: {
                equalTo: "*Los correos debe ser iguales",
                email: "Se debe  ingresar un correo valido"
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
            Evento_id:{
                required: "*Se debe seleccionar un evento"
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
    var validarCamposLocalidad = true;
    var validarCamposPrecioBoleta = true;
    var validarCamposCantidad = true;
    var validarCamposCodigo = true;
    var validarCamposPorcentaje = true;
    if($("#esPago").val() == 1){//se valida si seleccionó si el evento es pago
        validarCamposLocalidad = validarCamposDinamicos($('#crearEvento'),'localidad','input','*','','*La localidad es obligatoria');
        validarCamposPrecioBoleta = validarCamposDinamicos($('#crearEvento'),'precio','input','*','','*El precio es obligatorio');
        validarCamposCantidad = validarCamposDinamicos($('#crearEvento'),'cantidad','input','*','','*La cantidad es obligatoria');


        $("#divBoletas").find('input[name=boletaPromo]').each(function (ind, check) {
            if ($(check).prop("checked")) {
                var contenedor =  $(check).closest('div[name=rowPrecio]');
                validarCamposCodigo = validarCamposDinamicos(contenedor,'Codigo','input','*','','*El código es obligatorio');
                validarCamposPorcentaje = validarCamposDinamicos(contenedor,'Porcentaje','input','*','','*El porcentaje es obligatorio');
                validarCamposPorcentaje = validarCamposDinamicos(contenedor,'CantidadCod','input','*','','*La cantidad de codigos es obligatoria');
            }
        });

    }
    var validarCamposPreguntas = validarCamposDinamicos($('#crearEvento'),'TextoPregunta','input','*','','*La pregunta es obligatoria');
    var validarCamposRespuestas = validarCamposDinamicos($('#crearEvento'),'TextoRespuesta','input','*','','*La respuesta es obligatoria');
    if ($("#crearEvento").valid() && validarCamposLocalidad && validarCamposPrecioBoleta &&
        validarCamposPreguntas && validarCamposRespuestas && validarCamposCantidad &&
        validarCamposCodigo && validarCamposPorcentaje && validarCamposPorcentaje) {
        EditarNombrePreguntasYRespuetas();
        $("#crearEvento").submit();
    }
}

function validarFormularioCrearEvento(){
    $("#crearEvento").validate({
        rules: {
            Nombre_Evento: {
                required: true,
                maxlength: 60
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
            Hora_Evento: {
                required: true
            },
            Hora_Inicial_Registro: {
                required: true
            },
            Hora_Final_Registro: {
                required: true
            },
            numeroAsistentes: {
                required: true
            },
            EsPublico: {
                required: true
            },
            CorreoEnviarInvitacion: {
                required: true,
                email: true
            },
            informacionEvento: {
                required: true
            },
            esPago:{
                required: true
            }


        },
        messages: {
            Nombre_Evento: {
                required: "*El nombre del evento es obligatorio",
                maxlength: "*El nombre debe tener máximo 50 caracteres"
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
                required: "*El lugar del evento  es obligatorio"
            },
            Fecha_Evento: {
                required: "*La fecha del evento es obligatoria"
            },
            Fecha_Inicial_Registro: {
                required: "*La fecha inicial es obligatoria"
            },
            Fecha_Final_Registro: {
                required: "*La fecha final es obligatoria"
            },
            Hora_Evento: {
                required: "*La hora del evento es obligatoria"
            },
            Hora_Inicial_Registro: {
                required: "*La hora incial de es obligatoria"
            },
            Hora_Final_Registro: {
                required: "*La hora final es obligatoria"
            },
            numeroAsistentes: {
                required: "*El numero máximo de asistentes es obligatorio"
            },
            EsPublico: {
                required: "*Se debe  seleccionar una  opción"
            },
            CorreoEnviarInvitacion: {
                required: "*El correo de donde se debe enviar es obligatorio",
                email: "Se debe  ingresar un correo valido"
            },
            informacionEvento: {
                required: "*la información del evento es obligatorio"
            },
            esPago:{
                required: "*Se debe selecccionar si el evento es pago"
            }

        }

    });

}

function construirGraficoCantidadAsistentes() {
    var idPin = $("#idevento").val();
    $.ajax({
        url: urlBase+'/CantidadAsistentes/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasCantidadAsistentes");
                var data = {
                    labels: [

                        "Personas Registradas",
                        "Asistentes"
                    ],
                    datasets: [
                        {
                            data: [ result.CantidadRegistrados,result.CantidadAsistentes],
                            backgroundColor: [
                                "#82E0AA",
                                "#CC3300"
                            ],
                            hoverBackgroundColor: [
                                "#82E0AA",
                                "#CC3300"
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

function construirGraficoLiquidacion() {
    var idPin = $("#idevento").val();
    $.ajax({
        url: urlBase+'/LiquidacionGrafica/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasLiquidacion");

                var data = {
                    labels:
                        result.PrecioEtapas,
                    datasets: [
                        {
                            data: result.CantidadBoletas,
                            label: "Cantidad Boletas",
                            backgroundColor: [
                                "#3FC929",
                                "#BC6FEE",
                                "#29BDC9",
                                "#BDC929",
                                "#6FBEEE",
                                "#EE6F97"
                            ],
                            hoverBackgroundColor: [
                                "#3FC929",
                                "#BC6FEE",
                                "#29BDC9",
                                "#BDC929",
                                "#6FBEEE",
                                "#EE6F97"
                            ]
                        }]
                }
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: 'Cantidad de Boletas x Etapa'
                        }}

                });
            }
        }
    });
}

function construirGraficoKPI() {
    var idPin = $("#idevento").val();
    $.ajax({
        url: urlBase+'/CantidadAsistentes/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                
                var opts = {

                    angle: 0.1, // The span of the gauge arc
                    lineWidth: 0.3, // The line thickness
                    radiusScale: 1, // Relative radius
                    pointer: {
                      length: 0.62, // // Relative to gauge radius
                      strokeWidth: 0.035, // The thickness
                      color: '#000000' // Fill color
                      
                    },
                    limitMax: false,     // If false, max value increases automatically if value > maxValue
                    limitMin: false,     // If true, the min value of the gauge will be fixed
                    colorStart: '#6FADCF',   // Colors
                    colorStop: '#8FC0DA',    // just experiment with them
                    strokeColor: '#E0E0E0',  // to see which ones work best for you
                    generateGradient: true,
                    highDpiSupport: true, 

                    // percentColors : [[0.0, "#a9d70b" ], [0.50, "#f9c802"], [1.0, "#ff0000"]],

                    renderTicks: {
                        divisions: 5,
                        divWidth: 1.1,
                        divLength: 0.7,
                        divColor: '#333333',
                        subDivisions: 3,
                        subLength: 0.5,
                        subWidth: 0.6,
                        subColor: '#666666'
                      },

                      staticLabels: {
                        font: "15px sans-serif",  // Specifies font
                        labels: [0, (result.CantidadEsperada/5), (2*(result.CantidadEsperada/5)), (3*(result.CantidadEsperada/5)), (4*(result.CantidadEsperada/5)),parseInt(result.CantidadEsperada)],  // Print labels at these values
                        color: "#000000",  // Optional: Label text color
                        fractionDigits: 0  // Optional: Numerical precision. 0=round off.
                      },
                      
                      staticZones: [
                        {strokeStyle: "#F03E3E", min: 0, max: (result.CantidadEsperada/5), height: 1.4},
                        {strokeStyle: "#ff8c00", min: (result.CantidadEsperada/5), max: (2*(result.CantidadEsperada/5)), height: 1.2}, // Red from 100 to 130
                        {strokeStyle: "#FFDD00", min: (2*(result.CantidadEsperada/5)), max: (3*(result.CantidadEsperada/5)), height: 1}, // Yellow
                        {strokeStyle: "#FFDD00", min: (3*(result.CantidadEsperada/5)), max: (4*(result.CantidadEsperada/5)), height: 0.8}, // Yellow
                        {strokeStyle: "#30B32D", min: (4*(result.CantidadEsperada/5)), max: result.CantidadEsperada, height: 0.6}, // Green
                     ],
                     
                    
                  };
                  //var target = document.getElementById('foo'); // your canvas element
                  var ctx = document.getElementById("canvasKPI");
                  var gauge = new Gauge(ctx).setOptions(opts); // create sexy gauge!
                  gauge.maxValue = parseInt(result.CantidadEsperada); // set max gauge value
                  gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
                  gauge.animationSpeed = 32; // set animation speed (32 is default value)
                  gauge.set(parseInt(result.CantidadRegistrados)); // set actual value
                  
            
               
            }
        }
    });




}

function construirBarrasAsistentesCiudades() {
    var idEvento = $("#idevento").val();
    $.ajax({
        url: urlBase+'/AsistentesXCiudad/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idEvento: idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasCiudadesAsistens");
                var data = {
                    labels: result.nombreCiudades,
                    datasets: [
                        {
                            data:result.Cantidad,
                            label: "Cantidad Asistentes",
                            backgroundColor: arrayColores
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
                                    max: parseInt(result.Maximo)
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

function construirBarrasAsistentesEdades() {
    var idEvento = $("#idevento").val();
    $.ajax({
        url: urlBase+'/EdadesAsistentes/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idEvento: idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasEdadesAsistentes");
                var data = {
                    labels: result.LabelEdades,
                    datasets: [
                        {
                            data:result.Cantidad,
                            label: "Edades Asistentes",
                            backgroundColor: arrayColores
                        }]


                }


                var myBarChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: 'Edades de los asistentes registrados',
                            top: 'bottom',
                            fontSize: 12
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max:parseInt(result.Maximo)
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

function construirBarrasAsistentesXFecha() {
    var idEvento = $("#idevento").val();
    $.ajax({
        url: urlBase+'/AsistentesXFecha/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idEvento: idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasAsistentesXFecha");
                var data = {
                    labels: result.LabelFechas,
                    datasets: [
                        {
                            data:result.Cantidad,
                            label: "fecha de Registro",
                            backgroundColor: arrayColores
                        }]


                }


                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        title: {
                            display: true,
                            text: 'fechas de registros asistentes',
                            top: 'bottom',
                            fontSize: 12
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: parseInt(result.Maximo)
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: "Cantidad"
                                }
                            }],
                            xAxes: [{
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

function construirGraficoJuntas() {
    var idPin = $("#idevento").val();
    $.ajax({
        url: urlBase+'/JuntasAsistentes/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idPin: idPin,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                var ctx = document.getElementById("canvasJuntAsistens");
                var data = {
                    labels: [
                        "Juntas Esperadas",
                        "Juntas Asistentes"
                    ],
                    datasets: [
                        {
                            data: [result.Cantidadtotal, result.CantidadAsistentes],
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

function BuscarAsistente() {
    var cc = $("#Identificacion").val();
    var idEvento = $("#Evento_id").val();
    $.ajax({
        url: urlBase+'/asistenteResgistrado/'+ cc + '/' + idEvento,//primero el modulo/controlador/metodo que esta en el controlador
/*        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            cc: cc,
            _token :$("#_token").val()
        },*/
        type: 'GET',
        success: function (arrayResult) {
            var result = arrayResult.asistente;
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
                $("#cantidadBoletas").val(result.cantidadBoletas);
                $("#precioTotal").val(result.precioTotal);
            }else{
                $("#Nombres").val("");
                $("#Nombres").removeAttrs("readonly");
                $("#Apellidos").val();
                $("#Apellidos").removeAttrs("readonly");
                $("#telefono").val("");
                $("#Email").val("");
                //$("#confEmail").val("");
                $("#Edad").val("");
                $("#Dirección").val("");
                $("#Departamento_id").val("");
                $("#Ciudad_id").find("option").remove();//Removemos las opciónes anteriores
                $("#cantidadBoletas").val("");
                $("#precioTotal").val("");
            }
            if (!jQuery.isEmptyObject(arrayResult.preciosBoletas)){
                crearLocalidadesDescuentos(arrayResult.preciosBoletas);
                swal({
                    title: "Afiliado!",
                    text: "¡Tienes un descuento en tu ticket por ser afiliado a comfenalco!",
                    icon: "success",
                    button: "OK",
                });
            }
        }
    });
}

function leerIdentificacion(){
    validarQR($("#idEvento").val(),$("#cc").val());
}

function leerQR() {
    var stringQR = $("#lectorQR").val();
    var string1 = stringQR.split("CC - ");
    if(string1.length>1){
        var identificacion = string1[1].split("ECO")[0];
        validarQR($("#idEvento").val(),identificacion);
    }else{
        $("#nombre").html("");
        $("#apellido").html("");
        $("#identificacion").html("");
        $("#email").html("");
        $("#qrActivo").attr("style", "font-size:30px; color:orange;");
        $("#qrActivo").html("QR NO VALIDO");
        $("#pk_usuario").val("");
    }

}

function validarQR(idEvento,cc) {
    $.ajax({
        url: urlBase+'/InformacionQR/'+idEvento+'/'+cc,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            cc: cc,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {

                if(!jQuery.isEmptyObject(result)){

                    $("#nombre").text(result.Nombres);
                    $("#apellido").text(result.Apellidos);
                    $("#identificacion").text(result.Identificacion);
                   // $("#email").html(result[0].email);
                   // $("#comentario").html(result[0].comentario);
                    $("#pk_usuario").val(result.id);
                    if (result.esActivo == 0){
                        if(result.esPerfilado == "A"){
                            $("#qrActivo").attr("style", "font-size:20px; color:blue;");
                            $("#qrActivo").html("¡SI!,USUARIO PUEDE INGRESAR !!LLAVERO!!");
                        }else{
                            $("#qrActivo").attr("style", "font-size:20px; color:green;");
                            $("#qrActivo").html("¡SI!,USUARIO PUEDE INGRESAR");
                        }
                        $("#lectorQR").val(cc);

                        activarQRUsuario();
                    }
                    else{
                        $("#qrActivo").attr("style", "font-size:20px; color:red;");
                        $("#qrActivo").html("¡NO!,USUARIO YA INGRESÓ");
                        $("#lectorQR").val("");
                    }

                }
                else{

                    $("#nombre").html("");
                    $("#apellido").html("");
                    $("#identificacion").html("");
                    $("#email").html("");
                    $("#qrActivo").attr("style", "font-size:30px; color:orange;");
                    $("#qrActivo").html("USUARIO NO REGISTRADO");
                    $("#pk_usuario").val("");
                    $("#lectorQR").val("");
                }



        }



    });


}

function activarQRUsuario(){

    //var identificacion = " ";
    var identificacion = $("#lectorQR").val();
    var cedulaUsuario = $("#pk_usuario").val();
    var idEvento = $("#idEvento").val();
    $.ajax({
        url: urlBase+'/ActivarQR/'+idEvento+'/'+cedulaUsuario+'/'+identificacion,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            cc: cedulaUsuario,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                $("#qrActivo").html(result);
            }
        }
    });
    $("#lectorQR").val("");

}

function  MostrarDivBoletas(){
    if($("#esPago").val() ==1){
        $("#divBoletas").removeAttr("hidden");
        $("#divPromotor").removeAttr("hidden");
        $("#divMaxLocalidadCompra").removeAttr("hidden");
    }else{
        $("#divBoletas").attr("hidden","hidden");
        $("#divPromotor").attr("hidden","hidden");
        $("#divMaxLocalidadCompra").attr("hidden","hidden");
    }
}

function MostrarDivBoletaPromocional(element){
    if($(element).prop( "checked" )){
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").attr("class","input-group-addon");
        $(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").attr("class","input-group-addon");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").attr("class","input-group-addon");

        //convenio
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsConvenio]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsConvenio]").attr("hidden","hidden");
    }else{
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").attr("hidden","hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").attr("hidden","hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").attr("hidden","hidden");

        //convenio
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsConvenio]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsConvenio]").attr("class","input-group-addon");
    }
}

function MostrarDivBoletaConveniol(element){
    if($(element).prop( "checked" )){
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").removeAttr("hidden");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").removeAttr("hidden");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").text("0");

        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").attr("class","input-group-addon");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").attr("class","input-group-addon");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").attr("class","input-group-addon");

        //convenio
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsPromo]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsPromo]").attr("hidden","hidden");
    }else{
        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").removeAttr("class");
       // $(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").removeAttr("class");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").removeAttr("class");
        $(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").text("");

        $(element).closest("div[name=rowPrecio]").find("div[name=divCodigo]").attr("hidden","hidden");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divPorcentaje]").attr("hidden","hidden");
        //$(element).closest("div[name=rowPrecio]").find("div[name=divCantidadCod]").attr("hidden","hidden");

        //convenio
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsPromo]").removeAttr("hidden");
        $(element).closest("div[name=rowPrecio]").find("div[name=divEsPromo]").attr("class","input-group-addon");
    }
}

function AgregarNuevaLocalidad(){
    var divLocalidad = $("#DivPreciosBoletas").clone();
    divLocalidad.attr("id","PreciosBoletas");
    divLocalidad.attr("name","PreciosBoletas");
    divLocalidad.removeAttr("hidden");
    $("#divBoletas").append(divLocalidad);
}

function EliminarLocalidad(element){
    $(element).closest("div[name=PreciosBoletas]").remove();
}

function EnviarFormulario() {
    validarCamposConfirmacion();
    if ($("#ConfirmarAsistente").valid()) {
        $("#ConfirmarAsistente").submit();
    }
}

function validarCamposConfirmacion(){
    $("#ConfirmarAsistente").validate({
        rules: {
            Identificacion: {
                required: true
                // minlength: 2
            },
            confirmarAsistencia: {
                required: true
            }

        },
        messages: {
            Identificacion: {
                required: "*La Identificación es Obligatoria"
            },
            confirmarAsistencia: {
                required: "*Tienes que seleccionar una opción a la pregunta"
            }

        }

    });

}

//VALIDACION DE CAMPOS DINAMICOS
//contenedor: contenedor donde se encuentran los campos dinamicos a validar ejemplo $("#actividades")
//nameElementoAValidar: nombre(name) de los elementos a validar ejemplo "DescripcionActividad"
//tipoElemento:tipo de elemento a buscar para realizar la validacion por ejemplo "input"
//tipoSelector: es el tipo de selector para jquery un ejemplo es el asterisco(*) es el que encuentra todos elementos que contengan un subestring especificada,
//sino se especifica un selector se toma el igual como defecto..consultar api de jquery https://api.jquery.com/category/selectors/
//errorClass:es la clase con la que va aparecer la etiqueta que mostrara el mensaje de validación por defecto viene con la clase "error-dinamico".
//errorMensaje: mensaje que se mostrará de la validación el mensaje por defecto es "el campo es obligatorio"
function validarCamposDinamicos(contenedor, nameElementoAValidar, tipoElemento,tipoSelector, errorClass,errorMensaje) {
    if (contenedor != undefined && nameElementoAValidar != undefined)
    {
        var formulario = $(contenedor);
        var stringElementoBuscar = "";
        if (tipoSelector != undefined)
        {
            stringElementoBuscar = tipoElemento + "[name" + tipoSelector + "=" + nameElementoAValidar + "]";
        } else
        {
            stringElementoBuscar = tipoElemento + "[name=" + nameElementoAValidar + "]";
        }
        var valido = true;
        var labelError="";
        if (errorClass === undefined && errorMensaje === undefined)
        {
            labelError = '<label class="error-dinamico">El campo es obligatorio</label>';
        } else if (errorClass != undefined && errorMensaje === undefined)
        {
            labelError = '<label class="' + errorClass + '">El campo es obligatorio</label>';
        } else if (errorClass != undefined && errorMensaje != undefined)
        {
            labelError = '<label class="' + errorClass + '">' + errorMensaje + '</label>';
        } else if (errorClass === undefined && errorMensaje != undefined)
        {
            labelError = '<label class="error-dinamico">' + errorMensaje + '</label>';
        }
        formulario.find(stringElementoBuscar).each(function (ind,element) {
            var label = $(element).next("label");
            if ($(element).val().trim() === '') {
                if (label != undefined) {
                    label.remove();
                }
                $(element).after(labelError);
                $(element).attr("onchange", "quitarlabelError(this)");
                valido = false;
            } else
            {
                label.remove();
            }
        });
        return valido;
    } else {
        return false;
    }
}

//funcion para quitar las etiquetas de la validación dimamica
function quitarlabelError(element) {
    var label = $(element).next("label");
    if ($(element).val().trim() === '') {
        if (label != undefined) {
            label.remove();
        }
    } else {
        label.remove();
    }
}

//funcion para registrar un usuario desde el administrador
function validarCamposRegistrarUsuario() {
    validarFormulario();
}

//Funcion para cargar la vista con los usuarios registrados en los eventos
function ajaxRenderSectionCargarUsuarios() {
    var idEvento = $("#Evento_id").val();
    $.ajax({
        type: 'GET',
        url: urlBase +'/UsuariosXEvento/'+idEvento,
        dataType: 'json',
        success: function (data) {
            $('#listaUsuarios').empty().append($(data));
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function SelecTodosUsuarios(element){
    if($(element).prop( "checked")) {
        $("#tablaUsuarios").find('input[name=chkUsuario]').each(function (ind, check) {
            if (!$(check).prop("checked")) {
                $(check).prop("checked", "checked")
            }
        });
    }else{
        $("#tablaUsuarios").find('input[name=chkUsuario]').each(function (ind, check) {
            $(check).prop("checked", false);
        });
    }
}

function ActualizarEventosFecha(){
    $.ajax({
        url: urlBase+'ActualizarEventosFecha',//primero el modulo/controlador/metodo que esta en el controlador
        type: 'POST'})
}

