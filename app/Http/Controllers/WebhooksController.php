<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use \MercadoPago\Item;
use \MercadoPago\MerchantOrder;
use \MercadoPago\Payer;
use \MercadoPago\Payment;
use \MercadoPago\Preference;
use \MercadoPago\SDK;

use App\Reserva;
use App\Fecha;
use App\Config;
use DateTime;

class WebhooksController extends Controller {

    public function __invoke(Request $request) {

        $payment_id = $_REQUEST['id'];

        // env('ENV_ACCESS_TOKEN')
        // de test : APP_USR-3618598695645197-080322-2db74c93cbed4cf021a2a8622d5a6315-793278417

        $payment = Http::get('https://api.mercadopago.com/v1/payments/' .$payment_id . '?access_token='.env('ENV_ACCESS_TOKEN'));

        $payment = json_decode($payment);

        Reserva::where(['external_reference' => $payment->external_reference])->update([
            //'collection_id' => $_REQUEST['collection_id'],
            'collection_id' => $payment_id,
            'collection_status' => $payment->status,
            'payment_type' => $payment->payment_type_id,
            'estado' => 1,
        ]);


        if ($payment->status == 'approved') {

            $reserva = Reserva::where(['external_reference' => $payment->external_reference])->first();

            //envio email

            if ($reserva->emailSend == 0) { //emailSend en 1 significa email ya enviado

                    $config = Config::where(['id'=>1])->first();
                    $textoEmail = $config->textoEmail;
                    $data = [ 
                        'reserva' => $reserva,
                        'apartamento' => $reserva->apartamento->nombre,
                        'textoEmail' => $textoEmail,
                    ]; 

                //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
                \Mail::send('emails.reserva', $data, function($message) use ($reserva, $payment, $config) {
                //remitente
                    $message->from('info@complejoraices.com.ar', 'Complejo Raíces');
                //asunto
                    $message->subject('RESERVA RAICES');
                //destinatarios
                    $destinatarios = explode(',', $config->destinatarios);
                    foreach ($destinatarios as $destinatario) {
                        $message->to($destinatario, 'complejoraices.com.ar');  
                    }

                    $message->to($reserva->email, $reserva->titular);  
                    
                });

                Reserva::where([
                'external_reference' => $payment->external_reference])->update([
                'emailSend' => 1, //marco 1 email enviado
                ]);

            } // endif email enviado

                /* bloqueo los dias */

                $firstDate  = new DateTime($reserva->desde);
                $secondDate = new DateTime($reserva->hasta);
                
                $intvl = $firstDate->diff($secondDate);
                
                for ( $i = 0; $i < $intvl->days; $i++ ) { 
                 
                    $fecha = new DateTime($reserva->desde);
                    
                    date_add( $fecha, date_interval_create_from_date_string( $i." day" ));
                                                    
                    $fecha_a = date_format($fecha,"Y-m-d");

                    $fecha_query = Fecha::where('fecha', '=', $fecha_a)->where('idApartamento', '=', $reserva->idApartamento)->first();

                    if ($fecha_query) {

                        Fecha::where([ 'id' => $fecha_query->id ])->where([ 'idApartamento' => $fecha_query->idApartamento ])->update([
                            'estado' => 1,
                        ]);

                    }
                }


            // Check mandatory parameters
            if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
                http_response_code(400);
                return;
            }
        }
    }
}

