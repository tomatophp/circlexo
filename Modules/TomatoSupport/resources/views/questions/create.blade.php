<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Question')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.questions.store')}}" method="post">
        <x-splade-select :label="__('Category')" :placeholder="__('Category')" name="type_id" remote-url="/admin/types/api?for=faq&type=category" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id" choices/>

        <x-tomato-translation label="{{__('Qa')}}" name="qa" :placeholder="__('Qa')" />
        <x-tomato-translation textarea label="{{__('Answer')}}" name="answer" :placeholder="__('Answer')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.questions.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
