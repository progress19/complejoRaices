<?php 
  use App\Fun;
  use App\Fecha;
?>

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Eliminación masiva de fechas /<small>Nueva</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'del_fechas',
              'name' => 'del_fechas',
              'url' => '/admin/eliminar-fechas/',
              'role' => 'form',
              'method' => 'post',
              'files' => true]) 
            }}

              <div class="col-md-12">
                <i class="fa fa-exclamation-circle"></i> Atención : El intervalo que seleccione, ELIMINARÁ en caso de coincidencia, las fechas y tarifas existentes.    
              </div><br>

              <div class="clearfix"></div><br>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('desde', 'Desde') !!}
                  {!! Form::text('desde', null, ['id' => 'desde', 'class' => 'form-control datespicker']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('hasta', 'Hasta') !!}
                  {!! Form::text('hasta', null, ['id' => 'hasta', 'class' => 'form-control datespicker']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('Apartamento', 'Apartamento') !!}
                  {!! Form::select('idApartamento', $apartamentos, null, ['id' => 'idApartamento', 'placeholder' => 'Seleccione Apartamento...', 'class' => 'form-control select2'])!!}
                </div>
              </div>

              <div class="clearfix"></div>

                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-success pull-right">Eliminar</button>
              </div>

            {!! Form::close() !!}

          </div>
        </div>
      </div>

@endsection

@section('page-js-script')

  <script>
    
    $('.datespicker').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        //endDate: '+7d',
        startDate: '1d',
        //defaultViewDate: { year: 1977, month: 04, day: 25 }
    });

  </script>

@stop

