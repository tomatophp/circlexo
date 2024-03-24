
<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ trans('tomato-notifications::global.templates.single') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.image')" :value="$model->getMedia('image')->first() ? $model->getMedia('image')->first()->getUrl() : url('placeholder.webp')" type="image" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.name')" :value="$model->name" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.key')" :value="$model->key" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.body')" :value="$model->body" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.title')" :value="$model->title" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.url')" :value="$model->url" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.type')" :value="$model->type" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.action')" :value="$model->action" />
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.notifications-templates.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.notifications-templates.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.notifications-templates.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
