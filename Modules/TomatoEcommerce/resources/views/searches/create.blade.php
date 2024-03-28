<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Search')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.searches.store')}}" method="post">
        
          <x-splade-input :label="__('Search')" name="search" type="text"  :placeholder="__('Search')" />
          

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.searches.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
