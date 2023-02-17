<? use App\Fun; ?>

@extends('layouts.frontLayout.front')
@section('title', 'Home')    
@section('content')

<div class="hotale-page-wrapper" id="hotale-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        @include('_welcome')	            
		@include('_search')
        @include('_our')
		@include('_why')
        @include('_gallery')
        @include('_contact')
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
                //minDate: "01/01/2022"
                firstDay: "1",
                //isRTL: false,
            });
        });

    </script>

@stop

