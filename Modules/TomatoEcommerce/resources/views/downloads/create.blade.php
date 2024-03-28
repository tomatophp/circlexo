<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Download')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.downloads.store')}}" method="post">
        
          <x-splade-select :label="__('Account id')" :placeholder="__('Account id')" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Product id')" :placeholder="__('Product id')" name="product_id" remote-url="/admin/products/api" remote-root="model.data" option-label=name option-value="id" choices/>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.downloads.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
