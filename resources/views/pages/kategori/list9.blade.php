@extends('layouts.kms.master')

@include('partials.navbar')

@section('content')
    <div class="container-fluid py-5" style="background-image: url(img/kms/bg-repo.png);background-repeat: no-repeat;width: 100%;background-size: 100% 100%;margin-top: 3%;">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h2 class="mb-5">Daftar Produk</h2>
                </div>
                <div class="container bg-white rounded" style="border: 1px solid #dcdcdc;box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);">
                    <div class="panel panel-default panel-order">                
                        <div class="panel-body">
                            <div class="row mt-2" style="border-bottom: 1px solid #dcdcdc;">
                                <div class="col-md-1">
                                    <a href="#">
                                        <img src="{{ asset('img/kms/pdf.png') }}" class="mx-auto d-block img-thumbnail mb-2" />
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <a href="#">
                                            <div class="col-md-12">
                                                <span>
                                                    <strong>File name</strong>
                                                </span>
                                                <br/>
                                            </div>
                                            <div class="col-md-12">05/31/2014</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-2" style="border-bottom: 1px solid #dcdcdc;">
                                <div class="col-md-1">
                                    <a href="#">
                                        <img src="{{ asset('img/kms/doc.png') }}" class="mx-auto d-block img-thumbnail mb-2" />
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <a href="#">
                                            <div class="col-md-12">
                                                <span>
                                                    <strong>File name</strong>
                                                </span>
                                                <br/>
                                            </div>
                                            <div class="col-md-12">05/31/2014</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row mt-2" style="border-bottom: 1px solid #dcdcdc;">
                                <div class="col-md-1">
                                    <a href="#">
                                        <img src="{{ asset('img/kms/ppt.png') }}" class="mx-auto d-block img-thumbnail mb-2" />
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <a href="#">
                                            <div class="col-md-12">
                                                <span>
                                                    <strong>File name</strong>
                                                </span>
                                                <br/>
                                            </div>
                                            <div class="col-md-12">05/31/2014</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row mt-2" style="border-bottom: 1px solid #dcdcdc;">
                                <div class="col-md-1">
                                    <a href="#">
                                        <img src="{{ asset('img/kms/xls.png') }}" class="mx-auto d-block img-thumbnail mb-2" />
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <a href="#">
                                            <div class="col-md-12">
                                                <span>
                                                    <strong>File name</strong>
                                                </span>
                                                <br/>
                                            </div>
                                            <div class="col-md-12">05/31/2014</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection