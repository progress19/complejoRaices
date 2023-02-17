@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-8">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-building"></i> Apartamentos /<small>Lista</small></h2>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">

                  <table class="hover table table-striped table-bordered dt-responsive nowrap" id="table" style="width:100%">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Ocupación</th>
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
        /*serverSide: true,*/
        order: [[ 0, "asc" ]], 
        ajax: '{!! route('dataApartamentos') !!}',
        columns: [

            {data: 'nombre', sortable : true,name: 'nombre'},
            {data: 'ocupacion', sortable : true,name: 'ocupacion',className: 'dt-body-center'},
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



