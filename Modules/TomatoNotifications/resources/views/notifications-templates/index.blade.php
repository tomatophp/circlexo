<x-tomato-admin-layout>
    <x-slot:header>
        {{ trans('tomato-notifications::global.templates.title') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" href="/admin/notifications-templates/create" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{ trans('tomato-notifications::global.templates.single') }}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
            <x-splade-table :for="$table" striped>
                <x-splade-cell actions>
                    <div class="flex justify-start">

                        <x-tomato-admin-button  confirm type="icon" title="{{__('Send')}}" modal :href="route('admin.notifications-templates.send', $item->id)">
                            <x-heroicon-s-paper-airplane class="h-6 w-6"/>
                        </x-tomato-admin-button>


                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.notifications-templates.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>

                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.notifications-templates.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>

                        <x-tomato-admin-button :href="route('admin.notifications-templates.destroy', $item->id)"
                              confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                              confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                              confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                              cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                              method="delete"
                                               type="icon"
                                               danger

                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
</x-tomato-admin-layout>
