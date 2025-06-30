@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="pagination">
    <ul class="pagination-list">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true" class="page-link"><i class="fas fa-chevron-left"></i></span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-label="@lang('pagination.previous')">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="dots interactive-dots" onclick="togglePageDropdown(this)" style="position:relative; cursor:pointer;">
                    <span>{{ $element }}</span>
                    <ul class="page-dropdown" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:5px; margin-top:2px; list-style:none; max-height:150px; overflow-y:auto; z-index:100;">
                        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                            <li style="padding:3px 8px; cursor:pointer;" onclick="event.stopPropagation(); goToPage({{ $i }});">{{ $i }}</li>
                        @endfor
                    </ul>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page">
                            <span class="page-link current" style="font-size: 1.3rem; font-weight: 600; padding: 6px 12px;">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="page-link" style="font-size: 1.3rem; padding: 6px 12px;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link" aria-label="@lang('pagination.next')">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true" class="page-link"><i class="fas fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
</nav>

<script>
function togglePageDropdown(el) {
    const dropdown = el.querySelector('.page-dropdown');
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

function goToPage(page) {
    const url = new URL(window.location.href);
    url.searchParams.set('page', page);
    window.location.href = url.toString();
}
</script>
@endif
