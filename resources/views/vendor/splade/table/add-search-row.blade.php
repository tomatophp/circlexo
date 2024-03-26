<x-splade-component is="button-with-dropdown" dusk="add-search-row-dropdown" class="w-full bg-white border border-zinc-200 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:hover:bg-zinc-600  dark:bg-zinc-700 dark:border-zinc-600">
    <x-slot:button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </x-slot:button>

    @foreach($table->searchInputs() as $searchInput)
        @if($searchInput->key === 'global')
            @continue
        @endif

        <button
            class="text-left w-full px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900"
            @click.prevent="table.showSearchInput(@js($searchInput->key)); dropdown.hide()"
            dusk="add-search-row-{{ $searchInput->key }}">
            {{ $searchInput->label }}
        </button>
    @endforeach
</x-splade-component>
