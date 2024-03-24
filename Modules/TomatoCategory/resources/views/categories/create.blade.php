<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Category')}}">
    <x-splade-form :default="['for' => array_keys(config('tomato-category.for'))[0]]" class="flex flex-col gap-4" action="{{route('admin.categories.store')}}" method="post">

        <x-splade-file filepond preview name="image" label="{{__('Image')}}" />

        <div class="grid grid-cols-2 gap-4">
            <x-splade-select choices label="{{__('For')}}" name="for" type="text"  placeholder="{{__('For')}}" >
                @foreach(config('tomato-category.for') as $key=>$type)
                    <option value="{{$key}}">{{$type[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? ""}}</option>
                @endforeach
            </x-splade-select>
            <x-splade-select label="{{__('Parent Category')}}" placeholder="{{__('Parent Category')}}" name="parent_id" remote-url="/admin/categories/api" remote-root="model.data" option-label=name option-value="id" choices/>


            <div class="col-span-2">
                <x-tomato-translation label="{{__('Name')}}" name="name" placeholder="{{__('Name')}}" />
            </div>
            <div class="col-span-2">
                <x-tomato-translation type="textarea" label="{{__('Description')}}" name="description"   placeholder="{{__('Description')}}" />
            </div>

            <div class="flex justifiy-between gap-4 col-span-2">
                <x-tomato-admin-icon class="w-full" label="{{__('Icon')}}" name="icon"  placeholder="{{__('Icon')}}" />
                <x-tomato-admin-color label="{{__('Color')}}" name="color"  placeholder="{{__('Color')}}" />
            </div>


            <x-splade-checkbox label="{{__('Active')}}" name="activated" />
            <x-splade-checkbox label="{{__('Show On Menu')}}" name="menu" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.categories.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
