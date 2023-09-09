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
						<a href="{{ route('post-aduansiber') }}" title="kembali ke halaman post aduan siber">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post aduan siber</span>
					</div>
				</div>

				<form id="form-input" action="{{ route('aduansiber.update',  $data->id_aduansiber) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT') 
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label for="judul">Judul</label>
										<div>
											<input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Judul" value="{{ old('judul', $data->judul) }}">
											<input id="updated_by" type="hidden" class="form-control" name="updated_by" value="{{ $UIDuser }}">
			                @error('judul')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 										
										</div>
									</div>
<!-- 									<div class="form-group">
										<label for="kategori">Kategori</label>
										<div> 										
										</div>
									</div> -->
									<div class="form-group">
										<label for="konten">Konten</label>
										<div>
											<textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="5">{{ old('konten', $data->konten) }}</textarea>
			                @error('konten')
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

	CKEDITOR.replace( 'konten', options );
</script>
@endpush

