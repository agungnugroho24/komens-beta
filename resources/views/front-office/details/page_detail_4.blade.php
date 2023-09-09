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
        $published = null;
        $thumbnail = null;
        $teksthumbnail = null;
        $kategori = null;
      @endphp
  @endempty
  @isset($data)
    @php
      foreach($data as $row):
        $judul = $row->judul;
        $konten = $row->konten;
        $menu = $row->kategori;
        $published = $row->published_at;
        $kategori = $row->kategori;
        $teksthumbnail = $row->teks_thumbnail;

        if(empty($row->thumbnail)):
          $thumbnail = url('img/logo-bappenas.png');
        else:
          $thumbnail = $row->thumbnail;
        endif;
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
            <li>{!! $titlepage !!}</li>
            @isset($menu)
              @if($menu != "Hubungi Kami")
                <li>{!! $menu !!}</li>
              @endif
            @endisset            
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details section-bg-custom" style="padding-top: 1%;padding-right: 0px;padding-left: 0px;">
    <!-- <section id="about" class="about"> -->
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide-x">
                    <div class="swiper-slide">
                         <img src="{{ $thumbnail }}" alt="">
                    </div>
                    <p class="text-muted" style="font-size:12px;font-style:italic;margin-top:1%;text-align:center;">{{ $teksthumbnail }}</p>
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="portfolio-info">
              <span>
                <h3>{{ $judul }}</h3>
              </span>
              <p> {!! $konten !!} </p>
              <div class="card-footer border-light">
                  <span><i class="fa fa-calendar"></i> <i class="text-muted" style="font-size:12px;">Published : {{ Carbon\Carbon::parse($published)->translatedFormat('d/F/Y') }}</i></span>
                  &nbsp;&nbsp;
                  @isset($kategori)
                    <span><i class="fa fa-folder-open-o"></i> <i class="text-muted" style="font-size:12px;">{{ $kategori }}</i></span>
                    &nbsp;&nbsp;
                  @endif                  
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Portfolio Details Section -->
  
   
@endsection

@push('app-script')
@endpush

