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
						<a href="{{ route('post-layanan') }}" title="kembali ke halaman post layanan">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post layanan</span>
					</div>
				</div>

				<form id="form-input" action="{{ route('layanan.update', $data->id_layanan) }}" method="POST" enctype="multipart/form-data">
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
									<div class="form-group">
										<label for="kategori">Kategori</label>
										<div>
											<select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
												<option style="opacity:0.1;background-color:#e8f0f0;" value="">Pilih Kategori...</option>
												<option value="Layanan Bappenas CSIRT" @if (old('kategori') == "Layanan Bappenas CSIRT" || $data->kategori == "Layanan Bappenas CSIRT") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Layanan Bappenas CSIRT</option>
												<option value="Pedoman/Panduan Teknis" @if (old('kategori') == "Pedoman/Panduan Teknis" || $data->kategori == "Pedoman/Panduan Teknis") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Pedoman/Panduan Teknis</option>
												<option value="Tips Keamanan Siber" @if (old('kategori') == "Tips Keamanan Siber" || $data->kategori == "Tips Keamanan Siber") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Tips Keamanan Siber</option>
											</select>
			                @error('kategori')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 										
										</div>
									</div>
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
									<div class="form-group">
										<label for="konten">Deskripsi</label>
										<div>
											<textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $data->deskripsi) }}</textarea>
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
												<textarea class="form-control @error('thumbnail') is-invalid @enderror" aria-label="With textarea" id="thumbnail" name="thumbnail">{{ old('thumbnail', $data->thumbnail) }}</textarea>
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
										<label for="teks_thumbnail">Teks Thumbnail</label>
										<div>
											<input type="text" class="form-control @error('teks_thumbnail') is-invalid @enderror" id="teks_thumbnail" name="teks_thumbnail" placeholder="Teks Thumbnail" value="{{ old('teks_thumbnail', $data->teks_thumbnail) }}">
			                @error('teks_thumbnail')
			                    <div class="alert alert-danger alert-block small bg-danger">
			                      <strong>{{ $message }}</strong>
			                    </div>
			                @enderror 											
										</div>
									</div>									
									
									<div class="form-group">
										<label for="thumbnail">Logo</label>
										<div>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text btn btn-primary btn-border">
													 <a id="lfm-logo" data-input="logo" data-preview="holder" class="btn btn-primary" style="color:#f9f9f9;">
													   <i class="far fa-images"></i> Buka File Manager
													 </a>
													</span>													
												</div>
												<textarea class="form-control @error('logo') is-invalid @enderror" aria-label="With textarea" id="logo" name="logo">{{ old('logo', $data->logo) }}</textarea>
											</div>
			                @error('logo')
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
													<li class="fas fa-hand-point-right text-info"></li>&nbsp;&nbsp;file logo harus berformat <b>JPG</b> , <b>JPEG</b> , <b>PNG</b>.
												</small>
												<small class="form-text text-muted">
													<li class="fas fa-hand-point-right text-info"></li>&nbsp;&nbsp;ukuran file logo yang direkomendasikan <b>Width</b>(lebar) x <b>Height</b>(tinggi) = 296px * 296px. Atau ukuran dibawahnya dengan rasio 1:1.
												</small>												
											</div>
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

	$('#lfm').filemanager('image');	
	$('#lfm-logo').filemanager('image');	
</script>
@endpush

