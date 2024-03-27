<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Testimonial')}}">
    <x-splade-form class="flex flex-col gap-4" action="{{route('admin.testimonials.store')}}" method="post">
        @if (config("tomato-cms.features.services"))
            <x-splade-select label="{{__('Service')}}" placeholder="{{__('Service')}}" name="service_id" remote-url="/admin/services/api" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id" choices/>
        @endif

        <x-tomato-translation class="col-span-2" label="{{__('Name')}}" name="name" type="text"  placeholder="{{__('Name')}}" />

        <x-tomato-translation class="col-span-2" label="{{__('Position')}}" name="position" type="text"  placeholder="{{__('Position')}}" />

        <x-tomato-translation class="col-span-2" label="{{__('Company')}}" name="company" type="text"  placeholder="{{__('Company')}}" />

        <x-tomato-translation textarea textarea class="col-span-2" label="{{__('Comment')}}" name="comment" placeholder="{{__('Comment')}}" autosize />

        <x-splade-input label="{{__('Rate')}}" type='number' name="rate" placeholder="{{__('Rate')}}" />

        <x-tomato-admin-submit-buttons table="testimonials" save cancel />

    </x-splade-form>

</x-tomato-admin-container>
