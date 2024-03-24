<x-tomato-admin-layout>
    <x-slot:header name="header">
        {{trans('tomato-locations::global.area.title')}}
    </x-slot:header>

    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.areas.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Area')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell city.name>
                    <x-splade-link href="{{url('admin/areas?city_id='. $item->city?->id)}}">
                        <x-tomato-admin-row table type="text" :value="$item->city?->name"  />
                    </x-splade-link>
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')
                        }}" modal :href="route('admin.areas.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')
                        }}" modal :href="route('admin.areas.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete') }}" :href="route('admin.areas.destroy', $item->id)"
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
