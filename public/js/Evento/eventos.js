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
