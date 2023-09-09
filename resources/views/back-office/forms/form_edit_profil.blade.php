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
						<a href="{{ route('post-profil') }}" title="kembali ke halaman post profil">
							<button type="button" class="btn btn-icon btn-sm btn-secondary">
								<i class="fas fa-arrow-left" style="font-size:18px;"></i>
							</button>					
						</a>
						&nbsp;
						<span style="font-size:14px;font-style:italic;">Kembali ke halaman post profil</span>
					</div>
				</div>

				<form id="form-input" action="{{ route('profil.update',  $data->id_profil) }}" method="POST" enctype="multipart/form-data">
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
												<option value="Definisi" @if (old('kategori') == "Definisi" || $data->kategori == "Definisi") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Definisi</option>
												<option value="Visi dan Misi" @if (old('kategori') == "Visi dan Misi" || $data->kategori == "Visi dan Misi") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Visi dan Misi</option>
												<option value="Logo" @if (old('kategori') == "Logo" || $data->kategori == "Logo") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Logo</option>
												<option value="Intro Berita" @if (old('kategori') == "Intro Berita" || $data->kategori == "Intro Berita") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Intro Berita</option> 
												<option value="Intro Panduan Teknis" @if (old('kategori') == "Intro Panduan Teknis" || $data->kategori == "Intro Panduan Teknis") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Intro Panduan Teknis</option> 
												<option value="Intro Tips Keamanan Siber" @if (old('kategori') == "Intro Tips Keamanan Siber" || $data->kategori == "Intro Tips Keamanan Siber") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Intro Tips Keamanan Siber</option> 
												<option value="Intro Hubungi Kami" @if (old('kategori') == "Intro Hubungi Kami" || $data->kategori == "Intro Hubungi Kami") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Intro Hubungi Kami</option> 
												<option value="Alamat CSIRT Bappenas" @if (old('kategori') == "Alamat CSIRT Bappenas" || $data->kategori == "Alamat CSIRT Bappenas") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Alamat CSIRT Bappenas</option> 
												<option value="Kontak CSIRT Bappenas" @if (old('kategori') == "Kontak CSIRT Bappenas" || $data->kategori == "Kontak CSIRT Bappenas") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Kontak CSIRT Bappenas</option> 
												<option value="Email CSIRT Bappenas" @if (old('kategori') == "Email CSIRT Bappenas" || $data->kategori == "Email CSIRT Bappenas") {!! "selected style='background-color:#bad1d1;font-weight:bold;'" !!} @endif>Email CSIRT Bappenas</option> 
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
							<!-- <button type="reset" class="btn btn-danger">Cancel</button> -->
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



