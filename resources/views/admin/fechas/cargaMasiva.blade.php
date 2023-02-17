<?php 
  use App\Fun;
  use App\Fecha;
?>

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Carga masiva de fechas disponibles /<small>Nueva</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'add_cargaMasiva',
              'name' => 'add_cargaMasiva',
              'url' => '/admin/carga-masiva/',
              'role' => 'form',
              'method' => 'post',
              'files' => true]) 
            }}

              <div class="col-md-12">
                <i class="fa fa-exclamation-circle"></i> Atención : El intervalo que seleccione, sobreescribirá en caso de coincidencia, las fechas y tarifas exitentes.    
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

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t2', 'Tarifa x 2') !!}
                  {!! Form::number('t2', null, ['id' => 't2', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t3', 'Tarifa x 3') !!}
                  {!! Form::number('t3', null, ['id' => 't3', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t4', 'Tarifa x 4') !!}
                  {!! Form::number('t4', null, ['id' => 't4', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t5', 'Tarifa x 5') !!}
                  {!! Form::number('t5', null, ['id' => 't5', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t6', 'Tarifa x 6') !!}
                  {!! Form::number('t6', null, ['id' => 't6', 'class' => 'form-control']) !!}
                </div>
              </div>

                <div class="col-md-12"><div class="ln_solid"></div>
                <button id="send" type="submit" class="btn btn-success pull-right">Guardar</button>
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

