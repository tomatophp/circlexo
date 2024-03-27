<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Portfolio')}} #{{$model->id}}">

    <x-splade-form class="flex flex-col space-y-4"  action="{{route('admin.portfolios.update', $model->id)}}" method="post" :default="$model">
        <x-splade-file filepond preview name="feature" label="{{__('Featured Image')}}" />
        <x-splade-file filepond preview name="images[]" label="{{__('Images')}}"  multiple />

        <x-splade-select label="{{__('Service')}}" placeholder="{{__('Service')}}" name="service_id" remote-url="/admin/services/api" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id" choices/>

        <x-tomato-translation  class="col-span-2" label="{{__('Title')}}" name="title" type="text"  placeholder="{{__('Title')}}" />
        <x-tomato-translation  class="col-span-2" label="{{__('Company')}}" name="company" type="text"  placeholder="{{__('Company')}}" />
        <div class="col-span-2" >
            <x-tomato-translation  name="body[ar]" label="{{__('Body')}}" />
        </div>
        <x-tomato-translation textarea  class="col-span-2" label="{{__('Short Description')}}" name="short_description" type="text"  placeholder="{{__('Short Description')}}" />
        <x-tomato-translation textarea class="col-span-2" label="{{__('Keywords')}}" name="keywords" placeholder="{{__('Keywords')}}" autosize />

        <x-splade-checkbox label="{{__('Activated')}}" name="activated" />

        <x-tomato-admin-submit-buttons table="portfolios" :model="$model" save cancel delete />
    </x-splade-form>

</x-tomato-admin-container>
