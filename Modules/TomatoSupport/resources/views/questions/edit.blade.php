<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Question')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.questions.update', $model->id)}}" method="post" :default="$model">

        <x-splade-select :label="__('Category')" :placeholder="__('Category')" name="type_id" remote-url="/admin/types/api?for=faq&type=category" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id" choices/>

        <x-tomato-translation label="{{__('Qa')}}" name="qa" :placeholder="__('Qa')" />
        <x-tomato-translation textarea label="{{__('Answer')}}" name="answer" :placeholder="__('Answer')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.questions.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.questions.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
