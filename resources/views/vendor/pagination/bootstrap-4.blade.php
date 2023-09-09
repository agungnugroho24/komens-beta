@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li style="cursor: not-allowed;" class="page-item disabled" aria-disabled="true">
                    <span style="background: rgb(93, 134, 187);" class="page-link"><i style="font-size:1.3em;" class="fa fa-chevron-circle-left text-warning"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i style="font-size:1.3em;" class="fa fa-chevron-circle-left text-warning"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link rounded-circle">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i style="font-size:1.3em;" class="fa fa-chevron-circle-right text-warning"></i></a>
                </li>
            @else
                <li style="cursor: not-allowed;" class="page-item disabled" aria-disabled="true">
                    <span style="background: rgb(93, 134, 187);" class="page-link"><i style="font-size:1.3em;" class="fa fa-chevron-circle-right text-warning"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
