<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0">
    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand ms-4 mt-3 ms-lg-0">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="px-2"><img src="{{ asset('img/kms/logo.png') }}" width="35"></div>
                <div class=""><h4 class="text-dark m-0">Komens</h4></div>
            </div>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('produk') }}" class="nav-item nav-link {{ request()->is('produk') ? 'active' : '' }}">Produk Pengetahuan</a>
                <a href="https://helpdesk.bappenas.go.id/" target="_blank" class="nav-item nav-link">Pusat Bantuan</a>
                <form class="" action="{{ route('search') }}" method="POST">
                    @csrf
                    <div class="input-group mt-3">
                        <input class="form-control" type="text" name="s" placeholder="Search...">
                        <button class="btn btn-sm btn-primary input-group-text"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                @if(Auth::user()!=null)
                    <div class="nav-item dropdown mt-3 p-1">
                        <a href="#" class="text-dark dropdown-toggle" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu border-light m-0 pt-3">
                            <form method="POST" action="{{ route('logout.sso') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout.sso')" class="dropdown-item text-dark" onclick="event.preventDefault();this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @elseif(Auth::user()==null)
                    <a href="{{ route('login.sso') }}" class="mt-3 px-1">
                        <button class="btn btn-primary">Masuk</button>
                    </a>
                @endif
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->