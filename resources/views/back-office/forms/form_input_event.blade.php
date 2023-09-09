@extends('back-office.layouts.master2')

@section('title')
 {{ $title }}
@overwrite

@section('top-panel-page')
  <x-panel-top-page-back-office />
@endsection

@section('panel-header')
	<x-panel-header-form-back-office :pagestitle="$pagestitle"/>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<a href="{{ route('post-event') }}" title="kembali ke halaman post event">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post event</span>
					</div>
				</div>

				<form id="form-input" action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label for="judul_acara">Acara</label>
										<div>
											<input type="text" class="form-control @error('judul_acara') is-invalid @enderror" id="judul_acara" name="judul_acara" placeholder="Acara" value="{{ old('judul_acara') }}">
											<input id="created_by" type="hidden" class="form-control" name="created_by" value="{{ $UIDuser }}">
			                @error('judul_acara')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>										
									</div>
									<div class="form-group">
										<label for="tempat">Tempat</label>
										<div>
											<input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" placeholder="Tempat" value="{{ old('tempat') }}">
			                @error('tempat')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>										
									</div>
									<div class="form-group">
										<label for="tanggal_mulai">Tanggal Mulai</label>
                    <div>
                      <div class="mb-3 date-mulai input-group">
                          <input id="tanggal_mulai" type="text" class="form-control input-medium default-date-picker" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" autocomplete="off" placeholder="Waktu Mulai"  aria-describedby="date-addon2">
                          <div class="input-group-append">
                              <span class="input-group-text" id="date-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                          </div>                                            
                      </div>  
			                @error('tanggal_mulai')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror                                                         
                    </div> 
									</div>	
									<div class="form-group">
										<label for="tanggal_selesai">Tanggal Selesai</label>
                    <div>
                      <div class="mb-3 date-selesai input-group">
                          <input id="tanggal_selesai" type="text" class="form-control input-medium default-date-picker" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" autocomplete="off" placeholder="Waktu Selesai"  aria-describedby="date-addon3">
                          <div class="input-group-append">
                              <span class="input-group-text" id="date-addon3"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                          </div>                                            
                      </div>  
			                @error('tanggal_selesai')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror                                                         
                    </div> 
									</div>			
									<div class="form-group">
										<label for="materi">Materi</label>
										<div>
											<textarea class="form-control @error('materi') is-invalid @enderror" id="materi" name="materi" rows="5">{{ old('materi') }}</textarea>
			                @error('materi')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>										
									</div>
								</div>
							</div>
						</div>
						<div class="card-action">
							<button type="submit" class="btn btn-success">Submit</button>
							<!-- <button class="btn btn-danger">Cancel</button> -->
						</div>
				</form>

			</div>
		</div>
	</div>
@endsection

@push('app-script')
<script>
  var options = {
    filebrowserImageBrowseUrl: '/back-office/CSIRT-Bappenas-File-Manager?type=Images',
    filebrowserImageUploadUrl: '/back-office/CSIRT-Bappenas-File-Manager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/back-office/CSIRT-Bappenas-File-Manager?type=Files',
    filebrowserUploadUrl: '/back-office/CSIRT-Bappenas-File-Manager/upload?type=Files&_token='
  };

	CKEDITOR.replace( 'materi', options );

	$('.date-mulai input').datepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
	    orientation: 'bottom left',
	});	

$('.date-selesai input').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    orientation: 'bottom left',
});		
</script>
@endpush

