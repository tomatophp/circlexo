<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Service') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row type="text" :label="__('Name')" :value="$model->name" />
        <x-tomato-admin-row type="text" :label="__('Slug')" :value="$model->slug" />
        <x-tomato-admin-row type="text" :label="__('Sku')" :value="$model->sku" />
        <x-tomato-admin-row type="text" :label="__('Rate')" :value="$model->rate" />
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Body')" :value="$model->body" />
        </div>
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Short description')" :value="$model->short_description" />
        </div>
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Keywords')" :value="$model->keywords" />
        </div>
        <x-tomato-admin-row type="bool" :label="__('Activated')" :value="$model->activated" />
        <x-tomato-admin-row type="bool" :label="__('Trend')" :value="$model->trend" />
        <x-tomato-admin-row type="number" :label="__('Views')" :value="$model->views" />
    </div>

    <x-tomato-admin-submit-buttons table="services" :model="$model" edit delete cancel />
</x-tomato-admin-container>
