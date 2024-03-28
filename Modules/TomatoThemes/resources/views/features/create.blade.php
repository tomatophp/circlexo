<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Feature')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.features.store')}}" method="post" :default="['icon_color' => '#fff', 'icon_bg_color' => '#FE0000']">

          <x-tomato-translation :label="__('Title')" :placeholder="__('Title')" name="title" />
          <x-tomato-translation  :label="__('Description')" :placeholder="__('Description')" name="description" type='textarea' />
          <x-tomato-admin-icon :label="__('Icon')" name="icon"  :placeholder="__('Icon')" />
          <x-tomato-admin-color :label="__('Icon color')" name="icon_color"   :placeholder="__('Icon color')" />
          <x-tomato-admin-color :label="__('Icon bg color')" name="icon_bg_color"  :placeholder="__('Icon bg color')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.features.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
