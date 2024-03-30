<x-splade-modal>
    <x-slot:title>
        {{__('Edit Group')}} {{$model->name}}
    </x-slot:title>
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.groups.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-textarea :label="__('Description')" name="description" :placeholder="__('Description')" autosize />
        <div class="flex justify-between gap-4">
            <x-tomato-admin-icon class="w-full" :label="__('Icon')" :placeholder="__('Icon')" name="icon" />
            <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" name="color" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('profile.groups.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-splade-modal>
