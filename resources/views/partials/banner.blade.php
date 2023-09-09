<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: linear-gradient(#dceff8, #F8F8FF);">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="padding-bottom: 10%;">
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
                                    <p class="card-text text-wrap text-dark text-truncate" style="text-align: justify;text-justify: inter-word;">
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