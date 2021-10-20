<?php
/**
 * Created by PhpStorm.
 * User: DPS-C
 * Date: 30/03/2020
 * Time: 9:42 PM
 */

namespace Eco\Negocio\Logica;


use Eco\Datos\Repositorio\InfoPagosRepositorio;

class PagosServicio
{

    protected $infoPagosRepositorio;
    protected  $asistenteServicio;

    public function __construct(InfoPagosRepositorio $infoPagosRepositorio, AsistenteServicio $asistenteServicio)
    {
        $this->infoPagosRepositorio = $infoPagosRepositorio;
        $this->asistenteServicio = $asistenteServicio;
    }

    public function obtenerInfoPagos($idInfoPagos)
    {
       return $this->infoPagosRepositorio->obtenerInfoPagos($idInfoPagos);
    }

    public function ObtenerParametrosPayuTC($formPago,$refencia,$subTotal)
    {
        $total = $this->CalcularValorTotal($subTotal,env('PORCENTAJETC'));
        $data = [
            \PayUParameters::REFERENCE_CODE => $refencia,
            \PayUParameters::VALUE => $total,
            \PayUParameters::TAX_VALUE => "0",
            \PayUParameters::TAX_RETURN_BASE => "0",
            \PayUParameters::CURRENCY => "COP",
            \PayUParameters::DESCRIPTION => env('DESCRIPCION'),
            \PayUParameters::IP_ADDRESS => '127.0.0.1',
            \PayUParameters::CURRENCY => 'COP',
            \PayUParameters::CREDIT_CARD_NUMBER => $formPago->numeroTarjeta,
            \PayUParameters::CREDIT_CARD_EXPIRATION_DATE =>'20'. $formPago->anioVenc.'/'.$formPago->mesVenc,
            \PayUParameters::CREDIT_CARD_SECURITY_CODE => $formPago->codigoTarjeta,
            \PayUParameters::INSTALLMENTS_NUMBER => $formPago->numeroCuotas,
            \PayUParameters::PAYMENT_METHOD => $formPago->tipoTC,
            \PayUParameters::PAYER_NAME => $formPago->nombrePagador,
            \PayUParameters::PAYER_EMAIL => $formPago->Email,
            \PayUParameters::PAYER_CONTACT_PHONE => $formPago->numeroTel,
            \PayUParameters::PAYER_DNI => $formPago->documentoPagador,
            \PayUParameters::PAYER_STREET => $formPago->Direccion,
            \PayUParameters::PAYER_STREET_2 => $formPago->Direccion,
            \PayUParameters::PAYER_CITY => "Antioquia",
            \PayUParameters::PAYER_STATE => "Rionegro",
            \PayUParameters::PAYER_COUNTRY => "CO",
            \PayUParameters::PAYER_POSTAL_CODE => "000000",
            \PayUParameters::PAYER_PHONE => $formPago->numeroTel,
            \PayUParameters::NOTIFY_URL=>env('URLCONFIRMATION')
        ];
        return $data;
    }

    public function CalcularValorTotal($subtotal,$porcentajeAumento){
        $total = $subtotal + $subtotal*$porcentajeAumento;
        return $total;
    }

    public function ObtenerParametrosPayuPSE($formPago,$refencia,$subTotal,$ip)
    {
        $data = [
            \PayUParameters::REFERENCE_CODE => $refencia,
            \PayUParameters::VALUE => $subTotal,
            \PayUParameters::TAX_VALUE => "0",
            \PayUParameters::TAX_RETURN_BASE => "0",
            \PayUParameters::CURRENCY => "COP",
            \PayUParameters::DESCRIPTION => env('DESCRIPCION'),
            \PayUParameters::IP_ADDRESS => $ip,
            \PayUParameters::CURRENCY => 'COP',
            \PayUParameters::PAYMENT_METHOD => "PSE",
            \PayUParameters::PAYER_NAME => $formPago->nombreTitular,
            \PayUParameters::PAYER_EMAIL => $formPago->Email,
            \PayUParameters::PAYER_CONTACT_PHONE => $formPago->numeroTel,
            \PayUParameters::PAYER_DNI => $formPago->documentoPagador,
            \PayUParameters::PAYER_STREET => $formPago->Direccion,
            \PayUParameters::PAYER_STREET_2 => $formPago->Direccion,
            \PayUParameters::PAYER_CITY => "Antioquia",
            \PayUParameters::PAYER_STATE => "Rionegro",
            \PayUParameters::PAYER_COUNTRY => "CO",
            \PayUParameters::PAYER_POSTAL_CODE => "000000",
            \PayUParameters::PAYER_PHONE => $formPago->numeroTel,
            \PayUParameters::PAYER_DOCUMENT_TYPE => $formPago->tipoDoc,
            \PayUParameters::PSE_FINANCIAL_INSTITUTION_CODE => $formPago->banco,
            \PayUParameters::PAYER_PERSON_TYPE => $formPago->tipoCliente,
            \PayUParameters::RESPONSE_URL=>env('URLRESPONSEPSE'),
            \PayUParameters::USER_AGENT =>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36",
            \PayUParameters::PAYER_COOKIE=>"_ga=GA1.1.516722673.1535080117",
            \PayUParameters::NOTIFY_URL=>env('URLCONFIRMATION')

        ];
        return $data;
    }

    public function ObtenerInfoRespuestaPago($estadoTransaccion,$referencia)
    {
        $evento = $this->asistenteServicio->ObtenerEventoRefe($referencia);
        $ElementosArray = null;
        switch ($estadoTransaccion) {
            case 'APPROVED': /* Approved */
                $ElementosArray = array('evento' => $evento, 'mensaje' => "APROBADO");
                break;
            case 'PENDING': /* Pending*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "PENDIENTE");
                break;
            case 'DECLINED': /* Declined*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "DECLINADO");
                break;
            case 'ERROR': /* Error*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "ERROR");
                break;
            case 'EXPIRED': /* Expired*/
                $ElementosArray = array('evento' => $evento, 'mensaje' => "EXPIRADO");
                break;
            default: /* Do something */
                $ElementosArray = array('evento' => $evento, 'mensaje' => "PENDIENTE POR PAYU");
                break;
        }
        return $ElementosArray;
    }

    public function ObtenerInfoPagoRespuestaPSE($responsePSE)
    {
        $fechaCompra = new \DateTime();
        $InfoPago = new \stdClass();
        $InfoPago->Empresa ='ECOTICKETS S.A.S';
        $InfoPago->NIT ='1036929741';
        $InfoPago->Fecha = $fechaCompra->format('d-m-Y H:i:s');
        $InfoPago->Estado =$this->obtenerEstadoRespuetaPagoPSE($responsePSE['polTransactionState'],$responsePSE['polResponseCode']);
        $InfoPago->RefPedido = $responsePSE['referenceCode'];
        $InfoPago->RefTrasaccion =$responsePSE['transactionId'];
        $InfoPago->NumTransaccion = $responsePSE['cus'];
        $InfoPago->Banco = $responsePSE['pseBank'];
        $InfoPago->Valor =$responsePSE['TX_VALUE'];
        $InfoPago->Moneda =$responsePSE['currency'];
        $InfoPago->Descripcion = $responsePSE['description'];
        $InfoPago->IP = $responsePSE['pseReference1'];;
        return $InfoPago;
    }

    public function obtenerEstadoRespuetaPagoPSE($polTransactionState,$polResponseCode)
    {
        $estadoPSE = null;
        if($polTransactionState == 4 && $polResponseCode==1 )
        {
            $estadoPSE =  'Transacción aprobada';
        }
        if($polTransactionState == 6 && $polResponseCode == 5)
        {
            $estadoPSE =  'Transacción fallida';
        }
        if($polTransactionState == 6 && $polResponseCode == 4)
        {
            $estadoPSE =  'Transacción rechazada';
        }
        if($polTransactionState == 12 || $polTransactionState ==14 || $polResponseCode==9994 || $polResponseCode == 25)
        {
            $estadoPSE =  'Transacción pendiente, por favor revisar si el débito fue realizado en el banco.';
        }
        if($polTransactionState == 6 && $polResponseCode == 19)
        {
            $estadoPSE =  'Transacción cancelada';
        }
        return $estadoPSE;
    }
}