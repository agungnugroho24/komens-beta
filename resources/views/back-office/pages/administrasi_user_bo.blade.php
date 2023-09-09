@extends('back-office.layouts.master2')

@section('title')
 {{ $title }}
@overwrite

@push('app-styles')
  <x-css-back-office/>
@endpush

@section('top-panel-page')
  <x-panel-top-page-back-office />
@endsection

@section('panel-header')
  <x-panel-header-page-back-office :segment="$segment"/>
@endsection

@section('content')
					<div class="row">
						<div class="col-md-12">
							<div class="card">
			<!-- 					<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">
										</h4>
									</div>
								</div> -->
								<div class="card-body">
				          <div class="table-responsive">
				            <table class="table table-striped" id="table_post">
				              <thead>
				                <tr>
				                  <th class="text-center details-data" rowspan="2"></th>
				                  <th rowspan="2">Nama</th>
				                  <th rowspan="2">Unit Kerja</th>
				                  <th rowspan="2">Status Approve</th>
				                  <th rowspan="2">Status Active</th>
				                  <!-- <th rowspan="2">Jenis Post</th> -->
				                  <!-- <th rowspan="2">Dipublish Pada</th> -->
				                  <th colspan="2" class="text-center">Action</th>
				                </tr>
				                <tr>
				                    <th class="text-center">Approved</th>
				                    <th class="text-center">Active</th>
				                    <!-- <th class="text-center">Delete</th> -->
				                </tr>                
				              </thead>
				              <tbody>
				                <tr>
				                  <td></td>
				                  <td></td>
				                  <td class="align-middle"></td>
				                  <td></td>
				                  <!-- <td></td> -->
				                  <!-- <td></td> -->
				                  <!-- <td></td> -->
				                  <td><div class="badge badge-success"></div></td>
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
@endsection

@push('app-script')
<script>
function format(data) {
  return '<table cellpadding="10" cellspacing="0" width="100%" border="0" style="margin-left:0px;">'+
              '<tr style="font-weight:bold;">'+
                  '<td width="15%">&nbsp;ID Unit Kerja</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.iduke+'</td>'+
              '</tr>'+
              '<tr style="font-weight:bold;">'+
                  '<td width="15%">&nbsp;Jabatan</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.jabatan+'</td>'+
              '</tr>'+   
              '<tr style="font-weight:bold;">'+
                  '<td width="15%">&nbsp;Email</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.email+'</td>'+
              '</tr>'+                                                                                 
          '</table>';

}  

$(document).ready(function() {
  var table = $('#table_post').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ url('back-office/json/administrasi-user') }}',
      columnDefs: [
          {
              "targets": [ 0 ],
              "data": null,
              "orderable": false,
              "className": 'dt-center',
              "defaultContent": "<button class='details-data' title='data-detail'></button>",
          },
          {
              "targets": [ 1 ], 
              "visible": true,
              "width": "120px",
              "searchable": true
          },        
          {
              "targets": [ 2 ], 
              "visible": true,
              "width": "100px",
              // "searchable": true,
              "defaultContent": "",
          },    
          {
              "targets": [ 3 ], 
              "visible": true,
              "searchable": true,
              "className": 'dt-justify',
              "render": function(data){
                  var status = data;
                  if(data == 200){
                    return '<span style="font-weight:bold;color:#19a3d1;">Approved</span>';
                  }else{
                    return '<span style="font-weight:bold;color:#d65c33;">Not Approved</span>';
                  }
              },              
          },               
          {
              "targets": [ 4 ], 
              "visible": true,
              "searchable": true,
              "className": 'dt-justify',
              "render": function(data){
                  var status = data;
                  if(data == 200){
                    return '<span style="font-weight:bold;color:#19a3d1;">Active</span>';
                  }else{
                    return '<span style="font-weight:bold;color:#d65c33;">Deactive</span>';
                  }
              },
          },                                               
          {
              "targets": [ -2 ], 
              "visible": true,
              "searchable": false,
              "width": "50px",
              "className": 'dt-center',
              "orderable": false,
          }, 
          {
              "targets": [ -1 ], 
              "visible": true,
              "searchable": false,
              "width": "50px",
              "className": 'dt-center',
              "orderable": false,
          },                                                            
      ],        
      columns: [
          { "data": "" },
          { "data": "name" },
          { "data": "nama_uke" },
          { "data": "is_approved" },
          { "data": "is_active" },
          { "data": "approved" },
          { "data": "active" },
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
          	console.log(url);
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

