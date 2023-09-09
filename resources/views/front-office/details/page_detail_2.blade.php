@extends('front-office.layouts.master')

@section('title')
 {{ $title }}
@overwrite

@push('app-styles')
<!-- Datatables Css -->
<link href="{{CSIRTHelper::csirt_asset('assets/general/datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  
<style type="text/css">
  table.dataTable td {
    font-size: 13px;
  }  

  table.dataTable th {
    font-size: 13.5px;
  }

  div.dataTables_wrapper{
    font-size: 13px;
  }  
</style>
@endpush

@section('navbar-header')
   @include('front-office.partials.navbar_header')
@endsection

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <div class="breadcrumbs-section-title" data-aos="fade-in" data-aos-delay="100">
            <h2>{{ $titlepage }}</h2>
          </div>          
          <ol>
            <li><a href="{{route('front-office')}}"><i style="font-size:17px;" class="fa fa-home"></i> Beranda</a></li>
            <li>{{ $titlepage }}</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-lg-12">
            <div class="row">
              <div class="col-md-9 col-lg-12 mb-5 mb-lg-0">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table_post">
                      <thead>
                        <tr>
                          <th>Acara</th>
                          <th>Tempat</th>
                          <th>Tanggal Mulai</th>
                          <th>Tanggal Akhir</th>
                          <th>Materi</th>
                        </tr>                
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>                
              </div>
            </div> 
          </div>
        </div>       
      </div>
    </section>

@endsection

@push('app-script')
<!-- Datatables -->
<script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/datatables/datatables.min.js')}}"></script>
<script>
$(document).ready(function() {
  var table = $('#table_post').DataTable({
      processing: true,
      serverSide: true,
      order: [],
      ajax: '{{ url('back-office/json/front-event') }}',
      columnDefs: [
          {
              "targets": [ 0 ],
              "data": null,
              "className": 'dt-head-center',
              "searchable": true,
          },
          {
              "targets": [ 1 ], 
              "visible": true,
              "className": 'dt-head-center',
              "width": "160px",
              "searchable": true,
          },        
          {
              "targets": [ 2 ], 
              "visible": true,
              "className": 'dt-head-center',
              "width": "110px",
              "searchable": true,
          },    
          {
              "targets": [ 3 ], 
              "visible": true,
              "width": "110px",
              "className": 'dt-head-center',
              "searchable": true,
          }, 
          {
              "targets": [ 4 ], 
              "visible": true,
              "className": 'dt-head-center',
              "searchable": true,
          },                                                                                    
      ],        
      columns: [
          { "data": "judul_acara" },
          { "data": "tempat" },
          { "data": "tanggal_mulai" },
          { "data": "tanggal_akhir" },
          { "data": "materi" },
      ],        
  });  

  //Add event listener for opening and closing details
  $('#table_post tbody').on('click', 'button.details-data', function () {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if ( row.child.isShown() ) {
          row.child.hide();         
          tr.removeClass('shown');
      }
      else {              
          row.child( format(row.data()) ).show();
          tr.addClass('shown');
      }

  });

  $('#table_post tbody').on('click', '.hard-delete-confirm', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
            // console.log(url);
      swal({
          title: 'Apakah anda yakin.?',
          text: 'Data ini akan dihapus secara permanen.!',
          icon: 'warning',
          buttons: ["Cancel", "Yes"],
      }).then(function(value) {
          if (value) {
              window.location.href = url;
          }
      });
  }); 


});  
  
</script>
@endpush

