<? 
use Carbon\Carbon; 
?>

<div class="gdlr-core-pbf-wrapper" style="margin: -90px auto 0px auto; padding: 5px 0px 5px 0px; max-width: 920px;">
    <div class="gdlr-core-pbf-background-wrap" style="box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); -moz-box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); -webkit-box-shadow: 0px 30px 70px rgba(44, 45, 57, 0.2); border-radius: 20px 20px 20px 20px;-moz-border-radius: 20px 20px 20px 20px;-webkit-border-radius: 20px 20px 20px 20px; background-color: #ffffff;">                            
    </div>
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container-custom">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" data-skin="Green Button" id="gdlr-core-column-3">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="margin: 0px 0px 0px 0px; padding: 20px 10px 0px 10px;">
                    <div class="gdlr-core-pbf-background-wrap"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                        <div class="gdlr-core-pbf-element">
                            <div class="tourmaster-room-search-item tourmaster-item-pdlr clearfix">
                                
                                <form class="tourmaster-room-search-form tourmaster-radius-normal tourmaster-style-text-top tourmaster-align-horizontal" action="{{ url('checkout') }}" method="get"
                                >

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
                                                <div class="tourmaster-custom-amount-selection-item clearfix" data-label="Huéspedes">
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