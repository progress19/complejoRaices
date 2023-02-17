<?php use App\Fun; ?>
@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-8">
        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-clock-o"></i> Turnos /<small>Editar</small></h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {{ Form::open([
              'id' => 'edit_turno',
              'name' => 'edit_turno',
              'url' => '/admin/edit-turno/'.$turno->id,
              'role' => 'form',
              'method' => 'post',
              'files' => true]) }}

              <div class="col-md-7">
                <div class="form-group">
                  {!! Form::label('texto', 'Texto') !!}
                  {!! Form::text('texto', $turno->texto, ['id' => 'texto', 'class' => 'form-control']) !!}
                </div>
              </div>

              <div class="clearfix"></div>
              
              <div class="col-md-3">
                <div class="form-group">
                  {!! Form::label('estado', 'Estado') !!}
                  {!! Form::select('estado', array('1' => 'Activado', '0' => 'Desactivado'), $turno->estado, ['id' => 'estado', 'class' => 'form-control']); !!}
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
    
  </script>

@stop

