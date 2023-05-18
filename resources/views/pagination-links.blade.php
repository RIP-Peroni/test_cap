@if ($paginator->hasPages())

<ul class="flex justify-between">
    {{-- prev page beginning --}}
    @if ($paginator->onFirstPage())
    <li class="w-16 px-2 py-1 text-center rounded border bg-gray-100">prev</li>
    @else
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="previousPage">prev</li>
    @endif
    {{-- prev page end --}}
    
    {{-- page numbers beginning --}}
    @foreach ($elements as $element)
    <div class="flex">
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-blue-500 text-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
        @else
        <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
        @endif
        @endforeach
        @endif
    </div>
    @endforeach
    {{-- page numbers end --}}

    {{-- next page beginning --}}
    @if ($paginator->onLastPage())
    <li class="w-16 px-2 py-1 text-center rounded border bg-gray-100">next</li>
    @else
    <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="nextPage">next</li>
    @endif
    {{-- next page end --}}
</ul>

@endif