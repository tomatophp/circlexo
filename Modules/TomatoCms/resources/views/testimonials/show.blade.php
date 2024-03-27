<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Testimonial') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        @if (config("tomato-cms.features.services"))
        <x-tomato-admin-row type="text" :label="__('Service')" :value="$model->service->name" />
        @endif

        <x-tomato-admin-row type="text" :label="__('Name')" :value="$model->name" />
        <x-tomato-admin-row type="text" :label="__('Position')" :value="$model->position" />
        <x-tomato-admin-row type="text" :label="__('Company')" :value="$model->company" />
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Comment')" :value="$model->comment" />
        </div>
        <x-tomato-admin-row type="text" :label="__('Rate')" :value="$model->rate" />
    </div>

    <x-tomato-admin-submit-buttons table="testimonials" :model="$model" edit delete cancel />

</x-tomato-admin-container>
