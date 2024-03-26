<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between px-4 sm:px-0 py-3">
    <div class="flex justify-between flex-1 md:hidden">
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-xs sm:text-sm font-medium text-zinc-500 ltr:mr-4 dark:text-zinc-200 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default leading-5 rounded-md">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <Link keep-modal dusk="pagination-simple-previous" href="{{ $paginator->previousPageUrl() }}" class="relative ltr:mr-4 inline-flex items-center px-4 py-2 text-xs sm:text-sm font-medium text-zinc-700 dark:text-zinc-200 bg-white dark:bg-zinc-700 border dark:border-zinc-600 border-zinc-300 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150">
                {!! __('pagination.previous') !!}
            </Link>
        @endif

        @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

        @if ($paginator->hasMorePages())
            <Link keep-modal dusk="pagination-simple-next" href="{{ $paginator->nextPageUrl() }}" class="relative  rtl:ml-4 inline-flex items-center px-4 py-2 ml-3 text-xs sm:text-sm font-medium text-zinc-700 dark:text-zinc-200 bg-white dark:bg-zinc-700 border border-zinc-300  dark:border-zinc-600 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150">
                {!! __('pagination.next') !!}
            </Link>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-xs sm:text-sm font-medium text-zinc-500  rtl:ml-4 bg-white border border-zinc-300 cursor-default leading-5 rounded-md">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>

    <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
        <div class="flex items-center">
            @includeWhen($hasPerPageOptions ?? true, 'splade::table.per-page-selector')

            <div class="hidden lg:block @if($hasPerPageOptions ?? true) ml-3 rtl:mr-3 rtl:ml-0 @endif">
                <p class="text-xs sm:text-sm text-zinc-700 leading-5  dark:text-white">
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 dark:text-white dark:border-zinc-600 border border-zinc-300 cursor-default ltr:rounded-l-md rtl:rounded-r-md leading-5" aria-hidden="true">
                            @if(app()->getLocale() == 'ar')
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </span>
                    </span>
                @else
                    <Link keep-modal dusk="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-xs sm:text-sm font-medium text-zinc-500 dark:text-zinc-200 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 ltr:rounded-l-md rtl:rounded-r-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                        @if(app()->getLocale() == 'ar')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </Link>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs sm:text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-xs sm:text-sm font-medium dark:bg-zinc-800 dark:text-white dark:border-zinc-600 bg-indigo-50 border-indigo-500 text-indigo-600 z-10 border cursor-default leading-5">{{ $page }}</span>
                                </span>
                            @else
                                <Link keep-modal dusk="pagination-{{ $page }}" href="{{ $url }}" class="relative dark:bg-zinc-700 dark:text-white dark:border-zinc-600 inline-flex items-center px-4 py-2 -ml-px text-xs sm:text-sm font-medium text-zinc-700 bg-white border border-zinc-300 leading-5 hover:text-zinc-500 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </Link>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <Link keep-modal dusk="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-xs sm:text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-800 dark:text-white dark:border-zinc-600 border border-zinc-300 ltr:rounded-r-md rtl:rounded-l-md leading-5 hover:text-zinc-400 focus:z-10 focus:outline-none focus:ring ring-zinc-300 focus:border-blue-300 active:bg-zinc-100 active:text-zinc-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                        @if(app()->getLocale() == 'ar')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif

                    </Link>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-xs sm:text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 dark:text-white dark:border-zinc-600 border border-zinc-300 cursor-default ltr:rounded-r-md rtl:rounded-l-md leading-5" aria-hidden="true">
                            @if(app()->getLocale() == 'ar')
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            @else
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            @endif
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </div>
</nav>
