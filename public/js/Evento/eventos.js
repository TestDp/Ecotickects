var urlBase = "/Ecotickects/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP


//funcion que me retorna las ciudades dependiendo del departamento seleccionado
function CargarMunicipiosDepartamento()
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
    var qr = create_qrcode("La Gran Encuesta PYME - CC" + $("#identificacion").val() + "DPSoluciones" );
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
            identificacion: {
                required: true
            },
            celular: {
                required: true
            },
            email: {
                required: true
            },
            confirmarEmail: {
                equalTo: "#email"
            },
            idDepartamento: {
                required: true
            },
            fk_ciudadResidencia: {
                required: true
            },
            genero: {
                required: true
            },
            edad: {
                required: true,
                //min: 18
            },
            terminos: {
                required: true
            },
            HabeasData: {
                required: true
            },
            'fk_id_respuesta[0]': {
                required: true
            },
            'fk_id_respuesta[1]': {
                required: true
            },
            'fk_id_respuesta[2]': {
                required: true
            },
            'fk_id_respuesta[3]': {
                required: true
            },
            'fk_id_respuesta[4]': {
                required: true
            },
            'fk_id_respuesta[5]': {
                required: true
            },
            'fk_id_respuesta[6]': {
                required: true
            },
            'fk_id_respuesta[7]': {
                required: true
            },
            'fk_id_respuesta[8]': {
                required: true
            },
            'fk_id_respuesta[9]': {
                required: true
            },
            'fk_id_respuesta[10]': {
                required: true
            },
            'fk_id_respuesta[11]': {
                required: true
            },
            'fk_id_respuesta[12]': {
                required: true
            },
            'fk_id_respuesta[13]': {
                required: true
            },
            'fk_id_respuesta[14]': {
                required: true
            },
            'fk_id_respuesta[15]': {
                required: true
            },
            'fk_id_respuesta[16]': {
                required: true
            },
            'fk_id_respuesta[17]': {
                required: true
            },
            'fk_id_respuesta[18]': {
                required: true
            },

        },
        messages: {
            nombre: {
                required: "*El nombre es obligatorio"
            },
            apellido: {
                required: "*Empres/Institución es obligatorio"
            },
            identificacion: {
                required: "*La identificación es obligatorio"
            },
            celular: {
                required: "*El celular es obligatorio"
            },
            email: {
                required: "*El email es obligatorio"
            },
            confirmarEmail: {
                equalTo: "*Los correos debe ser iguales"
            },
            idDepartamento: {
                required: "*El cargo es obligatorio"
            },
            fk_ciudadResidencia: {
                required: "*La ciudad es obligatoria"
            },
            genero: {
                required: "*El rol es obligatorio"
            },
            edad: {
                required: "*La edad es obligatoria"  ,
                //min: "*Debes ser mayor de edad para asistir al evento"
            },
            terminos: {
                required: "*Los términos son obligatorios"
            },
            HabeasData: {
                required: "*El  HabeasData es obligatorio"
            },
            'fk_id_respuesta[0]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[1]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[2]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[3]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[4]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[5]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[6]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[7]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[8]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[9]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[10]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[11]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[12]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[13]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[14]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[15]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[16]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[17]': {
                required: "*Seleccione una opción por favor"
            },
            'fk_id_respuesta[18]': {
                required: "*Seleccione una opción por favor"
            }

        }

    });

}
