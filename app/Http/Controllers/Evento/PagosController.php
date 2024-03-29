<?php

namespace Ecotickets\Http\Controllers\Evento;

use Alexo\LaravelPayU\LaravelPayU;
use Eco\Datos\Modelos\Orden;
use Eco\Negocio\Logica\PagosServicio;
use Ecotickets\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class PagosController extends Controller
{
    protected $pagosServicio;
    protected  $estadotrasaccion='PENDIENTE';
    protected  $bancosPSE;
    protected  $responsePSE;
    protected  $errorPSE;

    public function __construct(PagosServicio $pagosServicio)
    {
        $this->pagosServicio = $pagosServicio;
    }

    public  function  CargarFormularioPagoTC($tipoTC)
    {
        $view = View::make('MPagos/FormularioPagoTCVP')->with('tipoTC',$tipoTC);
        $sections = $view->renderSections();
        return Response::json($sections['FomularioPagoTD']);
    }
    public  function  CargarFormularioPagoPSE()
    {
        try{
            LaravelPayU::getPSEBanks(function($banks) {
                $this->bancosPSE = $banks;
            }, function($error) {
                $this->errorPSE = $error;
            });
            $view = View::make('MPagos/FormularioPagoPSEVP')->with('listaBancos',$this->bancosPSE);
            $sections = $view->renderSections();
            return Response::json($sections['FomularioPagoPSE']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return ['respuesta' => false, 'error' => $error,'errorPSE' => $this->errorPSE];
        }
    }

    public  function  CargarFormularioMediosDePago()
    {
        $view = View::make('MPagos/FormularioMediosDePagoVP');
        $sections = $view->renderSections();
        return Response::json($sections['FomularioMediosDePago']);
    }
    public function PagarTC(Request $formPago)
    {
        $infoPago =  $this->pagosServicio->obtenerInfoPagos($formPago->InfoPId);
        $order = new Orden();
        $order->reference = env('REFERENCECODE') .$formPago->InfoPId;
        $order->value = $infoPago->PrecioTotal;
        $ip = $this->ObtenerIPComprador();
        $data = $this->pagosServicio->ObtenerParametrosPayuTC($formPago,$order->reference,$order->value,$ip);
        $order->payWith($data, function($response, $order)
        {
            if ($response->code == 'SUCCESS' && $response->transactionResponse->state =='SUCCESS')
            {
                $order->update([
                    'payu_order_id' => $response->transactionResponse->orderId,
                    'transaction_id' => $response->transactionResponse->transactionId
                ]);
                $this->estadotrasaccion = $response->transactionResponse->state;
            }
            else
            {
                $this->estadotrasaccion = $response->transactionResponse->state;
            }
        }, function($error) {
            $this->resultadoPago = $error;
        });
        if(!isset($this->resultadoPago)){
            $ElementosArray = $this->pagosServicio->ObtenerInfoRespuestaPago($this->estadotrasaccion,$order->reference);
            $view = View::make('respuestaPago',['ElementosArray' => $ElementosArray]);
            $sections = $view->renderSections();
            return Response::json(['STATUS'=>'SUCCESS','RESPONSE'=>$sections['RespuestaPago']]);
        }else{
            return Response::json(['STATUS'=>'ERROR','RESPONSE'=>'Por favor validar sus datos de pago']);
        }
    }

    public function PagarPSE(Request $formPago)
    {
        $infoPago =  $this->pagosServicio->obtenerInfoPagos($formPago->InfoPId);
        $order = new Orden();
        $order->reference = env('REFERENCECODE') .$formPago->InfoPId;
        $order->value = $infoPago->PrecioTotal;
        $ip = $this->ObtenerIPComprador();
        $data = $this->pagosServicio->ObtenerParametrosPayuPSE($formPago,$order->reference,$order->value,$ip);
        $order->payWith($data, function($response, $order)
        {
            if ($response->code == 'SUCCESS' && $response->transactionResponse->state =='SUCCESS')
            {
                $order->update([
                    'payu_order_id' => $response->transactionResponse->orderId,
                    'transaction_id' => $response->transactionResponse->transactionId
                ]);
                $this->responsePSE = $response;
            }
            else
            {
                $this->responsePSE = $response;
            }
        }, function($error) {
            $this->resultadoPago = $error;
        });
        if($this->responsePSE->transactionResponse->state=="PENDING"){
           $URLPAGOPSE =  $this->responsePSE->transactionResponse->extraParameters->BANK_URL;
            return response()->json(array('Respuesta'=>true,'URLPPAGOPSE'=>$URLPAGOPSE));
        }
        return response()->json(array('Respuesta'=>false,'URLPPAGOPSE'=>null));

    }

    public function RespuestaPagoPSE()
    {
        $ElementosArray = $this->pagosServicio->ObtenerInfoPagoRespuestaPSE($_REQUEST);
        return View('MPagos/ResultadoPagoPSEVP',['InfoPago' => $ElementosArray]);
    }

    public function ObtenerIPComprador(){
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
}
