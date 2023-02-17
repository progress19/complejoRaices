<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Config;
use App\Reserva;
use App\Apartamento;
use App\Fecha;
use Session;

use DB;

use \MercadoPago\Item;
use \MercadoPago\MerchantOrder;
use \MercadoPago\Payer;
use \MercadoPago\Payment;
use \MercadoPago\Preference;
use \MercadoPago\SDK;

class Controller extends BaseController {

	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function viewHome() { 
		return view('home');
	}

	public function viewOffline() { return view('offline'); }

	public function testEmail(Request $request) {

		$config = Config::where(['id'=>1])->first();

		$data = []; 

		//se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
		\Mail::send('emails.test', $data, function($message) use ($config) {

			//remitente
			$message->from('noreply@xxxxxxxx.com', 'xxxxxxxx.com');

			//asunto
			$message->subject('TEST xxxxxxxx xxxxxxxx');

			//destinatarios
			$destinatarios = explode(',', $config->destinatarios);
			foreach ($destinatarios as $destinatario) {
				$message->to($destinatario, 'xxxxxxxx.com');  
			}

		});

	}
	

public function enviarContacto(Request $request) {

	sleep(1);

	//guarda el valor de los campos enviados desde el form en un array
		$data = $request->all();
	/*       
	$data = [
	'data' => $request->all(),
	'promo' => $promo
	];
	*/
	//se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
	\Mail::send('emails.contacto', $data, function($message) use ($request)

	{
	//remitente
	//$message->from($request->email, $request->name);
		$message->from('info@complejoraices.com.ar', 'Complejo Raices');

	//asunto
		$message->subject('Contacto desde Complejo Raices');

	//destinatarios

		$config = Config::where(['id'=>1])->first();

		$destinatarios = explode(',', $config->destinatarios);

		foreach ($destinatarios as $destinatario) {
			$message->to($destinatario, 'complejoraices.com.ar');  
		}

		$message->to($request->email, $request->nombre);

	//$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));

	});

	return '<div class="mensaje-consulta"><span style="font-size:30px"></span><br>GRACIAS POR TU CONSULTA! <br> PRONTO TE CONTACTAREMOS!!!</div>';

}


public function viewTarifas() {

	$paquetes = Paquete::where('estado',1)->where('tipo',1)->orderBy('orden','asc')->get();

	$config = Config::where(['id'=>1])->first();

	return view('tarifas')->with([
		'paquetes' => $paquetes,
		'config' => $config,
		'tipo' => 1
	]);

}

/* VIEW CHECKOUT  *********************************************************************************************************************************/
/* VIEW CHECKOUT  *********************************************************************************************************************************/
/* VIEW CHECKOUT  *********************************************************************************************************************************/

public function viewCheckout() {

//dd($_REQUEST);

	$apartamentos = Apartamento::where('estado',1)->get();        

	foreach ($apartamentos as $apartamento) {

		//echo $apartamento->id.'<br>';
		$disponible = false;
		$noches = 0;
		$total = 0;

		for( $i = $_REQUEST['start_date'] ; $i < $_REQUEST['end_date'] ; $i = date("Y-m-d", strtotime($i ."+ 1 days"))) {

			$fecha = Fecha::where('fecha',$i)->where('estado',0)->where('idApartamento',$apartamento->id)->first();

			if ($fecha) {   

				//echo $i.' si <br>'; // SI hay lugar para ese dia
				$disponible = true;
				$noches++;

				switch ( $_REQUEST['adult'] ) {
					case '1':
						$total = $total + $fecha->t2;
						break;
					case '2':
						$total = $total + $fecha->t2;
						break;
					case '3':
						$total = $total + $fecha->t3;
						break;
					case '4':
						$total = $total + $fecha->t4;
						break;
					case '5':
						$total = $total + $fecha->t5;
						break;
					case '6':
						$total = $total + $fecha->t6;
						break;
				}

			} else {
				//echo $i.' no <br>'; // NO hay lugar para ese dia
				$disponible = false;
				break;
			}

		} // fin for 

		if ( $disponible == 1 ) {
			//echo '<br>tenemos lugar en el dto:'.$apartamento->id.'<br>';
			// calculo tarifa
			break;
		}
	} //foreach

	if ( $disponible == 1 ) {

				$reserva_save = session()->get('reserva_save');
				$config = Config::where(['id'=>1])->first(); //get external_reference

				if ( $reserva_save == 1 ) {
					
					$external_reference = session()->get('external_reference');

				}	else {
					
	        $external_reference = $config->external_reference;
	        session()->put('external_reference', $external_reference);

	        Config::where(['id'=>1])->update([
	          'external_reference' => $external_reference + 1,
	        ]);
				}
				
   
	      /* INICIO MERCADOPAGO */
	      //require_once '../vendor/autoload.php'; // You have to require the library from your Composer vendor folder

	      $mp = \MercadoPago\SDK::setAccessToken( env('ENV_ACCESS_TOKEN') ); // Either Production or SandBox AccessToken

	      // Crea un objeto de preferencia
	      $preference = new \MercadoPago\Preference();

	      // Crea un ítem en la preferencia
	      $item = new \MercadoPago\Item();
	      $item->title = 'Reserva alojamiento Raices';
	      $item->quantity = 1;
	      $item->unit_price = $total;
	      $preference->items = array($item);
	      $preference->notification_url = url('webhooks');
	      $preference->external_reference = $external_reference;

	      $preference->back_urls = array(
	          "success" => url('gracias'),
	          "failure" => url('gracias'),
	          "pending" => url('gracias')
	      );

	      $preference->auto_return = "approved"; 

	      $preference->save();

		    session()->put('pref_id', $preference->id);
		    session()->put('total_a_pagar', $total);

			return view('checkout')->with([
				'apartamento' => $apartamento->nombre,
				'idApartamento' => $apartamento->id,
				'noches' => $noches,
				'total' => $total,
				'aclaraciones' => $config->textoCheckout,
				'preferenceId' => $preference->id,
				'external_reference' => $external_reference
			]);

	} else {

			return view('buscador');

	}
	
}

/* SEND RESERVA  *********************************************************************************************************************************/
/* SEND RESERVA  *********************************************************************************************************************************/
/* SEND RESERVA  *********************************************************************************************************************************/


