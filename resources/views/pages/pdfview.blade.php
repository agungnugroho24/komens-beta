@extends('layouts.kms.master')
<style>
.carousel-control-prev .carousel-control-prev-icon,
.carousel-control-next .carousel-control-next-icon {
    outline: black;
    background-color: rgba(0, 0, 0, 0.3);
}

.carousel-control-prev .fa-chevron-left,
.carousel-control-next .fa-chevron-right {
    color: black;
}

.carousel-caption {
    color: black;
}
</style>

@section('content')
<div class="container-fluid p-0" style="margin-top: 5%;">
    @forelse ($data as $row)
        @if($row->type == 'pdf')
                <iframe src="{{ asset('file-storage/'.$row->path) }}#toolbar=0" frameborder="0" style="overflow:hidden;height:100%;width:100%;" height="100%" width="100%"></iframe>
        @elseif($row->type == 'mp4')
            <video autobuffer controls autoplay controlsList="nodownload" style="overflow:hidden;height:100%;width:100%;" height="100%" width="100%">
                <source id="mp4" src="{{ $row->linkfile }}" type="video/mp4">
            </video>
        @endif
    @empty
        <p>No file</p>
    @endforelse
</div>
<script>

</script>
@endsection