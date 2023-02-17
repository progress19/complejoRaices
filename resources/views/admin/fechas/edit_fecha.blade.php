<?php use App\Fun; ?>
@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-9">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Fechas /<small>Editar</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'edit_fecha',
              'name' => 'edit_fecha',
              'url' => '/admin/edit-fecha/'.$fecha->id,
              'role' => 'form',
              'method' => 'post',
              'files' => true]) }}

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('fecha', 'Fecha') !!}
                  {!! Form::text('fecha',  Carbon::parse($fecha->fecha)->format('d-m-Y'), ['id' => 'fecha', 'class' => 'form-control', 'readonly']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-4">
                  <div class="form-group">
                    {!! Form::label('Apartamento', 'Apartamento') !!}
                    {!! Form::text('idApartamento', $fecha->apartamento->nombre, ['id' => 'idApartamento', 'class' => 'form-control', 'readonly']) !!}
                  </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t2', 'Tarifa x 2') !!}
                  {!! Form::number('t2', $fecha->t2, ['id' => 't2', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t3', 'Tarifa x 3') !!}
                  {!! Form::number('t3', $fecha->t3, ['id' => 't3', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t4', 'Tarifa x 4') !!}
                  {!! Form::number('t4', $fecha->t4, ['id' => 't4', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t5', 'Tarifa x 5') !!}
                  {!! Form::number('t5', $fecha->t5, ['id' => 't5', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  {!! Form::label('t6', 'Tarifa x 6') !!}
                  {!! Form::number('t6', $fecha->t6, ['id' => 't6', 'class' => 'form-control']) !!}
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
        format: "d-m-yyyy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        //endDate: '+7d',
        startDate: '1d',
        //defaultViewDate: { year: 1977, month: 04, day: 25 }
    });

  </script>

@stop

