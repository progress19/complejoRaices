@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-8">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Fechas /<small>Nuevo</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'add_fecha',
              'name' => 'add_fecha',
              'url' => '/admin/add-fecha/',
              'role' => 'form',
              'method' => 'post',
              'files' => true]) }}

              <div class="col-md-4">
                <div class="form-group">
                  {!! Form::label('fecha', 'Fecha') !!}
                  {!! Form::text('fecha', null, ['id' => 'fecha', 'class' => 'form-control datespicker']) !!}
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('t1', 'Cupo Turno (1)') !!}
                  {!! Form::number('t1', 0, ['id' => 't1', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('t2', 'Cupo Turno (2)') !!}
                  {!! Form::number('t2', 0, ['id' => 't2', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('t3', 'Cupo Turno (3)') !!}
                  {!! Form::number('t3', 0, ['id' => 't3', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('t4', 'Cupo Turno (4)') !!}
                  {!! Form::number('t4', 0, ['id' => 't4', 'class' => 'form-control']) !!}
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

