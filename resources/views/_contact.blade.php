<!-- CONTACT  -->
<div class="gdlr-core-pbf-wrapper" id="contact" style="padding: 30px 0 35px 0;">
    <div class="gdlr-core-pbf-background-wrap" style="background-color: #ffffff;"></div>
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
            <div class="gdlr-core-pbf-column gdlr-core-column-60 gdlr-core-column-first" data-skin="Contact Field" id="gdlr-core-column-4">
                <div class="gdlr-core-pbf-column-content-margin gdlr-core-js">
                    <div class="gdlr-core-pbf-background-wrap"></div>
                    <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js" style="max-width: 760px;">
                        <div class="gdlr-core-pbf-element">

                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix gdlr-core-center-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr">
                                <div class="gdlr-core-title-item-title-wrap">
                                    <h3 class="gdlr-core-title-item-title gdlr-core-skin-title class-test" style="font-size: 45px; font-weight: 700; letter-spacing: 0px; line-height: 1; text-transform: none;">
                                        Contacto<span class="gdlr-core-title-item-title-divider gdlr-core-skin-divider"></span>
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

                        </div>
                        <div class="gdlr-core-pbf-element">
                            <div class="gdlr-core-contact-form-7-item gdlr-core-item-pdlr gdlr-core-item-pdb">
                                <div role="form" class="wpcf7" id="wpcf7-f1979-p1964-o1" lang="en-US" dir="ltr">
                                    <div class="screen-reader-response">
                                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                                        <ul></ul>
                                    </div>
                                    
                            <div id="responseContacto" style="display: none;"></div>

                            {{ Form::open(array('id' => 'frmContacto', 'role' => 'form')) }}

                                <div class="row">
                                
                                    {!! Form::text('nombre', null, ['id' => 'nombreForm', 'class' => 'input', 'placeholder' => 'Nombre:']) !!}
                                    {!! Form::email('email', null, ['id' => 'emailForm', 'class' => 'input', 'placeholder' => 'Email:']) !!}
                                    {!! Form::text('telefono', null, ['id' => 'telefonoForm', 'class' => 'input', 'placeholder' => 'Teléfono / Móvil:']) !!}
                                    {!! Form::textarea('comentario', null, ['id' => 'comentarioForm', 'class' => 'input', 'rows' => 5, 'cols' => 40, 'placeholder' => 'Mensaje:']) !!}
                                    
                                    <input type="submit" name="submit" value="ENVIAR" class="submit-button" style="margin-top: 15px;" />
                                              
                                </div>

                                {{ Form::hidden('baseUrl', url('/'), array('id' => 'baseUrl')) }}

                                {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                        <p style="text-align: center;"><i class="icon_compass"></i> <a href="https://goo.gl/maps/t1L2Yh2d5iah2qmv9" target="new"> Juárez Celman 2800 (entre Ameghino y Dr. Maradona) San Rafael - Mendoza - Argentina</a> </p>
                        <p style="text-align: center;"><i class="icon_phone"></i> <a href="tel:2604-400282">2604-400282 | 2604-408749</a></p>
                        <p style="text-align: center;"><i class="icon_mail"></i> <a href="mailto:complejoraices.com.ar">info@complejoraices.com.ar</a></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gdlr-core-pbf-wrapper" style="padding: 0px 0px 0px 0px;">
    <div class="gdlr-core-pbf-background-wrap"></div>
    <div class="gdlr-core-pbf-wrapper-content gdlr-core-js">
        <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-pbf-wrapper-full-no-space">
            <div class="gdlr-core-pbf-element">
                <div class="gdlr-core-wp-google-map-plugin-item gdlr-core-item-pdlr gdlr-core-item-pdb" style="padding-bottom: 0px;">
                    <div class="wpgmp_map_container wpgmp-map-1" rel="map1">

                     <div id="google-map"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>