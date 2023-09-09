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
						<a href="{{ route('post-berita') }}" title="kembali ke halaman post berita">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post berita</span>
					</div>
				</div>

				<form id="form-input" action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12">
									<div class="form-group">
										<label for="judul">Judul</label>
										<div>
											<input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Judul" value="{{ old('judul') }}">
											<input id="created_by" type="hidden" class="form-control" name="created_by" value="{{ $UIDuser }}">
			                @error('judul')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
									</div>
									<div class="form-group">
										<label for="konten">Konten</label>
										<div>
											<textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="5">{{ old('konten') }}</textarea>
			                @error('konten')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
									</div>
									<div class="form-group">
										<label for="konten">Deskripsi</label>
										<div>
											<textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
			                @error('deskripsi')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
									</div>									
									<div class="form-group">
										<label for="thumbnail">Thumbnail</label>
										<div>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text btn btn-primary btn-border">
													 <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary" style="color:#f9f9f9;">
													   <i class="far fa-images"></i> Buka File Manager
													 </a>
													</span>													
												</div>
												<textarea class="form-control @error('thumbnail') is-invalid @enderror" aria-label="With textarea" id="thumbnail" name="thumbnail">{{ old('thumbnail') }}</textarea>
											</div>
			                @error('thumbnail')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
										<div class="input-group">
											<div style="margin-right: 1%;">
												<small class="form-text text-muted"><span class="btn btn-label btn-danger btn-xs">NOTE.!</span></small>												
											</div>
											<div>
												<small class="form-text text-muted">
													<li class="fas fa-hand-point-right text-info"></li>&nbsp;&nbsp;file thumbnail harus berformat <b>JPG</b> , <b>JPEG</b> , <b>PNG</b>.
												</small>
												<small class="form-text text-muted">
													<li class="fas fa-hand-point-right text-info"></li>&nbsp;&nbsp;ukuran file thumbnail yang direkomendasikan <b>Width</b>(lebar) x <b>Height</b>(tinggi) = 800px * 600px.
												</small>												
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="judul">Teks Thumbnail</label>
										<div>
											<input type="text" class="form-control @error('teks_thumbnail') is-invalid @enderror" id="teks_thumbnail" name="teks_thumbnail" placeholder="Teks Thumbnail" value="{{ old('teks_thumbnail') }}">
			                @error('teks_thumbnail')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
									</div>									
									<!---->
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
    filebrowserImageBrowseUrl: '/csirt-web/back-office/CSIRT-Bappenas-File-Manager?type=Images',
    filebrowserImageUploadUrl: '/csirt-web/back-office/CSIRT-Bappenas-File-Manager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/csirt-web/back-office/CSIRT-Bappenas-File-Manager?type=Files',
    filebrowserUploadUrl: '/csirt-web/back-office/CSIRT-Bappenas-File-Manager/upload?type=Files&_token='
  };

	CKEDITOR.replace( 'konten', options );

	var route_prefix = "/csirt-web/back-office/CSIRT-Bappenas-File-Manager";
	$('#lfm').filemanager('image', {prefix: route_prefix});
</script>
@endpush

