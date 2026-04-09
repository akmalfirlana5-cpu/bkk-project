@php
    if (! isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';

    $totalPages = $paginator->lastPage();
    $currentPage = $paginator->currentPage();
    $onEachSide = 1;

    if ($totalPages < 5) {
        // Show all pages when less than 6
        $pageNumbers = collect(range(1, $totalPages));
    } else {
        $pageNumbers = collect(range(1, $totalPages))->filter(function ($i) use ($totalPages, $currentPage, $onEachSide) {
            $isFirstOrLast = $i === 1 || $i === $totalPages;
            $inWindow = $i >= $currentPage - $onEachSide && $i <= $currentPage + $onEachSide;

            // near start : show first 2 pages + next few
            $isNearStart = $currentPage <= 2 && $i <= 2;

            // near end : show last 2 pages + previous few
            $isNearEnd = $currentPage >= $totalPages - 1 && $i >= $totalPages - 1;

            return $isFirstOrLast || $inWindow || $isNearStart || $isNearEnd;
        });
    }

    $elements = [];
    $lastPage = 0;
    foreach ($pageNumbers as $page) {
        if ($lastPage !== 0) {
            $gap = $page - $lastPage;

            if ($totalPages >= 6 && $gap > 1) {
                // if only one page is missing, show it instead of ellipsis
                if ($gap === 2) {
                    $elements[] = $lastPage + 1;
                } else {
                    $elements[] = '...';
                }
            }
        }

        $elements[] = $page;
        $lastPage = $page;
    }
@endphp


{{-- Page Numbers --}}
<div class="flex items-center gap-2">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center w-full ">
            <div class="flex items-center gap-4">
                {{-- Previous Button --}}
                @unless ($paginator->onFirstPage())
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            class="rounded-xl w-[48px] h-[48px] flex items-center justify-center text-bkkNeutral-600 hover:text-white border border-bkkNeutral-600 hover:border-primary bg-transparent hover:bg-primary transition ease-in-out duration-150 cursor-pointer"
                            aria-label="{{ __('pagination.previous') }}">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 1L1 5L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                @endunless

                {{-- Page Number Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        {{-- Ellipsis --}}
                        <span
                                class="w-[48px] h-[48px] flex items-center justify-center paragraph-15r text-gray-400">…</span>
                    @else
                        @if ($element == $currentPage)
                            <span
                                    class="rounded-xl w-[48px] h-[48px] flex items-center justify-center text-white bg-primary paragraph-15r select-none">
                                {{ $element }}
                            </span>
                        @else
                            <button type="button"
                                    wire:click="gotoPage({{ $element }}, '{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    class="rounded-xl w-[48px] h-[48px] flex items-center justify-center text-bkkNeutral-600 hover:text-white  border border-bkkNeutral-600 hover:border-primary bg-transparent hover:bg-primary transition cursor-pointer paragraph-15r">
                                {{ $element }}
                            </button>
                        @endif
                    @endif
                @endforeach

                {{-- Next Button --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            class="rounded-xl w-[48px] h-[48px] flex items-center justify-center  transition ease-in-out duration-150 cursor-pointer text-bkkNeutral-600 hover:text-white border border-bkkNeutral-600 hover:border-primary bg-transparent hover:bg-primary"
                            aria-label="{{ __('pagination.next') }}">
                        <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5L1 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                @endif
            </div>
        </nav>
    @endif
</div>
