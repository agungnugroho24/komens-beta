@extends('layouts.kms.master')

@section('content')
    <div class="container-fluid py-5" style="background-image: url(img/kms/bg.png);background-repeat: no-repeat;width: 100%;background-size: 100% 100%;margin-top: 3%;">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h2 class="mb-5">Produk Pengetahuan Bappenas</h2>
                </div>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    @foreach ($data as $row)
                        <div class="col">
                            <div class="card shadow h-100">
                                <a href="{{ route('detail',$row->slug) }}">
                                    <div class="card-body py-5">
                                        <p class="card-text text-center">
                                            {{ $row->nama }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection