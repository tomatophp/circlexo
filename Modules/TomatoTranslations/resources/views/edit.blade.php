<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{trans('tomato-translations::global.single')}} #{{$model['id']}}">
    <x-splade-form class="flex flex-col gap-4" action="{{route('admin.translations.update', $model['id'])}}" method="post" :default="$model">
        <x-splade-textarea class="w-full" name="key" type="text"  placeholder="{{trans('tomato-translations::global.key')}}" label="{{trans('tomato-translations::global.key')}}" :disabled="true"/>
        @php
            $jsonFolder = File::files(lang_path());
            $counter = 0;
            $langRows = [];
        @endphp
        @foreach($jsonFolder as $getLangName)
            @php $langName = str_replace('.json', '', $getLangName->getFilename()); @endphp

            <x-splade-textarea class="w-full" name="{{$langName}}" type="text"  placeholder="{{trans('tomato-translations::global.'.$langName)}}" label="{{trans('tomato-translations::global.'.$langName)}}" />
        @endforeach

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.translations.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
