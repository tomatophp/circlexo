<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{trans('tomato-locations::global.area.single')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.areas.update', $model->id)}}" method="post" :default="$model">

        <x-splade-select remote-url="/admin/countries/api" remote-root="data" option-label="name" option-value="id"  name="country_id" label="{{__('Country')}}" choices/>
        <x-splade-select v-bind:disabled="!form.country_id" remote-url="`/admin/cities/api?country_id=${form.country_id}`" remote-root="data" option-label="name" option-value="id"  name="city_id" label="{{trans('tomato-locations::global.area.city')}}" choices/>


        <x-tomato-translation name="translations" :label="__('Translations')" :placeholder="__('Translations')"/>


        <x-splade-input name="name" label="{{__('Name')}}" type="text"  placeholder="{{trans('tomato-locations::global.area.name')}}" />

        <x-splade-input :label="__('Lat')" name="lat" type="number"  :placeholder="__('Lat')" />
        <x-splade-input :label="__('Lng')" name="lng" type="number"  :placeholder="__('Lng')" />
        <x-splade-checkbox :label="__('Is Active')" name="is_active" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.areas.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.areas.index')" label="{{__('Cancel')}}"/>
        </div>    </x-splade-form>
</x-tomato-admin-container>
