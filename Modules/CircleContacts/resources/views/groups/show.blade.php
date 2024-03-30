<x-splade-modal>
    <x-slot:title>
        {{__('Show Group')}} {{$model->name}}
    </x-slot:title>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

        <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="text" />

        <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

        <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('profile.groups.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('profile.groups.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
    </div>
</x-splade-modal>
