<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Comment') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row :value="$model->account?->name" :label="__('Author')" type="text" />
        <x-tomato-admin-row :value="$model->post?->title" :label="__('Post')" type="text" />
        <x-tomato-admin-row :value="$model->activated" :label="__('Activated')" type="bool" />
        <div class="col-span-2">
            <x-tomato-admin-row :value="$model->comment" :label="__('Comment')" type="text" />
        </div>
    </div>
</x-tomato-admin-container>
