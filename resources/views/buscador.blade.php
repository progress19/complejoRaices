<? 
use Carbon\Carbon; 
?>

@extends('layouts.frontLayout.front')
@section('title', 'Buscador')    
@section('content')

<div class="hotale-page-wrapper" id="hotale-page-wrapper">
    <div class="gdlr-core-page-builder-body">

        <div class="gdlr-core-pbf-wrapper" style="padding: 20px 0px 0px 0px;" id="gdlr-core-wrapper-3">
   
    <div class="gdlr-core-pbf-background-wrap"></div>
    
    <div class="gdlr-core-pbf-background-wrap" style="top: 110px;">
        <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image: url( https://localhost/raices/public/images/apartment2-column-bg.png ); background-repeat: no-repeat; background-position: top center;" data-parallax-speed="0">
        </div>
    </div>

<div class="conte-buscador">

<div class="gdlr-core-pbf-wrapper" style="margin: -90px auto 0px auto; padding: 5px 0px 5px 0px; max-width: 920px;">
    <div class="gdlr-core-pbf-background-wrap" style="box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); -moz-box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); -webkit-box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); border-radius: 20px 20px 20px 20px;-moz-border-radius: 20px 20px 20px 20px;-webkit-border-radius: 20px 20px 20px 20px; background-color: #ffffff;">                            
    </div>
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" data-skin="Green Button" id="gdlr-core-column-3">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="margin: 0px 0px 0px 0px; padding: 20px 10px 0px 10px;">
                    <div class="gdlr-core-pbf-background-wrap"></div>

                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                <div class="gdlr-core-title-item-title-wrap">
                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title class-test" style="font-size: 30px; font-weight: 700; letter-spacing: 0px; line-height: 1; text-transform: none;">
                                        No encontramos disponibilidad para las fechas seleccionadas...<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span>
                                    </h3>
                                </div>
                            </div>
                        </div>


                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                        <div class="gdlr-core-pbf-element">
                            <div class="tourmaster-room-search-item tourmaster-item-pdlr clearfix">
                                
                                <form class="tourmaster-room-search-form tourmaster-radius-normal tourmaster-style-text-top tourmaster-align-horizontal" action="{{ url('checkout') }}" method="get">

                                    <div class="tourmaster-room-search-size10">
                                        <div class="tourmaster-room-date-selection tourmaster-horizontal" data-avail-date="">
                                            <div class="tourmaster-custom-start-date">
                                                <div class="tourmaster-head gdlr-core-skin-content">Check In</div>
                                                <div class="tourmaster-tail gdlr-core-skin-e-background gdlr-core-skin-e-content">{{ Carbon::tomorrow()->format('d-m-Y') }}</div>
                                                <input type="hidden" name="start_date" value="{{ Carbon::tomorrow()->format('Y-m-d') }}" />
                                            </div>
                                            <div class="tourmaster-custom-end-date">
                                                <div class="tourmaster-head gdlr-core-skin-content">Check Out</div>
                                                <div class="tourmaster-tail gdlr-core-skin-e-background gdlr-core-skin-e-content">{{ Carbon::tomorrow()->addDays(1)->format('d-m-Y') }}</div>
                                                <input type="hidden" name="end_date" value="2020-07-29" />
                                            </div>
                                            <div class="tourmaster-custom-datepicker-wrap" data-date-format="d M yy">
                                                <i class="tourmaster-custom-datepicker-close icon_close"></i>
                                                <div class="tourmaster-custom-datepicker-title"></div>
                                                <div class="tourmaster-custom-datepicker-calendar"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tourmaster-room-search-size5">
                                        <div class="tourmaster-room-amount-selection">
                                            <div class="tourmaster-custom-amount-display">
                                                <div class="tourmaster-head gdlr-core-skin-content">Viajeros</div>
                                                <div class="tourmaster-tail gdlr-core-skin-e-background gdlr-core-skin-e-content">
                                                    <span class="tourmaster-space"></span>Huéspedes 2<span class="tourmaster-space"></span>
                                                </div>
                                            </div>
                                            <div class="tourmaster-custom-amount-selection-wrap">
                                                <div class="tourmaster-custom-amount-selection-item clearfix" data-label="Adults">
                                                    <div class="tourmaster-head">Huéspedes</div>
                                                    <div class="tourmaster-tail">
                                                        <span class="tourmaster-minus"><i class="icon_minus-06"></i></span><span class="tourmaster-amount">2</span>
                                                        <span class="tourmaster-plus"><i class="icon_plus"></i></span>
                                                    </div>
                                                    <input type="hidden" name="adult" value="2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tourmaster-room-search-size4 tourmaster-room-search-submit-wrap">
                                        <input class="tourmaster-room-search-submit tourmaster-style-solid" type="submit" value="Buscar" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


    </div>    
</div> 
</div> 

@endsection

@section('page-js-script')

    <script type="text/javascript" id="jquery-ui-datepicker-js-after">
        jQuery(function (jQuery) {

            jQuery.datepicker.setDefaults({
                closeText: "Cerrar",
                currentText: "Hoy",
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                nextText: "Next",
                prevText: "Previous",
                dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
                dateFormat: "M d, yy",
                firstDay: 1,
                isRTL: false,
            });
        });

    </script>

@stop



