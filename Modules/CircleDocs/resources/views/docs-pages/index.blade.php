<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('CircleXoDocsPage') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.circle-xo-docs-pages.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('CircleXoDocsPage')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell parent_id>
    <x-tomato-admin-row table type="number" :value="$item->parent_id" />
</x-splade-cell>
<x-splade-cell icon>
    <x-tomato-admin-row table type="icon" :value="$item->icon" />
</x-splade-cell>
<x-splade-cell color>
    <x-tomato-admin-row table type="color" :value="$item->color" />
</x-splade-cell>
<x-splade-cell doc_id>
    <x-tomato-admin-row table type="number" :value="$item->doc_id" />
</x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.circle-xo-docs-pages.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.circle-xo-docs-pages.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.circle-xo-docs-pages.destroy', $item->id)"
                           confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                           confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                           confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                           cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                           method="delete"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
