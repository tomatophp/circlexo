<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Type')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.types.store')}}" method="post" :default="[
        'for' => array_keys(config('tomato-category.for'))[0],
        'type' => array_keys(config('tomato-category.types'))[0]
    ]">

        <x-splade-file filepond preview name="image" label="{{__('Image')}}" />

        <x-splade-select choices label="{{__('For')}}" name="for" type="text"  placeholder="{{__('For')}}" >
            @foreach(config('tomato-category.for') as $key=>$for)
                <option value="{{$key}}">{{$for[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? ""}}</option>
            @endforeach
        </x-splade-select>

        <x-splade-select choices label="{{__('Type')}}" name="type" type="text"  placeholder="{{__('Type')}}" >
            @foreach(config('tomato-category.types') as $key=>$type)
                <option value="{{$key}}">{{$type[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? ""}}</option>
            @endforeach
        </x-splade-select>

        <div class="grid grid-cols-2 gap-4">
            <x-tomato-translation label="{{__('Name')}}" placeholder="{{__('Name')}}" name="name" />
            <x-tomato-translation label="{{__('Description')}}" placeholder="{{__('Description')}}" name="description" />
            <x-splade-input class="col-span-2" label="{{__('Key')}}" name="key" type="text"  placeholder="{{__('Key')}}" />
        </div>

        <div class="flex justifiy-between gap-4">
            <x-tomato-admin-icon class="w-full" label="{{__('Icon')}}" name="icon"  placeholder="{{__('Icon')}}" />
            <x-tomato-admin-color label="{{__('Color')}}" name="color"  placeholder="{{__('Color')}}" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.types.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
