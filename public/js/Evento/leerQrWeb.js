try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};


//crea elemento
const video = document.createElement("video");

//nuestro camvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

//div donde llegara nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");

//lectura desactivada
let scanning = false;

//funcion para encender la camara
const encenderCamara = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function (stream) {
      scanning = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

//funciones para levantar las funiones de encendido de la camara
function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

//apagara la camara
const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop();
  });
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
};

const activarSonido = () => {
  var audio = document.getElementById('audioScaner');
  audio.play();
}

//callback cuando termina de leer el codigo QR
qrcode.callback = (respuesta) => {
  if (respuesta) {
    //console.log(respuesta);
    //Swal.fire(respuesta)
    activarPinBoleta(respuesta);
    activarSonido();
    //encenderCamara();
    cerrarCamara();

  }
};
/*
//evento para mostrar la camara sin el boton
window.addEventListener('load', (e) => {
  encenderCamara();
})
*/

function activarPinBoleta(strQr){
   var pin = strQr.split('CC - ');
   pin  =  pin[1].split('ECO');
   pin = pin[0];
    var idEvento = $("#idEvento").val();
    var userName = $("#userName").val();

    $.ajax({
        type: 'GET',
        url: urlBase +'/ActivarPinApp/' + idEvento + '/' + pin + '/' + userName,
        dataType: 'json',
        success: function (data) {
            Swal.fire(data);
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



function abrirCamara(){
    $("#abriCamara").click();
    tick();
    scan();
}


