<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-forms::global.form.title')}}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.forms.create')">
            {{trans('tomato-admin::global.crud.create-new')}} {{trans('tomato-forms::global.form.single')}}
        </x-tomato-admin-button>
    </x-slot:buttons>


    <div class="pb-12" v-cloak>
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell is_active>
                    <div class="text-center">
                        @if($item->is_active)
                            <x-heroicon-s-check-circle class="text-green-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                        @else
                            <x-heroicon-s-x-circle class="text-red-600 h-8 w-8 ltr:mr-2 rtl:ml-2"/>
                        @endif
                    </div>
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">

                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" :href="route('admin.forms.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{__('Build')}}" :href="route('admin.form-requests.index') . '?form-requests?filter[form_id]='. $item->id">
                            <x-heroicon-s-chat-bubble-bottom-center class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button type="icon" title="{{__('Build')}}" :href="route('admin.forms.build', $item->id)">
                            <x-heroicon-s-home-modern class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}"  :href="route('admin.forms.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.forms.destroy', $item->id)"
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
