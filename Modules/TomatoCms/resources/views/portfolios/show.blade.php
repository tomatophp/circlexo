<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Portfolio') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row type="text" :label="__('Service')" :value="@$model->service->name" />
        <x-tomato-admin-row type="text" :label="__('Title')" :value="$model->title" />
        <x-tomato-admin-row type="text" :label="__('Short description')" :value="$model->short_description" />
        <x-tomato-admin-row type="text" :label="__('Keywords')" :value="$model->keywords" />
        <x-tomato-admin-row type="text" :label="__('Company')" :value="$model->company" />
        <x-tomato-admin-row type="bool" :label="__('Activated')" :value="$model->activated" />
        <x-tomato-admin-row type="text" :label="__('Views')" :value="$model->views" />
    </div>

    <x-tomato-admin-submit-buttons table="portfolios" :model="$model" edit delete cancel />
</x-tomato-admin-container>
