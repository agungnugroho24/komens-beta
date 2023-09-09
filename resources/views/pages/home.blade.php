@extends('layouts.kms.master')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(#dceff8, #F8F8FF);">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="padding-bottom: 5%;">
            <div class="carousel-inner">
                @foreach ($data as $row => $slider)
                <div class="carousel-item {{$row == 0 ? 'active' : '' }}" style="padding-top: 7%;">
                    <div class="container-fluid">
                        <a href="{{ route('pdf',$slider->uuid) }}" target="_blank">
                        <div class="card shadow" style="width: 80rem;margin: 0 auto;float: none;border: 0px;">
                            <div class="row">
                                <div class="col-md-8">
                                    <img class="card-img" src="{{url($slider->cover)}}" alt="Card image cap">
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">{{ $slider->judul }}</h5>
                                        <p class="card-text text-wrap text-dark text-truncate" style="text-indent: 0px;text-align: justify;text-justify: inter-word;">
                                            {{ $slider->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid py-2" style="background-image: url(img/kms/bg.png);background-repeat: no-repeat;width: 100%;background-size: 100% 100%; ">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h2 class="mb-5">Sorotan Pengetahuan</h2>
        </div>
        <div class="row" style="padding-bottom: 3%;">
            <div class="col-sm-6">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="row">
                            @forelse ($data3 as $row)
                            
                                <div class="col-md-4">
                                    @if($row->filecover == NULL)
                                        <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                            <svg class="bd-placeholder-img img-fluid rounded" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="40%" y="50%" fill="#dee2e6" dy=".3em">No image</text></svg>
                                        </a>
                                    @else
                                        <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                            <img src="{{ asset($row->filecover) }}" class="img-fluid rounded" alt="...">
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">TERHANGAT</h5>
                                        <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                            <div class="d-flex bd-highlight">
                                                <!-- <div class="p-1 flex-shrink-1 bd-highlight"> -->
                                                    <!-- @if($row->type == 'pdf') -->
                                                        <!-- <h5><i class="fa fa-file-pdf-o" style="margin-top: -15%;"></i></h5> -->
                                                    <!-- @elseif($row->type == 'mp4') -->
                                                        <!-- <i class="fa fa-video-camera"></i> -->
                                                    <!-- @endif -->
                                                <!-- </div> -->
                                                <div class="w-100 bd-highlight">                                     
                                                    <h5 class="card-title">
                                                        @if($row->type == 'pdf')
                                                            <span><i class="fa fa-file-pdf-o" style="margin-top: -15%;"></i></span>
                                                        @elseif($row->type == 'mp4')
                                                            <span><i class="fa fa-video-camera"></i></span>
                                                        @endif
                                                        {{ $row->judul }}
                                                    </h5>
                                                    <p class="card-text text-dark" style="text-indent: 0px;text-align: justify;text-justify: inter-word;">
                                                        {{ $row->deskripsi }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            @empty
                                <p class="text-center">No file</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="row">
                            @forelse ($data2 as $row)
                            <div class="col-md-4">
                                @if($row->cover != '')
                                    <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                        <img src="{{ asset($row->cover) }}" class="img-fluid rounded" alt="...">
                                    </a>
                                @else
                                    <svg class="bd-placeholder-img img-fluid rounded" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="43%" y="50%" fill="#dee2e6" dy=".3em">Image</text></svg>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                <h5 class="card-title">TERBARU</h5>
                                <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                    <p class="card-text text-dark" style="text-indent: 0px;text-align: justify;text-justify: inter-word;">
                                        {{ $row->deskripsi }}
                                    </p>
                                </a>
                                </div>
                            </div>
                            @empty
                                <p>No file</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5" style="background-color: #E5E4E2;">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h2 class="mb-5">{{ Str::title('TAUTAN LAINNYA') }}</h2>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-sm-12">
                    <div class="card">
                        <a href="https://regsosek-sepakat.bappenas.go.id" target="_blank">
                            <div class="card-body">
                                <img src="{{ asset('img/kms/regsosek.png') }}" class="card-img-top" style="width:90%">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <a href="https://jdih.bappenas.go.id" target="_blank">
                            <div class="card-body">
                                <img src="{{ asset('img/kms/jdih.png') }}" class="card-img-top" style="width:90%">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <a href="https://sepakat.bappenas.go.id" target="_blank">
                            <div class="card-body">
                                <img src="{{ asset('img/kms/sepakat.png') }}" class="card-img-top" style="width:80%">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <a href="https://sikompak.bappenas.go.id" target="_blank">
                            <div class="card-body">
                                <img src="{{ asset('img/kms/sikompak.png') }}" class="card-img-top" style="width:90%">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection