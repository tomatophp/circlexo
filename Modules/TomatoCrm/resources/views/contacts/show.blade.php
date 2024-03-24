<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Contact') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Type')" :value="$model->type?->name" type="text" />
        <x-tomato-admin-row :label="__('Status')" :value="$model->status?->name" type="text" />
        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text" />
        <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="email" />
        <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />
        <x-tomato-admin-row :label="__('Subject')" :value="$model->subject" type="text" />
        <x-tomato-admin-row :label="__('Message')" :value="$model->message" type="text" />
        <x-tomato-admin-row :label="__('Is Active?')" :value="$model->active" type="bool" />
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button
            danger
            :href="route('admin.contacts.destroy', $model->id)"
            title="{{trans('tomato-admin::global.crud.edit')}}"
            confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
            confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
            confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
            cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
            class="px-2 text-red-500"
            method="delete"
        >
            {{__('Delete')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button secondary :href="route('admin.contacts.index')" label="{{__('Cancel')}}"/>
    </div>

</x-tomato-admin-container>
