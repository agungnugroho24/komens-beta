@php
    if(empty(Session::get('csirtsso'))):
        $avatar = CSIRTHelper::csirt_asset('assets/back-office/assets/img/profile.jpg');
        $nama = NULL;
    else:
        if(empty(Session::get('csirtsso')['avatar'])):
            $avatar = CSIRTHelper::csirt_asset('assets/back-office/assets/img/profile.jpg');
        else:
            $avatar = 'https://akun.bappenas.go.id/bp-um/avatar/'.Session::get('csirtsso')['avatar'];
        endif;
        
        $nama = Session::get('csirtsso')['nama'];
    endif;
@endphp        
        
        
        <div class="sidebar sidebar-style-2" data-background-color="dark">           
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="{{ $avatar }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    {{ $nama }}
                                    <span class="user-level">Administrator</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="{{ route('front-office') }}" target="_blank">
                                            <span class="link-collapse">Front Office</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form-1').submit();">
                                            <span class="link-collapse">Logout</span>
                                        </a>
                                        <form id="logout-form-1" action="{{ route('logout.sso') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item">
                            <a href="{{ route('back-office') }}" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Post</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('post-profil') }}">
                                            <span class="sub-item">Post Profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('post-berita') }}">
                                            <span class="sub-item">Post Berita</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('post-rfc') }}">
                                            <span class="sub-item">Post RFC 2350</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('post-layanan') }}">
                                            <span class="sub-item">Post Layanan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('post-aduansiber') }}">
                                            <span class="sub-item">Post Aduan Siber</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('post-event') }}">
                                            <span class="sub-item">Post Event</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#forms">
                                <i class="fas fa-pen-square"></i>
                                <p>Set Role</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="forms">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('administrasi-user') }}">
                                            <span class="sub-item">Admin/Operator</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>