<x-splade-component is="button-with-dropdown" dusk="bulk-actions-exports-dropdown" v-bind:close-on-click="true" class="w-full bg-white border border-zinc-200 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:hover:bg-zinc-600  dark:bg-zinc-700 dark:border-zinc-600">
    <x-slot:button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-zinc-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
        </svg>
    </x-slot:button>

    <div class="min-w-max bg-white dark:bg-zinc-700  overflow-hidden">
        <div class="flex flex-col">

            @if($table->hasExports())
                <h3 class="text-xs uppercase tracking-wide bg-zinc-100 dark:bg-zinc-800 px-4 py-2 border-b border-zinc-200 dark:border-zinc-600">
                    {{ __('Export results') }}
                </h3>
            @endif

            @foreach($table->getExports() as $export)
                <a
                    download
                    class="text-left w-full px-4 py-2 text-sm text-zinc-700 dark:text-white dark:hover:bg-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 font-normal"
                    href="{{ $export->getUrl() }}"
                    dusk="action.{{ $export->getSlug() }}">
                    {{ $export->label }}
                </a>
            @endforeach

            @if(isset($actions))
                <h3 class="text-xs uppercase tracking-wide bg-zinc-100 dark:bg-zinc-800 px-4 py-2 border-b border-zinc-200 dark:border-zinc-600">
                    {{ __('Actions') }}
                </h3>
                {!! $actions !!}
            @endif

        </div>
    </div>
</x-splade-component>
