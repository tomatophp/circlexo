<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Category')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.categories.update', $model->id)}}" method="post" :default="$model">
        <x-splade-file filepond preview name="image" label="{{__('Image')}}" />

        <div class="grid grid-cols-2 gap-4">
            <x-splade-select choices label="{{__('For')}}" name="for" type="text"  placeholder="{{__('For')}}" >
                @foreach(config('tomato-category.for') as $key=>$type)
                    <option value="{{$key}}">{{$type[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? ""}}</option>
                @endforeach
            </x-splade-select>
            <x-splade-select label="{{__('Parent Category')}}" placeholder="{{__('Parent Category')}}" name="parent_id" remote-url="/admin/categories/api" remote-root="data" option-label=name option-value="id" choices/>


            <div class="col-span-2">
                <x-tomato-translation  label="{{__('Name')}}" name="name"   placeholder="{{__('Name')}}" />
            </div>
            <div class="col-span-2">
                <x-tomato-translation type="textarea" label="{{__('Description')}}" name="description"   placeholder="{{__('Description')}}" />
            </div>

            <x-splade-input class="col-span-2" label="{{__('Slug')}}" name="slug" type="text"  placeholder="{{__('Slug')}}" />
            <div class="flex justifiy-between gap-4 col-span-2">
                <x-tomato-admin-icon class="w-full" label="{{__('Icon')}}" name="icon"  placeholder="{{__('Icon')}}" />
                <x-tomato-admin-color label="{{__('Color')}}" name="color"  placeholder="{{__('Color')}}" />
            </div>


            <x-splade-checkbox label="{{__('Active')}}" name="activated" />
            <x-splade-checkbox label="{{__('Show On Menu')}}" name="menu" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button
                danger
                :href="route('admin.categories.destroy', $model->id)"
                title="{{trans('tomato-admin::global.crud.edit')}}"
                confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                class="px-2 text-red-500"
                method="delete"
            >
                {{__('Delete')}}
            </x-tomato-admin-button>
            <x-tomato-admin-button secondary :href="route('admin.categories.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
