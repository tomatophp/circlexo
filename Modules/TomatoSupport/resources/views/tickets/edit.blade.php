<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Ticket')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.tickets.update', $model->id)}}" method="post" :default="$model">

        <div class="grid grid-cols-2 gap-4">
            <x-splade-select choices :label="__('Account')" name="accountable_id"   :placeholder="__('Account')"
                             remote-root="data"
                             remote-url="{{route('admin.accounts.api')}}"
                             option-value="id"
                             option-label="name"
            />

            <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
            <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />

            <x-splade-input :label="__('Subject')" name="subject" type="text"  :placeholder="__('Subject')" />
            <x-splade-textarea class="col-span-2" :label="__('Message')" name="message" :placeholder="__('Message')" autosize />

            <x-splade-select class="col-span-2" :label="__('Status')" :placeholder="__('Status')" name="type_id" remote-url="/admin/types/api?for=tickets&type=status" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id" choices/>
            <x-splade-checkbox :label="__('Is closed')" name="is_closed" label="Is closed" />

        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.tickets.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.tickets.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
