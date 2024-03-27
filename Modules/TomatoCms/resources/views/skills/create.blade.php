<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Skill')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.skills.store')}}" method="post">
        <x-splade-file filepond preview label="{{__('Image')}}" name="image"  placeholder="Image" />

        <x-tomato-translation  class="col-span-2" label="{{__('Name')}}" name="name" type="text"  placeholder="{{__('Name')}}" />

        <x-tomato-translation textarea class="col-span-2" label="{{__('Description')}}" name="description"  placeholder="{{__('Description')}}" />


        <x-splade-input label="{{__('Exp')}}" type='number' name="exp" placeholder="{{__('Exp')}}" />
        <x-tomato-admin-icon label="{{__('Icon')}}" name="icon" placeholder="{{__('Icon')}}" />
        <x-splade-textarea label="{{__('URL')}}" name="url" placeholder="{{__('URL')}}" autosize />

        <x-tomato-admin-submit-buttons table="skills" save cancel />
    </x-splade-form>

</x-tomato-admin-container>
