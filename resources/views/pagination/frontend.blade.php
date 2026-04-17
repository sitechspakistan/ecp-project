@if ($paginator->hasPages())
    <div class="blog-pagination">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item previtem disabled">
                        <a href="javascript:void(0)" class="page-link"><i class="fas fa-arrow-left"></i> Prev</a>
                    </li>
                @else
                    <li class="page-item previtem">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}{{ request()->query() ? '&' . http_build_query(request()->query()) : '' }}">
                            <i class="fas fa-arrow-left"></i> Prev
                        </a>
                    </li>
                @endif
            
                <li class="justify-content-center pagination-center">
                    <div class="pagelink">
                        <ul>
                            {{-- Pagination Links --}}
                            @php
                                $currentPage = $paginator->currentPage();
                                $lastPage = $paginator->lastPage();
                                $adjacent = 2; // Number of pages to show on each side of the current page
                            @endphp
                        
                            {{-- First Page --}}
                            @if ($currentPage > $adjacent + 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->url(1) }}{{ request()->except('page') ? '&' . http_build_query(request()->except('page')) : '' }}">1</a>
                                </li>
                                <li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>
                            @endif
                        
                            {{-- Middle Pages --}}
                            @for ($page = max(1, $currentPage - $adjacent); $page <= min($lastPage, $currentPage + $adjacent); $page++)
                                @if ($page == $currentPage)
                                    <li class="page-item active">
                                        <a href="javascript:void(0)" class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $paginator->url($page) }}{{ request()->except('page') ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor
                        
                            {{-- Last Page --}}
                            @if ($currentPage < $lastPage - $adjacent)
                                <li class="page-item disabled"><a href="javascript:void(0)" class="page-link">...</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->url($lastPage) }}{{ request()->except('page') ? '&' . http_build_query(request()->except('page')) : '' }}">{{ $lastPage }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item nextlink">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}{{ request()->query() ? '&' . http_build_query(request()->query()) : '' }}">Next <i class="fas fa-arrow-right"></i></a>
                    </li>
                @else
                    <li class="page-item nextlink disabled">
                        <a href="javascript:void(0)" class="page-link">Next <i class="fas fa-arrow-right"></i></a>
                    </li>
                @endif
            </ul>
            
        </nav>
    </div>
@endif