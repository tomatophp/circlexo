<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Country')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.countries.store')}}" method="post">

        <x-tomato-translation name="translations" :label="__('Translations')" :placeholder="__('Translations')"/>


        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
          <x-splade-input :label="__('Code')" name="code" type="text"  :placeholder="__('Code')" />
          <x-splade-input :label="__('Phone')" :placeholder="__('Phone')" type='tel' name="phone" />
        <x-splade-input :label="__('Lat')" name="lat" type="number"  :placeholder="__('Lat')" />
        <x-splade-input :label="__('Lng')" name="lng" type="number"  :placeholder="__('Lng')" />

        <x-splade-checkbox :label="__('Is Active')" name="is_active" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.countries.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
