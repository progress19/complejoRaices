@php
  use App\Fun;
  use App\Fecha;
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-building"></i> Ocupación {{ $apartamento->nombre }} </h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">

                  <div class="clearfix"></div>

                  <br>

                	<div class="datespicker"></div>
                  <br><br>

                  <span class="dateDisponible" style="padding: 10px;margin-right: 15px;">Días disponibles</span>
                  <span class="dateOcupado" style="padding: 10px">Días ocupados</span>
            
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

@endsection


<?php  

   $disponibles = Fecha::getFechasOcupacion( $apartamento->id, 0 ); //id , tipo (0=disponible, 1=ocupada)
   $ocupadas = Fecha::getFechasOcupacion( $apartamento->id, 1 ); //id , tipo (0=disponible, 1=ocupada)

?>

@section('page-js-script')
  
  @if (session('flash_message'))
    <script>toast('{!! session('flash_message') !!}');</script>
  @endif

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
         
    $('.datespicker').datepicker({
        beforeShowDay: checkAvailability,
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        startDate: '1d',
        numberOfMonths: 4,
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
        dayNamesShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        dayNamesMin: ["D", "L", "M", "M", "J", "V", "S"],
    });



   function checkAvailability( mydate ) {
     
     var $disponibles = <?php echo json_encode($disponibles);?> 
     var $ocupadas = <?php echo json_encode($ocupadas);?> 
     
     //alert(mydate);
     
     var $return = true;
     
     //var $returnclass = 'available';
     var $returnclass = '';
     
     $checkdate = $.datepicker.formatDate( 'yy-mm-dd', mydate );
     
     for( var i = 0; i < $disponibles.length; i++ ) { 
         if( $disponibles[i] == $checkdate ) {
            $return = true;
            $returnclass = 'dateDisponible';
         }
      }

      for( var i = 0; i < $ocupadas.length; i++ ) { 
         if( $ocupadas[i] == $checkdate ) {
            $return = true;
            $returnclass = 'dateOcupado';
         }
      }
     
     return [ $return, $returnclass ];
   
   }

</script>

@stop

<style>
  
   .dateDisponible { 
      background: #3a78ff !important;
      opacity: 1 !important;
      color : white !important;      
   }

   .dateOcupado { 
      background: red !important;
      opacity: 1 !important;
      color : white !important;  
   }

   .ui-state-default {
      background: transparent !important;
      color : white !important;
      border: 0px solid #c5c5c5 !important;
   }

   .ui-datepicker td span, .ui-datepicker td a {
     padding: 12px;

   }

   .ui-datepicker.ui-datepicker-multi {
     width: auto !important;
   }

   .ui-widget.ui-widget-content {
      border: 1px solid #c5c5c5;
      background-color: darkslategray;
   }

   .ui-widget {
      font-family: 'Poppins', sans-serif;
   }

  .ui-datepicker-header {
    padding: 1.2em 0 !important;
   }

   .ui-widget-header {
      border: 0px solid #ddd !important;
      color: white !important;
      background: #1f2028;
   }
  
   .ui-datepicker th {
      color: darksalmon;
   }

</style>

