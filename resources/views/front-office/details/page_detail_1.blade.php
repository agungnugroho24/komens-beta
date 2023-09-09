@extends('front-office.layouts.master')

@section('title')
 {{ $title }}
@overwrite

@push('app-styles')
  
@endpush

@section('navbar-header')
   @include('front-office.partials.navbar_header')
@endsection

@section('content')

  @empty($data)
      @php
        $judul = null;
        $konten = null;
        $menu = null;
      @endphp
  @endempty
  @isset($data)
    @php
      foreach($data as $row):
        $judul = $row->judul;
        $konten = $row->konten;
        $menu = $row->kategori;
      endforeach;
    @endphp
  @endisset
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
            @isset($menu)
              @if($menu != "Hubungi Kami")
                <li>{{ $menu }}</li>
              @endif
            @endisset
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
              <div class="col-lg-1"></div>
              <div class="col-md-9 col-lg-10 align-items-stretch mb-5 mb-lg-0">
                  <h3 class="title">
                    {{ $judul }}
                  </h3>
                  <p class="description">{!! $konten !!}</p>
                <!-- </div> -->
              </div>
              <div class="col-lg-1"></div>
            </div> 
          </div>
        </div>   
      </div>
    </section>


@endsection

@push('app-script')

@endpush

