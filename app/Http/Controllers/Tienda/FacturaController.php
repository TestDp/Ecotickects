<?php

namespace Ecotickets\Http\Controllers\Tienda;

use Eco\Negocio\Logica\AsistenteServicio;
use Eco\Negocio\Logica\EventosServicio;
use Ecotickets\Http\Controllers\Controller;
use Eco\Negocio\Logica\FacturaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    protected $facturaServicio;
    protected $asistenteServicio;
    protected $eventoServicio;

    public function __construct(FacturaServicio $facturaServicio,AsistenteServicio $asistenteServicio,EventosServicio $eventoServicio)
    {
        $this->facturaServicio = $facturaServicio;
        $this->asistenteServicio = $asistenteServicio;
        $this->eventoServicio = $eventoServicio;
    }

    public function crearFactura(Request $EdFactura)
    {
        return response()->json($this->facturaServicio->crearFactura($EdFactura));
    }

    /**Metodo de respuesta de la plataforma de pagos payu para confirmar el pago, el  llamado
    se hace de  manera asincronica.Metodo de comunicacion entre sistemas.**/
    public function RespuestaPagosTiendaPayu(Request $formRegistro)
    {
        try {
            $merchantId = $formRegistro->merchant_id;
            $referenciaVenta= $formRegistro->reference_sale;
            $valor= $formRegistro->value;
            $moneda= $formRegistro->currency;
            $estadoVenta = $formRegistro->state_pol;
            $firmaVenta = $formRegistro->sign;
            //NOTA:linea para verificar la informacion enviada  por payu
            $verficarFirma  = $this->asistenteServicio->validarFirmaPago($merchantId,$referenciaVenta,$valor,$moneda,$estadoVenta,$firmaVenta);
            //$verificarfirma:1 para la validacion de la firma es correcta
            //$verificarfirma:0 para la validacion de la firma es incorrecta
            $idFactura = $this->facturaServicio->ObtenerIdFacturadDesdeRefencia($referenciaVenta);
            if ($estadoVenta == 4 && $verficarFirma == 1) {
                $this->facturaServicio->actualizarEstadoFactura($idFactura,true);
            }else{
                // se actualiza la informmacion del pago cuando el estado de la transaccion es diferente a 4
                $this->facturaServicio->actualizarEstadoFactura($idFactura,false);
            }
            return response('OK',200);
        }catch (\Exception $e){
            $error = $e->getMessage();
            return reponse('ERROR',404);
        }
    }

    /**Metodo de respuesta de la plataforma payu para mostrar el mensaje al usuario sobre el estado de la transaccion.
     * el llamado se hace cuando se presiona el boton de regresar al sitio.*/
    public function RespuestaPagosUsuarioTienda()
    {
        $estadoTransaccion = $_REQUEST['transactionState'];
        switch ($estadoTransaccion) {
            case 4: /* Approved */
                $ElementosArray= array('mensaje' => "APROBADO");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;

            case 7: /* Pending*/
                $ElementosArray= array('mensaje' => "PENDIENTE");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;

            case 6: /* Declined*/
                $ElementosArray= array('mensaje' => "DECLINADO");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;

            case 104: /* Error*/
                $ElementosArray= array('mensaje' => "ERROR");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;

            case 5: /* Expired*/
                $ElementosArray= array('mensaje' => "EXPIRADO");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;

            default: /* Do something */
                $ElementosArray= array('mensaje' => "PENDIENTE POR PAYU");
                return view("Tienda/respuestaPagoTienda",['ElementosArray' =>$ElementosArray]);
                break;
        }

        return redirect('/');
    }

    public  function  EventosConVentas(Request $request){

        $user = Auth::user();
        $misEventosConVentas =  $this->facturaServicio->EventosConVentas($user->id);
        return view("Tienda/EventosConVentas",['misEventosConVentas'=>$misEventosConVentas]);
    }

    public function  VentasPorEvento(Request $request,$idEvento)
    {

        $VentasPorEvento = $this->facturaServicio->VentasPorEvento($idEvento);
        $evento = $this->eventoServicio->obtenerEvento($idEvento);
        return view("Tienda/VentasPorEvento",['VentasPorEvento'=>$VentasPorEvento,'nombreEvento'=>$evento->Nombre_Evento]);
    }

    public  function  obtenerDetalleFactura(Request $request,$idFactura)
    {

        $detallesFactura = $this->facturaServicio->obtenerDetalleFactura($idFactura);
        $factura =  $this->facturaServicio->obtenerFactura($idFactura);
        return view("Tienda/DetalleVenta",['detallesFactura'=>$detallesFactura,'factura'=>$factura]);

    }

    public  function actualizarEstadoFacturaDespachada($idfactura,$estadoDespachada)
    {
        return response()->json($this->facturaServicio->actualizarEstadoFacturaDespachada($idfactura,$estadoDespachada));
    }
}
