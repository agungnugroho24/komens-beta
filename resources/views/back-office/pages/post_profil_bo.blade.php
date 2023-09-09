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
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">
											<a href="{{ route('profil.create') }}">
												<button class="btn btn-secondary btn-round btn-sm ml-auto">
													<i class="fas fa-plus-circle" style="font-size:14px;"></i>
													&nbsp;<span style="font-weight:bold;">Tambah Data</span>
												</button>
											</a>
										</h4>
									</div>
								</div>
								<div class="card-body">
				          <div class="table-responsive">
				            <table class="table table-striped" id="table_post">
				              <thead>
				                <tr>
				                  <th class="text-center details-data" rowspan="2"></th>
				                  <th rowspan="2">Judul</th>
				                  <th rowspan="2">Penulis</th>
				                  <th rowspan="2">Kategori</th>
				                  <th rowspan="2">Status Post</th>
				                  <!-- <th rowspan="2">Jenis Post</th> -->
				                  <!-- <th rowspan="2">Dipublish Pada</th> -->
				                  <th colspan="3" class="text-center">Action</th>
				                </tr>
				                <tr>
				                    <th class="text-center">Publish</th>
				                    <th class="text-center">Update</th>
				                    <th class="text-center">Delete</th>
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
				                  <td><div class="badge badge-success"></div></td>
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
@endsection

@push('app-script')
<script>
function format(data) {
  return '<table cellpadding="10" cellspacing="0" width="100%" border="0" style="margin-left:0px;">'+
              '<tr style="font-weight:bold;">'+
                  '<td width="20%">&nbsp;Dibuat Pada Tanggal</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.created_at+'</td>'+
              '</tr>'+
              '<tr style="font-weight:bold;">'+
                  '<td width="20%">&nbsp;Diperbarui Pada Tanggal</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.updated_at+'</td>'+
              '</tr>'+   
              '<tr style="font-weight:bold;">'+
                  '<td width="20%">&nbsp;Dipublikasikan Pada Tanggal</td>'+
                  '<td width="2%">:</td>'+
                  '<td>'+data.published_at+'</td>'+
              '</tr>'+               
              '<tr>'+
                  '<td width="20%" style="font-weight:bold;">&nbsp;Konten</td>'+
                  '<td width="2%" style="font-weight:bold;">:</td>'+
                  '<td>'+data.konten+'</td>'+
              '</tr>'+                                                                                 
          '</table>';

}  

$(document).ready(function() {
  var table = $('#table_post').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ url('back-office/json/profil') }}',
      columnDefs: [
          {
              "targets": [ 0 ],
              "data": null,
              "orderable": false,
              "width": "30px",
              "className": 'dt-center',
              "defaultContent": "<button class='details-data' title='data-detail'></button>",
          },
          {
              "targets": [ 1 ], 
              "visible": true,
              "width": "300px",
              "searchable": true
          },        
          {
              "targets": [ 2 ], 
              "visible": true,
              "width": "100px",
              "searchable": true,
              "defaultContent": "",
          },    
          {
              "targets": [ 3 ], 
              "visible": true,
              "width": "100px",
              "searchable": true
          },               
          {
              "targets": [ 4 ], 
              "visible": true,
              "width": "80px",
              "searchable": true,
              "className": 'dt-justify',
              "render": function(data){
                  var status = data;
                  if(data){
                    return '<span style="font-weight:bold;color:#19a3d1;">Published</span>';
                  }else{
                    return '<span style="font-weight:bold;color:#d65c33;">Unpublished</span>';
                  }
              },
          },                      
          {
              "targets": [ -3 ], 
              "visible": true,
              "searchable": false,
              "width": "30px",
              "className": 'dt-center',
              "orderable": false,
          },                         
          {
              "targets": [ -2 ], 
              "visible": true,
              "searchable": false,
              "width": "30px",
              "className": 'dt-center',
              "orderable": false,
          }, 
          {
              "targets": [ -1 ], 
              "visible": true,
              "searchable": false,
              "width": "30px",
              "className": 'dt-center',
              "orderable": false,
          },                                                            
      ],        
      columns: [
          { "data": "" },
          { "data": "judul" },
          { "data": "name" },
          { "data": "kategori" },
          { "data": "is_publish" },
          { "data": "publish" },
          { "data": "update" },
          { "data": "delete" },
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

