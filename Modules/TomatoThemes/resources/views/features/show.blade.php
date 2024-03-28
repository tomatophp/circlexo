<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('features')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Title')" :value="$model->title" type="text" />

          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="text" />

          <x-tomato-admin-row :label="__('Icon')" :value="$model->icon" type="icon" />

          <x-tomato-admin-row :label="__('Icon color')" :value="$model->icon_color" type="icon" />

          <x-tomato-admin-row :label="__('Icon bg color')" :value="$model->icon_bg_color" type="icon" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.features.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.features.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.features.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
