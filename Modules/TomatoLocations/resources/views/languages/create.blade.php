<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Language')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.languages.store')}}" method="post">
        <x-tomato-translation name="translations" :label="__('Translations')" :placeholder="__('Translations')"/>

        <x-splade-input :label="__('Iso')" name="iso" type="text"  :placeholder="__('Iso')" />
        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Arabic')" name="arabic" type="text"  :placeholder="__('Arabic')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.languages.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
