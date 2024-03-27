<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Service') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row type="text" :label="__('Name')" :value="$model->name" />
        <x-tomato-admin-row type="text" :label="__('Description')" :value="$model->description" />
        <x-tomato-admin-row type="text" :label="__('Exp')" :value="$model->exp" />
        <x-tomato-admin-row type="icon" :label="__('Icon')" :value="$model->icon" />
    </div>

    <x-tomato-admin-submit-buttons table="skills" :model="$model" edit delete cancel />

</x-tomato-admin-container>
