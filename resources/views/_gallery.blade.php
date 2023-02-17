<!-- GALLERY  -->
<div class="gdlr-core-pbf-wrapper" style="padding: 35px 0 30px 0;" id="gdlr-core-wrapper-4">
    <div class="gdlr-core-pbf-background-wrap"></div>
    <div class="gdlr-core-pbf-background-wrap" style="top: 65px;">
        <div
            class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js"
            style="background-image: url( {{ asset('images/apartment2-gallery-bg.png') }} ); background-repeat: no-repeat; background-position: top center;"
            data-parallax-speed="0"
        ></div>
    </div>

    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full">
            
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" id="gdlr-core-column-11">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="padding: 0px 0px 30px 0px;">
                    <div class="gdlr-core-pbf-background-wrap"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js" style="max-width: 580px;">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                <div class="gdlr-core-title-item-title-wrap">
                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title class-test" style="font-size: 45px; font-weight: 700; letter-spacing: 0px; line-height: 1; text-transform: none;">Galería<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span>
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

                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-center-align">
                                <a class="gdlr-core-button gdlr-core-button-transparent gdlr-core-center-align gdlr-core-button-no-border" href="#" style="font-size: 13px; font-style: normal; font-weight: 600; letter-spacing: 4px; color: #000000; text-transform: uppercase;">
                                    <span class="gdlr-core-content"><i class="gdlr-core-pos-left fa fa-instagram" style="font-size: 21px;"></i>Seguinos en Instagram</span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" id="gdlr-core-column-12">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js" style="margin: 0px -70px 0px -70px;">
                    <div class="gdlr-core-pbf-background-wrap"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js">
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-gallery-item gdlr-core-item-pdb clearfix gdlr-core-gallery-item-style-grid gdlr-core-item-pdlr" id="gdlr-core-gallery-1">
                                <div class="gdlr-core-flexslider flexslider gdlr-core-js-2" data-type="carousel" data-column="3" data-move="1" data-nav="navigation-inner" data-nav-parent="self" data-margin="20px">
                                    
                                    <div class="gdlr-core-flexslider-custom-nav gdlr-core-style-navigation-inner gdlr-core-center-align gdlr-core-show-on-hover">
                                        <i class="icon-arrow-left flex-prev" style="color: #7a7a7a; background-color: #ffffff;padding: 20px 20px 20px 20px;border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;font-size: 22px;margin-top: -11px;left: 50px;">
                                        </i>
                                        <i class="icon-arrow-right flex-next" style="color: #7a7a7a;background-color: #ffffff;padding: 20px 20px 20px 20px;border-radius: 0px;-moz-border-radius: 0px;-webkit-border-radius: 0px;font-size: 22px;margin-top: -11px;right: 50px;">
                                        </i>
                                    </div>

                                    <ul class="slides">
                                        
                                        @for ($i = 1; $i < 32; $i++)
                                
                                            <li class="gdlr-core-item-mglr">
                                                <div class="gdlr-core-gallery-list gdlr-core-media-image">
                                                    <a class="gdlr-core-lightgallery gdlr-core-js" href="{{ asset('images/galeria/'.$i.'.jpg') }}" data-lightbox-group="gdlr-core-img-group-1">
                                                        <img src="{{ asset('images/galeria/'.$i.'.jpg') }}" alt="" width="1000" height="670" title=""/>
                                                    </a>
                                                </div>
                                            </li>

                                        @endfor

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>