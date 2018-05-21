var urlBase = "/Ecophp/trunk/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP

function ActivarProducto (idProducto) {
    idEvento =$("#Evento").val();
    $.ajax({
        url: urlBase+'ActivarProducto/'+idProducto+'/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idProducto: idProducto,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                location.reload(true);
            }
        }
    });
}

var total = 0;
function  agregarProductoAlCarrito(element) {
    var divProducto = $(element).closest('div[name=producto]');
    var inputPrecio = divProducto.find('input[name=precio]');
    $(inputPrecio).removeAttrs('hidden');
    var inputNombre = divProducto.find('input[name=nombreProducto]');
    $(inputNombre).removeAttrs('hidden');
    var inputidProducto = divProducto.find('input[name=idProducto]').val();
    var trProductos = $("#listaProductos").find('tr[name='+inputidProducto+']');
    if(trProductos.length==0){
        var subtotal = $(inputPrecio).val()*1;
        total = total + subtotal;
        var tr = '<tr id ="'+inputidProducto+'" name ="'+inputidProducto+'">';
            tr = tr +'<td hidden><input type="hidden" id="cantidad" name="cantidad" value="1" /><input type="hidden" id="precio" name="precio" value="'+inputPrecio.val()+'" /><input type="hidden" id="id" name="id" value="'+inputidProducto+'" /></td>';
            tr = tr +'<td >'+inputNombre.val()+'</td>';
            tr = tr +'<td >'+inputPrecio.val()+'</td>';
            tr = tr +'<td id="cantidad" name="cantidad">'+1+'</td>';
            tr = tr +'<td id="subtotal" name="subtotal">'+subtotal+'</td>';
            tr = tr +'<td > <input type="button"  onclick="quitarProductoDelCarrito(this)"/></td>';
            tr = tr +'</tr>';
        $("#listaProductos").append(tr);
    }else{
        var cantidadProductos = parseInt(trProductos.find('input[name=cantidad]').val())+1;
        trProductos.find('input[name=cantidad]').val(cantidadProductos)
        var subtotal =  parseInt(inputPrecio.val())* parseInt(cantidadProductos);
        total = total + parseInt(inputPrecio.val());
        trProductos.find('td[name=cantidad]').html(cantidadProductos);
        trProductos.find('td[name=subtotal]').html(subtotal);
    }
    $("#total").html(total);
}

function  quitarProductoDelCarrito(element) {
    var trProductos = $(element).closest('tr');
    var inputPrecio = trProductos.find('input[name=precio]');
    var cantidadProductos = parseInt(trProductos.find('input[name=cantidad]').val())-1;
    if(cantidadProductos>0){
        trProductos.find('input[name=cantidad]').val(cantidadProductos)
        var subtotal =  parseInt(inputPrecio.val())* parseInt(cantidadProductos);
        total = total - parseInt(inputPrecio.val());
        trProductos.find('td[name=cantidad]').html(cantidadProductos);
        trProductos.find('td[name=subtotal]').html(subtotal);
    }else{
        total = total - parseInt(inputPrecio.val());
        trProductos.remove();
    }
    $("#total").html(total);
}

function validarCamposFormularioCompra() {
    validarFormularioCompra();
    if ($("#crearCompra").valid()) {
        editarNombresCompra();
        //$("#crearCompra").submit();
        RegistrarCompra();
    }
}

function validarFormularioCompra(){
    $("#crearCompra").validate({
        rules: {
            CorreoComprador: {
                required: true
            }
        },
        messages: {
            CorreoComprador: {
                required: "*El correo es obligatorio"
            }

        }

    });

}

function editarNombresCompra() {
    $("#listaProductos").find("tr").each(function (i,producto) {
        $(producto).find("input[name=cantidad]").attr("name","cantidad[" + i+ "]");
        $(producto).find("input[name=id]").attr("name","Producto_id[" + i + "]");
    });

}

function RegistrarCompra () {
    var form = $("#crearCompra");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase + 'RegistrarCompra',//primero el modulo/controlador/metodo que esta en el controlador
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        dataType: "JSON",
        success: function (result) {
            if (result.respuesta) {
                $('#merchantId').val(result.info.merchantId);
                $('#accountId').val(result.info.accountId);
                $('#description').val(result.info.description);
                $('#referenceCode').val(result.info.referenceCode);
                $('#amount').val(result.info.amount);
                $('#tax').val(result.info.tax);
                $('#taxReturnBase').val(result.info.taxReturnBase);
                $('#currency').val(result.info.currency);
                $('#signature').val(result.info.signature);
                $('#test').val(result.info.test);
                $('#buyerEmail').val(result.info.buyerEmail);
                $('#responseUrl').val(result.info.responseUrl);
                $('#confirmationUrl').val(result.info.confirmationUrl);
                $("#formPago").submit();
            }
        }
    });
}