@extends('front-office.layouts.master')

@section('title')
 {{ $title }}
@overwrite

@push('app-styles')
  <!-- <x-css-back-office/> -->
@endpush

@section('navbar-header')
   @include('front-office.partials.navbar_header')
@endsection

@section('section-title-header')
  @include('front-office.partials.section_title_header')
@endsection

@section('content')

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-up">
            <div class="content">
              <h3>Berita Terkini</h3>
              <p>
                {!! $data['introberita'] !!}
              </p>
              <a href="{{route('front.berita')}}" class="about-btn">Halaman Berita <i class="fa fa-paper-plane-o"></i></a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                @isset($data["databerita"])
                  @foreach($data["databerita"] as $keyberita => $valberita)
                        
                    <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="{{ (((int) count($data['databerita'])) - ( (int) $keyberita)) * 100 }}">
                      <img style="border-radius:5px;" width="300" src="{{ $valberita->thumbnail }}" class="img-fluid" alt="">
                      <h4 class="mt-3">{{ $valberita->judul }}</h4>
                      <p style="font-size:13px;">{!! Str::words($valberita->deskripsi, 50, '...') !!} <span><i style="font-size:13px;margin-right:1%;" class="fa fa-external-link-square"></i><a style="font-weight:bold;" href="{{ route('front.berita.detail', $valberita->uuid) }}" target="_blank">selengkapnya </a></span></p>
                    </div>

                  @endforeach
                @endisset  

              </div>
            </div>
            <!-- End .content-->
          </div>
        </div>

      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Panduan Teknis</h2>
          <p>{!! $data['intropanduanteknis'] !!}</p>
        </div>

        <div class="row">
          @isset($data["datalayananpanduanteknis"])
            @foreach($data["datalayananpanduanteknis"] as $keypanduanteknis => $valpanduanteknis)   

              <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="{{ (((int) count($data['datalayananpanduanteknis'])) - ( (int) $keypanduanteknis)) * 250 }}">
                <div class="icon-box" data-aos="fade-up">
                  <!-- <div class="icon"><i class="bx bx-world"></i></div> -->
                  <div class="icon"><img width="55" src="{{ $valpanduanteknis->logo }}" class="img-fluid" alt=""></div>
                  <h4 class="title"><a href="{{ route('front.layanan.detail', $valpanduanteknis->uuid) }}" target="_blank">{{ $valpanduanteknis->judul }}</a></h4>
                  <p style="font-size:13px;" class="description">{{ Str::words($valpanduanteknis->deskripsi, 50, '...') }}</p>
                </div>
              </div>

            @endforeach
          @endisset 

          <div data-aos="fade-up" style="margin-top:0px;">
            <div class="content" style="margin-top:0px;">
              <a href="{{route('front.layanan.panduan-teknis')}}" class="services-btn">Halaman Panduan Teknis <i class="fa fa-paper-plane-o"></i></a>
            </div>
          </div>          

        </div>

      </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Tips Keamanan Siber</h2>
          <p>{!! $data['introtipskeamanansiber'] !!}</p>
        </div>

        <div class="row">
          @isset($data["datalayanantipskeamanan"])
            @foreach($data["datalayanantipskeamanan"] as $keytipskeamanan => $valtipskeamanan)

              <div class="col-lg-4 col-md-6">
                <div class="member" data-aos="fade-up">
                  <div class="pic">
                    <a style="color: #2f4d5a;" href="{{ route('front.layanan.detail', $valtipskeamanan->uuid) }}" target="_blank">
                      <img src="{{ $valtipskeamanan->thumbnail }}" class="img-fluid" alt=""></div>
                    </a>  
                  <div class="member-info ">
                    <h4><a style="color: #2f4d5a;" href="{{ route('front.layanan.detail', $valtipskeamanan->uuid) }}" target="_blank"> {{ $valtipskeamanan->judul }} </a></h4>

                  </div>
                </div>
              </div>

            @endforeach
          @endisset 

          <div data-aos="fade-up" style="margin-top:0px;">
            <div class="content" style="margin-top:-20px;">
              <a href="{{route('front.layanan.tips-keamanan-siber')}}" class="team-btn">Halaman Tips Keamanan Siber <i class="fa fa-paper-plane-o"></i></a>
            </div>
          </div>           

        </div>

      </div>
    </section>
    <!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Hubungi Kami</h2>
          <p>{!! $data['introhubungikami'] !!}</p>
        </div>

        <div class="row">
          <div class="col-lg-7">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Alamat</h3>
              <!--<p>Pusat Data dan Informasi Perencanaan Pembangunan, Kementerian PPN/Bappenas</p>-->
              <p>{!! $data['alamatCSIRT'] !!}</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>{!! $data['emailCSIRT'] !!}</p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Kontak</h3>
              <p>{!! $data['kontakCSIRT'] !!}</p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-12 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2609.3484545708457!2d106.83185981030941!3d-6.201359975718594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f41720e59d2b%3A0x3c98760322e6a486!2sBadan%20Perencanaan%20Pembangunan%20Nasional!5e0!3m2!1sen!2sid!4v1633529220597!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <!--<div class="col-lg-6">-->
            <!--<div class="info-box mb-4" style="height: 384px;">-->
              <!--<i class="bx bx-layer"></i>-->
              <!--<h3>Layanan Helpdesk</h3>-->
              <!--<h3>Pusat Data dan Informasi Perencanaan Pembangunan</h3>-->
              <!--<h3>Untuk Pegawai Kementerian PPN/Bappenas</h3>-->
              <!--<p class="mt-2">-->
                <!--<a href="http://helpdesk.bappenas.go.id/app/home" target="_blank">-->
                  <!--<img width="150" src="{{-- CSIRTHelper::csirt_asset('assets/front-office/assets/img/helpdesk.png') --}}" alt="helpdesk" title="helpdesk">-->
                <!--</a> -->
              <!--</p>-->
            <!--</div>-->
          <!--</div>-->

        </div>

      </div>
    </section>
    <!-- End Contact Section -->

@endsection

@push('app-script')

@endpush

