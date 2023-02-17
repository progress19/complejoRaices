<?php 

use App\Fun; 

use \MercadoPago\Item;
use \MercadoPago\MerchantOrder;
use \MercadoPago\Payer;
use \MercadoPago\Payment;
use \MercadoPago\Preference;
use \MercadoPago\SDK;

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Checkout;
use CoinbaseCommerce\Resources\Charge;
use CoinbaseCommerce\Resources\Event;

use App\Reserva;

?>

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-7">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-shopping-cart"></i> Reservas<small>/ Editar</small></h2>
                 
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'edit_reserva',
              'name' => 'edit_reserva',
              'url' => '/admin/edit-reserva/'.$reserva->id,
              'role' => 'form',
              'method' => 'post',
              'files' => true]) }}

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('fecha', 'Fecha') !!}
                  {!! Form::text('fecha', Carbon::parse($reserva->fecha)->format('d-m-Y'), ['id' => 'fecha', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('titular', 'Titular') !!}
                  {!! Form::text('titular', $reserva->titular, ['id' => 'titular', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="clearfix"></div> 

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('email', 'Email') !!}
                  {!! Form::text('email', $reserva->email, ['id' => 'email', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('telefono', 'N° teléfono') !!}
                  {!! Form::text('telefono', $reserva->telefono, ['id' => 'telefono', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('apartamento', 'Apartamento') !!}
                  {!! Form::text('apartamento', $reserva->apartamento->nombre, ['id' => 'apartamento', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('apartamento', 'Huéspedes') !!}
                  {!! Form::text('apartamento', $reserva->huespedes, ['id' => 'huespedes', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('fecha', 'Desde') !!}
                  {!! Form::text('fecha', Carbon::parse($reserva->desde)->format('d-m-Y'), array('class' => 'form-control datespicker','id' => 'desde','readonly')) !!}      
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('fecha', 'Hasta') !!}
                  {!! Form::text('fecha', Carbon::parse($reserva->hasta)->format('d-m-Y'), array('class' => 'form-control datespicker','id' => 'hasta','readonly')) !!}      
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('turno', 'Noches') !!}
                  {!! Form::text('turno', $reserva->noches, ['id' => 'noches', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('comentarios', 'Comentarios') !!}
                  {!! Form::textarea('comentarios', $reserva->comentarios, ['id' => 'comentarios', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="clearfix"></div>
              
              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('estado', 'Estado') !!}
                  {!! Form::select('estado', array('1' => 'Pagado', '0' => 'Pendiente'), $reserva->estado, ['id' => 'estado', 'class' => 'form-control']); !!}
                </div>
              </div>   

                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-success pull-right">Guardar</button>
              </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>

      <!-- panel paquetes  -->

      <div class="col-md-5">
        <div class="x_panel">
          
          <div class="x_content">

          <div class="totales-edit_reserva">

            <h4>Precio por noche : ${{ number_format($reserva->total / $reserva->noches ,0, ',', '.') }}</h4> 
            <h5>Total: ${{ number_format($reserva->total ,0, ',', '.') }}</h4>

          </div>

          <div class="clearfix"></div>

          </div>
        </div>

        <div class="x_panel"> <!-- pago -->
          
          <div class="x_title">
            <h2><i class="fa fa-dollar"></i> Datos del pago</h2>
            <ul class="nav navbar-right panel_toolbox"></ul>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="col-md-9">
          
            <h4>
              <p>Id tx: {{ $reserva->collection_id }}</p>
              <p>Estado: {{ $reserva->collection_status }}</p>
              <p>Referencia externa: {{ $reserva->external_reference }}</p>
              <p>Medio: {{ $reserva->payment_type }}</p>
            </h4>
            <?php //$mp = \MercadoPago\SDK::setAccessToken( env('ENV_ACCESS_TOKEN') ); // Either Production or SandBox AccessToken ?>

            </div>

            <div class="col-md-3">

              @if ($reserva->tipoPago == 1)
                <img src="{{ asset('images/mercado-pago-logo.png') }}" class="img-fluid" alt="">  
              @endif
            
              @if ($reserva->tipoPago == 2)
                <img src="{{ asset('images/coinbase-logo.png') }}" class="img-fluid" alt="">  
              @endif

            </div>

            <div class="col-md-12">
              
 
<?php 
    
  //ApiClient::init("9e598e8f-ae8b-4f49-b3fc-409d56843666");
  //$checkoutObj = Checkout::retrieve($reserva->preference_id);
  
?>

<pre>
 
  
  <?php 

    //$chargeObj = Charge::retrieve($reserva->codeCoinbase);  

     //echo $chargeObj->code.'<br>';

     //echo $chargeObj['payments']['0']['value']['crypto']['amount'] .'<br>';
     //echo $chargeObj['payments']['0']['value']['crypto']['currency'] .'<br>';
     //echo $chargeObj['payments']['0']['status'] .'<br>';

   // print_r($chargeObj);

  ?>

</pre>

<pre>
  
  <?php 

    //print_r($checkoutObj);

  ?>

</pre>



            </div>  

          </div>
        </div>

      </div>

@endsection

@section('page-js-script')

@stop

