@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-shopping-cart"></i> Reservas /<small>Lista</small></h2>

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
                        <th>Registro</th>
                        <th>Titular</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Apartamento</th>
                        <th>Noches</th>
                        <th>Huéspedes</th>
                        <th>Total</th>
                        <th>Pago</th>
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
        //serverSide: true,
        ajax: '{!! route('dataReservas') !!}',
        order: [[ 0, "desc" ]], 
        pageLength: 30,
        columns: [

            {data: 'id', className: 'dt-body-right'},
            {data: 'fecha', className: 'dt-body-left'},
            {data: 'titular'},
            {data: 'desde', className: 'dt-body-right'},
            {data: 'hasta', className: 'dt-body-right'},
            {data: 'apartamento', className: 'dt-body-right'},
            {data: 'noches', className: 'dt-body-right'},
            {data: 'huespedes', className: 'dt-body-right'},
            {data: 'total_raw', className: 'dt-body-right'},
            {data: 'collection_status'},
            {data: 'estado', orderable: false, searchable: true, className: 'dt-body-center'},
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



