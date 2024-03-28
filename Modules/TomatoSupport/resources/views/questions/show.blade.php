<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Questions')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Type')" :value="$model->type?->name" type="text" />
          <x-tomato-admin-row :label="__('QA')" :value="$model->qa" type="text" />
          <x-tomato-admin-row :label="__('Answer')" :value="$model->answer" type="text" />



    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.questions.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.questions.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.questions.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
