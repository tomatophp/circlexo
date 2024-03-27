<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Service')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.services.update', $model->id)}}" method="post" :default="$model">
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

        <x-splade-checkbox label="{{__('Activated')}}" name="activated" label="Activated" />
        <x-splade-checkbox label="{{__('Trend')}}" name="trend" label="Trend" />

        <x-tomato-admin-submit-buttons table="services" :model="$model" save delete cancel />
    </x-splade-form>
</x-tomato-admin-container>
