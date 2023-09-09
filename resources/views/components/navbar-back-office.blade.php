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

<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ $avatar }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="{{ $avatar }}" alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4>{{ $nama }}</h4>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalProfil">My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">Logout</a>
                            <form id="logout-form-2" action="{{ route('logout.sso') }}" method="POST" class="d-none">
                                @csrf
                            </form>                            
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
