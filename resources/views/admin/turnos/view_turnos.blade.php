@php
  use App\Fun;
@endphp

@extends('layouts.adminLayout.admin_design')
@section('content')

      <div class="col-md-6 col-sm-6">
        <div class="x_panel">

          <div class="x_title">
            <h2><i class="fa fa-clock-o"></i> Turnos/<small>Lista</small></h2>

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
                        <th>Texto</th>
                        <th>Estado</th>
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
        pageLength: 30,
        ajax: '{!! route('dataTurnos') !!}',
       columns: [
            {data: 'id', className: 'dt-body-right'},
            {data: 'texto', sortable : true, className: 'dt-body-left'},
            {data: 'estado', orderable: false, searchable: false, className: 'dt-body-center'},
        ],

        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
    });
});


</script>

@stop