	public function enviarReserva(Request $request) {

		sleep(0);

		if(isset($_POST['email']))  {
			
			$total = 0;

			$reserva_save = session()->get('reserva_save');

			if ($reserva_save == 0) {  //consulto si ya grabe la reserva en backend

				//  grabo reserva por primera vez

				$model = new Reserva;

				//$model->fecha = $request->fecha;
				$model->titular = $request->nombre;
				$model->email = $request->email;
				$model->telefono = $request->telefono;
				$model->comentarios = $request->comentario;
				$model->desde = $request->desde;
				$model->hasta = $request->hasta;

				$model->idApartamento = $request->idApartamento;
				$model->noches = $request->noches;
				$model->huespedes = $request->huespedes;
				
				$model->total = session()->get('total_a_pagar'); 
				$model->estado = 0;
				$model->preference_id = session()->get('pref_id'); 

				$model->external_reference = $request->external_reference; 

				if ($model->titular) {

					$model->save();
					session()->put('reserva_save', 1);
					session()->put('idReserva', $model->id);

				}

			}

			if ($reserva_save == 1) {  //consulto si ya grabe la reserva en backend

					//actualizo reserva  

					$preference_id = session()->get('pref_id'); 

				Reserva::where( ['external_reference' => $request->external_reference ] )->update([
					'titular' => $request->nombre, 
					'email' => $request->email, 
					'telefono' => $request->telefono,
					'comentarios' => $request->comentario, 
					'preference_id' => $preference_id, 
					'desde' => $request->desde,
					'hasta' => $request->hasta,
					'total' => session()->get('total_a_pagar'),
					'idApartamento' => $request->idApartamento,
					'noches' => $request->noches,
					'huespedes' => $request->huespedes,
				]);
				
			} 

		return true;

		}  

	}

	public function gracias(Request $request) {

	    if ( isset($_REQUEST['collection_id']) ) {
	        
	        //echo 'status:'.$_REQUEST['collection_status'];

	        switch ( $_REQUEST['collection_status'] ) {
	          
	          case 'approved':
	            
	            $texto = '<h2 style="text-align: center;"><i class="fa fa-check" aria-hidden="true"></i></h2>
	            <h5 style="text-align: center; line-height: 1.5;">¡Muchas gracias! Hemos recibido el Pago sobre la Reserva de alojamiento exitosamente.</h5><br>
	            <h5 style="text-align: center;">En breve recibirás un email con información detallada, en caso de no recibir, favor de comunicarse.</h5>';

	            Controller::receive_ipn(); 

	            break;

	          case 'pending':
	      
	            $texto ='<h2 style="text-align: center;"><i class="fa fa-check" aria-hidden="true"></i></h2>
	           <h5>¡Muchas gracias! Hemos recibido tu Reserva pero el pago esta aun pendiente de acreditarse, te comunicaremos en cuanto recibamos el pago.</h5>';
	            
	          break;

	          case 'rejected':
	      
	            $texto ='<h2 style="text-align: center;"><i class="fa fa-check" aria-hidden="true"></i></h2>
	           <h5>Tu tarjeta rechazó el pago.</h4><h4>Usá otra tarjeta u otro medio de pago.</h5>';
	            
	          break;

	          default:
	            $texto = 'error!';
	            break;
	        }

	     } 

	     session()->forget('cart');
	     session()->flush();

	    return view('gracias')->with([
	        'texto' => $texto,
	    ]);

	}


	public function receive_ipn() { 

		\MercadoPago\SDK::setAccessToken( env('ENV_ACCESS_TOKEN') );

		$merchant_order = null;

		if (isset($_GET["id"])) {$id = $_GET["id"];}

		if (isset($_REQUEST['collection_id'])) {$id = $_REQUEST['collection_id'];}

		$payment = \MercadoPago\Payment::find_by_id($id);
		// Get the payment and the corresponding merchant_order reported by the IPN.
		$merchant_order = \MercadoPago\MerchantOrder::find_by_id($payment->order->id);

		Reserva::where(['external_reference' => $payment->external_reference])->update([
			'collection_id' => $_REQUEST['collection_id'],
			'collection_status' => $payment->status,
			'payment_type' => $payment->payment_type_id,
			'estado' => 1,
		]);

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
					$message->from('info@complejoraices.com.ar', 'Complejo Raices');

					//asunto
					$message->subject('RESERVA Complejo Raices');

					//destinatarios
					$destinatarios = explode(',', $config->destinatarios);
					foreach ($destinatarios as $destinatario) {
						$message->to($destinatario, 'Reservas Complejo Raices');  
					}
					$message->to($reserva->email, $reserva->titular);  

				});
				
				Reserva::where(['external_reference' => $payment->external_reference])->update([
				'emailSend' => 1, //marco 1 email enviado
				]);

			} // endif email enviado

			// Check mandatory parameters
			if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
				http_response_code(400);
				return;
			}

	}

}


