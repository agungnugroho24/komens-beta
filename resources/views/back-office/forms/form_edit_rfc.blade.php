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
						<a href="{{ route('post-rfc') }}" title="kembali ke halaman post rfc 2350">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post rfc 2350</span>
					</div>
				</div>
				
				<form id="form-input" action="{{ route('rfc.update',  $data->id_rfc) }}" method="POST" enctype="multipart/form-data">
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
												<option value="Informasi Dokumen" @if (old('kategori') == "Informasi Dokumen" || $data->kategori == "Informasi Dokumen") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Informasi Dokumen</option>
												<option value="Informasi Kontak" @if (old('kategori') == "Informasi Kontak" || $data->kategori == "Informasi Kontak") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Informasi Kontak</option>
												<option value="Tentang Bappenas CSIRT" @if (old('kategori') == "Tentang Bappenas CSIRT" || $data->kategori == "Tentang Bappenas CSIRT") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Tentang Bappenas CSIRT</option>
												<option value="Layanan Bappenas CSIRT" @if (old('kategori') == "Layanan Bappenas CSIRT" || $data->kategori == "Layanan Bappenas CSIRT") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Layanan Bappenas CSIRT</option>
												<option value="Kebijakan" @if (old('kategori') == "Kebijakan" || $data->kategori == "Kebijakan") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Kebijakan</option>
												<option value="Pelaporan Insiden" @if (old('kategori') == "Pelaporan Insiden" || $data->kategori == "Pelaporan Insiden") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Pelaporan Insiden</option>
												<option value="Disclaimer" @if (old('kategori') == "Disclaimer" || $data->kategori == "Disclaimer") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Disclaimer</option>
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

