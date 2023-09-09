  <header id="header" class="fixed-top header-transparent-xx">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="{{ route('front-office') }}">
            <span><img src="{{CSIRTHelper::csirt_asset('img/logo-web-csirt-header-2.png')}}" alt="" class="img-fluid"></span>            
            <!--<span><img src="{{--CSIRTHelper::csirt_asset('assets/front-office/assets/img/logo-csirt-new.png')--}}" alt="" class="img-fluid"></span>-->

        </a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto {{ (request()->is('/')) ? 'active' : '' }}" href="{{route('front-office')}}">Beranda</a></li>
          <li class="dropdown"><a class="nav-link {{ (request()->is('profil*')) ? 'active' : '' }}" href="javascript:void(0)"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('front.profil.definisi')}}">Definisi</a></li>
              <li><a href="{{route('front.profil.visi-misi')}}">Visi dan Misi</a></li>
              <!--<li><a href="{{-- route('front.profil.logo') --}}">Logo</a></li>-->
            </ul>
          </li>   
          <li class="dropdown"><a class="nav-link {{ (request()->is('rfc*')) ? 'active' : '' }}" href="javascript:void(0)"><span>RFC 2350</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('front.rfc.informasi-dokumen')}}">Informasi Dokumen</a></li>
              <li><a href="{{route('front.rfc.informasi-kontak')}}">Informasi Kontak</a></li>
              <li><a href="{{route('front.rfc.tentang-bappenas-csirt')}}">Tentang Bappenas CSIRT</a></li>
              <li><a href="{{route('front.rfc.layanan-bappenas-csirt')}}">Layanan Bappenas CSIRT</a></li>
              <li><a href="{{route('front.rfc.kebijakan')}}">Kebijakan</a></li>
              <li><a href="{{route('front.rfc.pelaporan-insiden')}}">Pelaporan Insiden</a></li>
              <li><a href="{{route('front.rfc.disclaimer')}}">Disclaimer</a></li>
            </ul>
          </li>                 
          <li><a class="nav-link scrollto {{ (request()->is('berita*')) ? 'active' : '' }}" href="{{route('front.berita')}}">Berita</a></li>
          <li class="dropdown"><a class="nav-link {{ (request()->is('layanan*')) ? 'active' : '' }}" href="javascript:void(0)"><span>Layanan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('front.layanan.layanan-bappenas-csirt')}}">Layanan Bappenas CSIRT</a></li>
              <li><a href="{{route('front.layanan.panduan-teknis')}}">Pedoman/Panduan Teknis</a></li>
              <li><a href="{{route('front.layanan.tips-keamanan-siber')}}">Tips Keamanan Siber</a></li>
            </ul>
          </li>          
          <li><a class="nav-link scrollto {{ (request()->is('aduan-siber')) ? 'active' : '' }}" href="{{route('front.aduansiber')}}">Aduan Siber</a></li>
          <li><a class="nav-link scrollto {{ (request()->is('event')) ? 'active' : '' }}" href="{{route('front.event')}}">Event</a></li>
          <!-- <li><a class="nav-link scrollto" href="{{-- route('front.hubungikami') --}}">Hubungi Kami</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header>