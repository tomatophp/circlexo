<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Photo') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Photo')" :value="$model->photo" type="image"/>
        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text"/>
        <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="text"/>
        <x-tomato-admin-row :label="__('Alt')" :value="$model->alt" type="text"/>
        <x-tomato-admin-row :label="__('By')" :value="$model->by" type="text"/>
        <x-tomato-admin-row :label="__('Url')" :value="$model->url" type="text"/>
        <x-tomato-admin-row :label="__('Views')" :value="$model->views" type="number"/>
        <x-tomato-admin-row :label="__('Activated')" :value="$model->activated" type="bool"/>
    </div>

    <x-tomato-admin-submit-buttons table="photos" :model="$model" cancel edit delete />
</x-tomato-admin-container>
