@if ($paginator->hasPages())
    <div class="flex justify-center mt-10">
        <div class="bg-white shadow-lg rounded-2xl px-6 py-4">
            <ul class="inline-flex items-center space-x-2 text-base">

                {{-- First Page --}}
                @if (!$paginator->onFirstPage())
                    <li>
                        <a href="{{ $paginator->url(1) }}"
                           class="inline-flex items-center w-10 h-10 justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100"
                           aria-label="First">
                            «
                        </a>
                    </li>
                @endif

                {{-- Previous --}}
                @if (!$paginator->onFirstPage())
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}"
                           class="inline-flex items-center w-10 h-10 justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100"
                           aria-label="Previous">
                            ‹
                        </a>
                    </li>
                @endif

                {{-- Range --}}
                @php
                    $current = $paginator->currentPage();
                    $last = $paginator->lastPage();
                    $start = max($current - 2, 1);
                    $end = min($current + 2, $last);
                @endphp

                @for ($i = $start; $i <= $end; $i++)
                    <li>
                        @if ($i === $current)
                            <span class="inline-flex items-center w-10 h-10 justify-center rounded-xl text-white"
                                  style="background-color: var(--color-primary)">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $paginator->url($i) }}"
                               class="inline-flex items-center w-10 h-10 justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100">
                                {{ $i }}
                            </a>
                        @endif
                    </li>
                @endfor

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}"
                           class="inline-flex items-center w-10 h-10 justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100"
                           aria-label="Next">
                            ›
                        </a>
                    </li>
                @endif

                {{-- Last --}}
                @if ($current < $last)
                    <li>
                        <a href="{{ $paginator->url($last) }}"
                           class="inline-flex items-center w-10 h-10 justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100"
                           aria-label="Last">
                            »
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
@endif
