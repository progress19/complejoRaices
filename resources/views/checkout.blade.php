<? use Carbon\Carbon;
Carbon::setLocale('es');
 ?>

@extends('layouts.frontLayout.front')
@section('title', 'Home')    
@section('content')

<div class="hotale-page-wrapper" id="hotale-page-wrapper">
    <div class="gdlr-core-page-builder-body">

<div class="gdlr-core-pbf-wrapper" style="padding: 20px 0px 0px 0px;" id="gdlr-core-wrapper-3">
   
    <div class="gdlr-core-pbf-background-wrap"></div>
    
    <div class="gdlr-core-pbf-background-wrap" style="top: 110px;">
        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image: url( https://localhost/raices/public/images/apartment2-column-bg.png ); background-repeat: no-repeat; background-position: top center;" data-parallax-speed="0">
        </div>
    </div>

    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">

        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" id="gdlr-core-column-7">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="padding: 0px 0px 0px 0px;">
                    <div class="gdlr-core-pbf-background-wrap"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js" style="max-width: 1200px;">
                        
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                <div class="gdlr-core-title-item-title-wrap">
                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title class-test" style="font-size: 45px; font-weight: 700; letter-spacing: 0px; line-height: 1; text-transform: none;">
                                        Encontramos lugar para tu alojamiento!!!<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-divider-item gdlr-core-divider-item-normal gdlr-core-item-pdlr gdlr-core-center-align">
                                <div class="gdlr-core-divider-container" style="max-width: 40px;">
                                    <div class="gdlr-core-divider-line gdlr-core-skin-divider" style="border-color: #74c586; border-width: 3px;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            
                            <div class="row">
                                
                                <div class="col-md-7">
                                    
                                    <div class="form-checkout border bg-light">
                        
                                        <div class="gdlr-core-contact-form-7-item gdlr-core-item-pdlr gdlr-core-item-pdb">
                                            <div role="form" class="wpcf7" id="wpcf7-f1979-p1964-o1" lang="en-US" dir="ltr">
                                                <div class="screen-reader-response">
                                                    <p role="status" aria-live="polite" aria-atomic="true"></p>
                                                    <ul></ul>
                                                </div>

                                                <div id="responseContacto" style="display: none;"></div>

                                                {{ Form::open(array('id' => 'frmReserva', 'role' => 'form')) }}

                                                    {!! Form::text('nombre', null, ['id' => 'nombreForm', 'class' => 'input', 'placeholder' => 'Nombre y Apellido:']) !!}
                                                    {!! Form::email('email', null, ['id' => 'emailForm', 'class' => 'input', 'placeholder' => 'Email:']) !!}
                                                    {!! Form::text('telefono', null, ['id' => 'telefonoForm', 'class' => 'input', 'placeholder' => 'Teléfono / Móvil:']) !!}
                                                    {!! Form::textarea('comentario', null, ['id' => 'comentarioForm', 'class' => 'input', 'rows' => 5, 'cols' => 40, 'placeholder' => 'Mensaje:']) !!}

                                                    <input type="text" class="displayNone" id="desdeForm" name="desde" value="<?php echo $_REQUEST['start_date']; ?>" >
                                                    <input type="text" class="displayNone" id="hastaForm" name="hasta" value="<?php echo $_REQUEST['end_date']; ?>" >

                                                    <input type="text" class="displayNone" id="" name="idApartamento" value="<?php echo $idApartamento; ?>" >
                                                    <input type="text" class="displayNone" id="" name="noches" value="<?php echo $noches; ?>" >
                                                    <input type="text" class="displayNone" id="" name="huespedes" value="<?php echo $_REQUEST['adult']; ?>" >
                                                    <input type="text" class="displayNone" id="" name="tarifa_diaria" value="<?php echo $total / $noches;  ?>" >

                                                    <input type="text" class="displayNone" id="external_reference" name="external_reference" value="<?php echo $external_reference; ?>" >
                                                    
                                                {{ Form::hidden('baseUrl', url('/'), array('id' => 'baseUrl')) }}

                                                {!! Form::close() !!}

                                            </div>
                                        </div>

                                    </div> 

                                </div>
                                
                                <div class="col-md-5">
                                    <div class="tu-viaje border bg-light">
                                        <h4 class="">Resumen</h4>
                                        <p><b>Check In:</b> {{ Carbon::parse($_REQUEST['start_date'])->translatedFormat('d F Y') }}.</p>
                                        <p><b>Check Out:</b> {{ Carbon::parse($_REQUEST['end_date'])->translatedFormat('d F Y') }}.</p>
                                        <p><b>Apartamento:</b> {{ $apartamento }}.</p>
                                        <p><b>Noches:</b> {{ $noches }}.</p>
                                        <p><b>Huéspedes:</b> {{ $_REQUEST['adult'] }}.</p>
                                        <p><b>Tarifa diaria:</b> ${{ number_format( $total / $noches ,0, ',', '.') }}.-</p>
                                        <hr>
                                        <h4 class="total"><b>TOTAL:</b> ${{ number_format( $total ,0, ',', '.') }}.-</h4>
                                        <hr>

                                        <div id="conteOpcionesPago">
                                            <a id="clicPago" class="pxay-checkout">

                                                <div class="col-md-12" style="text-align: center;">
                                                  <img src="{{ url('images/mercado-pago-logo.png') }}" class="img-responsive logo-mp-checkout hvr-bounce-in" alt="">
                                                </div>

                                                <div class="clearfix"></div>

                                            </a>
                                        </div>
                                        <div id="loadingOpcionesPago" style="display: none;"></div>

                                        <hr>
                                        <p>{!! $aclaraciones !!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb" style="padding-bottom: 20px;">
                                <div class="gdlr-core-text-box-item-content" style="font-size: 17px; text-transform: none; color: #94959b;">
                                 


                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

    <br><br><br><br> 

    </div>    
</div> 

@endsection

@section('page-js-script')

<script>

  

    (function($) { 

        $( "#clicPago" ).click(function() {
          $('#frmReserva').submit();
        });

    })(jQuery);
    
</script>

<script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js" data-preference-id="{{ $preferenceId }}">bos</script>

@stop






