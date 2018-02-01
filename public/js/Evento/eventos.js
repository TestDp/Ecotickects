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
                if(result){
                    $('#formAsistente').removeAttr("hidden");
                }

            }
        }
    });
}
// function validarPIN()
// {

//     //var stringQR =$("#lectorQR").val();
//     //var string1 = stringQR.split("CC");
//     var idPin = $("#pinIngresar").val();
   
//     $.ajax({
//         url: 'validarPIN/'+idPin,//primero el modulo/controlador/metodo que esta en el controlador
//         data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
//             pinIngresar: idPin,
//             _token :$("#_token").val()           
//         },
//         type: 'POST',
//         success: function (result) {
//             if (result) {
//                 if(result.length > 0){
					
// 				 $("#nombre").html(result[0].nombre);
// 				 $("#apellido").html(result[0].apellido);
// 				 $("#identificacion").html(result[0].identificacion);
// 				 $("#email").html(result[0].email);
// 				 $("#comentario").html(result[0].comentario);
// 				 $("#pk_usuario").val(result[0].id_Usuario);
// 				 if (result[0].qrActivo == 0){
// 					 if(result[0].tipoUsuario == "A"){
//                        $("#qrActivo").attr("style", "font-size:30px; color:blue;"); 
//                        $("#qrActivo").html("¡SI!,USUARIO PUEDE INGRESAR !!LLAVERO!!");
//                     }else{
//                         $("#qrActivo").attr("style", "font-size:30px; color:green;");
//                         $("#qrActivo").html("¡SI!,USUARIO PUEDE INGRESAR");
//                     }  
// 				 }
// 				 else{
// 					 $("#qrActivo").attr("style", "font-size:30px; color:red;");
// 					 $("#qrActivo").html("¡NO!,USUARIO YA INGRESÓ");
// 				 }
				 
// 				}
// 				else{
					
// 				 $("#nombre").html("");
// 				 $("#apellido").html("");
// 				 $("#identificacion").html("");
// 				 $("#email").html("");
// 				 $("#qrActivo").attr("style", "font-size:30px; color:orange;");
// 				 $("#qrActivo").html("USUARIO NO REGISTRADO");
// 				 $("#pk_usuario").val("");
// 				}
				 
// 				  $("#lectorQR").val("");
//             }
//         }
//     });


// }
