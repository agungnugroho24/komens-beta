@extends('layouts.kms.master')

@section('content')
    <div class="container-fluid py-5" style="background-image: url(../img/kms/bg.png);background-repeat: no-repeat;background-size: 100% 100%;margin-top: 3%;">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h2 class="mb-5">Pencarian Produk</h2>
                </div>

                <section class="rounded shadow-lg" style="background-color: #ffffff;">
                    <div class="container py-4">
                        <div class="row">
                            @if ($data->isEmpty())
                                <h5 class="text-center">No data found</h5>
                            @else
                                @foreach ($data as $row)
                                <div class="col-lg-12 mb-2">
                                    <div class="card border rounded shadow-sm">
                                        <div class="row g-0">
                                            <div class="col-md-4 col-xl-3 p-2">
                                                @if($row->type == 'pdf')
                                                    <img src="{{ asset($row->filecover) }}" class="img-fluid rounded" alt="...">
                                                @elseif($row->type == 'mp4')
                                                    <img src="{{ asset($row->cover) }}" class="img-fluid rounded" alt="...">
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="d-flex bd-highlight">
                                                        <div class="p-1 flex-shrink-1 bd-highlight">
                                                            @if($row->type == 'pdf')
                                                                <h5><i class="fa fa-file-pdf-o" style="margin-top: -15%;"></i></h5>
                                                            @elseif($row->type == 'mp4')
                                                                <i class="fa fa-video-camera"></i>
                                                            @endif
                                                        </div>
                                                        <div class="w-100 bd-highlight">
                                                            <h5 class="card-title">{{ $row->judul }}</h5>
                                                        </div>
                                                    </div>
                                                    <p class="card-text">
                                                        <small class="text-muted">{{ $row->tahun }}</small>
                                                    </p>
                                                    <p class="card-text text-truncate">
                                                        {{ $row->deskripsi }}
                                                    </p>
                                                    @if($row->type == 'pdf')
                                                        <a href="{{ route('file.download', $row->uuid) }}">
                                                            <button class="btn btn-primary btn-sm">
                                                                Download
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                                            <button class="btn btn-outline-primary btn-sm">
                                                                View
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('pdf',$row->uuid) }}" target="_blank">
                                                            <button class="btn btn-outline-primary btn-sm">
                                                                View
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection