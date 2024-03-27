<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Service') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button href="/admin/services/create">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Service')}}
        </x-tomato-admin-button>
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell activated>
                    <x-tomato-admin-row table :value="$item->activated" type="bool"/>
                </x-splade-cell>
                <x-splade-cell trend>
                    <x-tomato-admin-row table :value="$item->trend" type="bool"/>
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button type="icon" success modal title="{{trans('tomato-admin::global.crud.view')}}" href="{{ route('admin.services.show', $item->id) }}">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" warning title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.services.edit', $item->id) }}">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.services.destroy', $item->id) }}"
                                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                               class="px-2 text-red-500"
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
