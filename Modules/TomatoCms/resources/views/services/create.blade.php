<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Service')}}">
    <x-splade-form class="flex flex-col gap-4"  action="{{route('admin.services.store')}}" method="post">
        <x-splade-select
            label="{{__('Page')}}"
            placeholder="{{__('Page')}}"
            name="page_id"
            remote-url="/admin/pages/api"
            remote-root="data"
            option-label="title[{{\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')}}]"
            option-value="id"
            choices
        />

        <x-splade-select
            label="{{__('Form')}}"
            placeholder="{{__('Form')}}"
            name="form_id"
            remote-url="/admin/forms/api"
            remote-root="data"
            option-label="name[{{\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')}}]"
            option-value="id"
            choices
        />

        <x-splade-file preview filepond class="col-span-2" name="icon" label="{{__('Icon')}}" />

        <x-tomato-translation label="{{__('Name')}}" @input="form.slug = form.name.en.replaceAll(' ', '-')" name="name" :placeholder="__('Name')" />
        <x-splade-input label="{{__('Slug')}}" name="slug" type="text"  placeholder="{{__('Slug')}}" />
        <x-splade-input label="{{__('Sku')}}" name="sku" type="text"  placeholder="{{__('Sku')}}" />
        <x-splade-input label="{{__('Rate')}}" type='number' name="rate" placeholder="{{__('Rate')}}" />

        <x-tomato-translation textarea label="{{__('Description')}}" name="short_description" :placeholder="__('Description')" />
        <x-tomato-translation textarea label="{{__('Keywords')}}" name="keywords" :placeholder="__('Keywords')" />

        <x-splade-checkbox label="{{__('Activated')}}" name="activated" />
        <x-splade-checkbox label="{{__('Trend')}}" name="trend" />

        <x-tomato-admin-submit-buttons table="services" save cancel />
    </x-splade-form>
</x-tomato-admin-container>
