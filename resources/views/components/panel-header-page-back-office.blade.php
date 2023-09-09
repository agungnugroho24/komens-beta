        <div class="page-header">
            <h4 class="page-title">{{ $segment['segment'] }}</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{route('back-office')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow text-primary"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('back-office')}}">Back Office</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow text-primary"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ $segment['linksegment'] }}">{{ $segment['segment'] }}</a>
                </li>
            </ul>
        </div>