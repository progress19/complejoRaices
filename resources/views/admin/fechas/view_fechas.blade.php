@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-calendar"></i> Fechas habilitadas para reservas/<small>Lista</small></h2>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">

                  <table class="hover table table-striped table-bordered dt-responsive nowrap" id="table" style="width:100%">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Fecha</th>
                        <th>Apartamento</th>
                        <th>Tarifa x 2</th>
                        <th>Tarifa x 3</th>
                        <th>Tarifa x 4</th>
                        <th>Tarifa x 5</th>
                        <th>Tarifa x 6</th>
                        <th>Estado</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>

                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

@endsection

@section('page-js-script')
  @if (session('flash_message'))
    <script>toast('{!! session('flash_message') !!}');</script>
  @endif

<script>

$(function() {
    $('#table').DataTable({
        processing: true,
       // serverSide: true,
        pageLength: 100,
        ajax: '{!! route('dataFechas') !!}',
        order: [[ 0, "desc" ]], 
        columns: [

            {data: 'id', sortable : true, className: 'dt-body-right'},
            
            {data: 'fecha', sortable : true, className: 'dt-body-right'},
            {data: 'apartamento', sortable : true, className: 'dt-body-right'},
            {data: 't2', sortable : true, className: 'dt-body-right'},
            {data: 't3', sortable : true, className: 'dt-body-right'},
            {data: 't4', sortable : true, className: 'dt-body-right'},
            {data: 't5', sortable : true, className: 'dt-body-right'},
            {data: 't6', sortable : true, className: 'dt-body-right'},
            {data: 'estado', orderable: false, searchable: false, className: 'dt-body-center'},
            {data: 'acciones',title: '', orderable: false, searchable: false, className: 'dt-body-center'},
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
    });
});


$(document).ready(function() {
    $('#table tbody').on( 'click', '.delReg', function () {
    if (confirm('Está seguro de eliminar el registro ?')) {
        return true;
    }
    return false;
    });
});

</script>

@stop



