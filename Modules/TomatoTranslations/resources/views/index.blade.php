<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-translations::global.title')}}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.translations.scan')" type="link">
            {{trans('tomato-translations::global.scan')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button :href="route('admin.translations.auto')" type="link">
            {{trans('tomato-translations::global.auto')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button modal :href="route('admin.translations.importView')" type="link">
            {{trans('tomato-translations::global.import')}}
        </x-tomato-admin-button>
        <a class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent" target="_blank" href="{{route('admin.translations.export')}}">
            {{trans('tomato-translations::global.export')}}
        </a>
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button modal title="{{trans('tomato-translations::global.translate')}}" type="icon" :href="route('admin.translations.edit', $item->id)">
                            <x-heroicon-o-language class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
