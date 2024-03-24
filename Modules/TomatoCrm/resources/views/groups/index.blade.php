<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Groups') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button modal href="{{ route('admin.groups.create') }}">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Group')}}
        </x-tomato-admin-button>
    </x-slot:buttons>
    <x-slot:icon>
        bx bxs-group
    </x-slot:icon>

    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell name>
                    <x-splade-link modal href="{{url('admin/accounts?group_id='. $item->id)}}" style="color: {{$item->color}}">
                        <div class="flex justify-start gap-2">
                            <div>
                                <i class="{{$item->icon}}"></i>
                            </div>
                            <div>
                                {{$item->name}}
                            </div>
                        </div>
                    </x-splade-link>
                </x-splade-cell>
                <x-splade-cell color><x-tomato-admin-row table type="color" value="{{$item->color}}" /></x-splade-cell>
                <x-splade-cell icon><x-tomato-admin-row table type="icon" value="{{$item->icon}}" /></x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start qts_tooltip">
                        <x-tomato-admin-button type="icon" success modal title="{{trans('tomato-admin::global.crud.view')}}" href="{{ route('admin.groups.show', $item->id) }}">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" warning modal title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.groups.edit', $item->id) }}">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>

                        <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.groups.destroy', $item->id) }}"
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
