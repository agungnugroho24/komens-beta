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

    <!-- ======= Testimonials Section ======= -->
    <section id="about" class="about" style="padding-top: 1%;padding-right: 0px;padding-left: 0px;">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">

           <div class="row" data-aos="fade-up">
              <div class="col-lg-2 stretch-card grid-margin">
              </div>

              <div class="col-lg-8 stretch-card grid-margin">
                @isset($data)
                  @foreach($data as $rows)
                <div class="card border-light mb-4 shadow p-2 rounded"  data-aos="fade-up" data-aos-delay="100">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4 grid-margin">
                        <div class="position-relative">
                          <div class="rotate-img">
                            <img src="{{ $rows->thumbnail }}" alt="thumb" class="img-fluid" />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-8  grid-margin">
                        <h4 class="mb-3"><a href="{{ $route.'/'.$rows->uuid }}" target="_blank">{{ $rows->judul }}</a></h4>                        
                        <div class="fs-13 mb-2">
                        </div>
                        <p class="mb-3 card-text">{!! $rows->deskripsi !!}</p>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer border-light">
                    <div class="row">
                      <div class="col-lg-3 col-sm-12">
                        <span><i class="fa fa-calendar"></i> <i class="text-muted" style="font-size:12px;">Published : {{ Carbon\Carbon::parse($rows->published_at)->translatedFormat('d/F/Y') }}</i></span>
                      </div>
                      @isset($rows->kategori)
                      <div class="col-lg-3 col-sm-12">
                        <span><i class="fa fa-folder-open-o"></i> <i class="text-muted" style="font-size:12px;">{{ $rows->kategori }}</i></span>
                      </div>
                      @endif
                      <div class="col-lg-3 col-sm-12">
                        <span><i class="fa fa-external-link-square"></i> <a href="{{ $route.'/'.$rows->uuid }}" target="_blank"><i class="text-primary" style="font-size:12px;">Selengkapnya</i></a></span>
                      </div>
                    </div>
                  </div>                  
                </div>
                    @endforeach
                @endisset

                @isset($data)
                <div class="d-flex justify-content-center">
                  {{ $data->links() }}
                </div>
                @endisset                
              </div>

              <div class="col-lg-2 stretch-card grid-margin">
              </div>              
            </div>

          </div>
        </div> 

      </div>
    </section>
    <!-- End Testimonials Section -->    
   
@endsection

@push('app-script')
@endpush

