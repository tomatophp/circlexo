<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} UserNotification #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="trans('tomato-notifications::global.notifications.model_type')" :value="$model->model ? $model->model->name : null" type="string" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.notifications.subject')" :value="$model->title" type="string" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.logs.provider')" :value="$model->provider" type="string" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.logs.since')" :value="$model->created_at->diffForHumans()" type="string" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.body')" :value="$model->description" type="string" />
        <x-tomato-admin-row :label="trans('tomato-notifications::global.templates.type')" :value="$model->type" type="string" />
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button danger :href="route('admin.notifications-logs.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.notifications-logs.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
