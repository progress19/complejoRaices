@extends('layouts.frontLayout.front')
@section('title', 'Reserva')    

@section('content')


<div class="hotale-page-wrapper" id="hotale-page-wrapper">
    <div class="gdlr-core-page-builder-body">

        <div class="gdlr-core-pbf-wrapper" style="padding: 20px 0px 0px 0px;" id="gdlr-core-wrapper-3">

            <div class="gdlr-core-pbf-background-wrap"></div>

            <div class="gdlr-core-pbf-background-wrap" style="top: 50px;">
                <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" style="background-image: url( https://localhost/raices/public/images/apartment2-column-bg.png ); background-repeat: no-repeat; background-position: top center;" data-parallax-speed="0">
                </div>
            </div>

            <div class="conte-buscador" style="color:#1c1c1c">

                <h3 class="gdlr-core-title-item-title gdlr-core-skin-title class-test" style="font-size: 30px; font-weight: 700; letter-spacing: 0px; line-height: 1; text-transform: none;text-align: center;">DATOS DE LA RESERVA
                </h3>

                <div class="container" style="text-align:center;color:#1c1c1c">
                    {!! $texto !!}                    
                </div>

            </div>


        </div>    
    </div> 
</div> 

@endsection

@section('page-js-script')

@stop

