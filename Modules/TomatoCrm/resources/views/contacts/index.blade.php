<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Contact') }}
    </x-slot:header>
    <x-slot:icon>
        bx bxs-phone
    </x-slot:icon>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell active>
                    <x-tomato-admin-row table type="bool" :value="$item->active" />
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        @if($item->active)
                            <x-tomato-admin-button danger type="icon" :href="route('admin.contacts.close', $item->id)" method="POST" confirm>
                                <x-tomato-admin-tooltip :text="__('Close Case')">
                                        <x-heroicon-s-x-circle class="h-6 w-6"/>
                                </x-tomato-admin-tooltip>
                            </x-tomato-admin-button>
                        @endif
                        <x-tomato-admin-button type="icon" :href="route('admin.contacts.show', $item->id)" modal>
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon"
                           confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                           confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                           confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                           cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                           :href="route('admin.contacts.destroy', $item->id)"
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
