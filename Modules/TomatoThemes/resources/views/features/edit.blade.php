<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Feature')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.features.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input :label="__('Title-EN')" :placeholder="__('Title-en')" name="title.en" type='text' />
        <x-splade-input :label="__('Title-AR')" :placeholder="__('Title-ar')" name="title.ar" type='text' />
        <x-splade-input :label="__('Description-EN')" :placeholder="__('Description-en')" name="description.en" type='text' />
        <x-splade-input :label="__('Description-AR')" :placeholder="__('Description-ar')" name="description.ar" type='text' />
        <x-splade-input :label="__('Icon')" name="icon" type="text"  :placeholder="__('Icon')" />
        <x-tomato-admin-color :label="__('Icon color')" name="icon_color"   :placeholder="__('Icon color')" />
        <x-tomato-admin-color :label="__('Icon bg color')" name="icon_bg_color"  :placeholder="__('Icon bg color')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.features.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.features.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
