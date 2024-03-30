<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('App') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.apps.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('App')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell email>
                    <x-tomato-admin-row table type="email" :value="$item->email" />
                </x-splade-cell>
                <x-splade-cell is_active>
                    <x-tomato-admin-row table type="bool" :value="$item->is_active" />
                </x-splade-cell>
                <x-splade-cell price>
                    <x-tomato-admin-row table type="number" :value="$item->price" />
                </x-splade-cell>
                <x-splade-cell discount>
                    <x-tomato-admin-row table type="number" :value="$item->discount" />
                </x-splade-cell>
                <x-splade-cell is_free>
                    <x-tomato-admin-row table type="bool" :value="$item->is_free" />
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <a href="{{ route('admin.apps.download', $item->id) }}"  class="px-2 cursor-pointer transition-colors ease-in-out duration-20 text-success-500 hover:text-success-400">
                            <x-heroicon-s-arrow-down-circle class="h-6 w-6"/>
                        </a>
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.apps.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" :href="route('admin.apps.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.apps.destroy', $item->id)"
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
