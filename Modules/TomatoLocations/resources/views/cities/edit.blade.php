<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('City')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.cities.update', $model->id)}}" method="post" :default="$model">

        <x-splade-select
            choices
            :label="__('Country')"
            name="country_id"
            :placeholder="__('Country')"
            remote-url="/admin/countries/api"
            remote-root="data"
            option-label="name"
            option-value="id"
        />

        <x-tomato-translation name="translations" :label="__('Translations')" :placeholder="__('Translations')"/>

          <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />

        <x-splade-input :label="__('Lat')" name="lat" type="number"  :placeholder="__('Lat')" />
        <x-splade-input :label="__('Lng')" name="lng" type="number"  :placeholder="__('Lng')" />

        <x-splade-checkbox :label="__('Is Active')" name="is_active" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.cities.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.cities.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
