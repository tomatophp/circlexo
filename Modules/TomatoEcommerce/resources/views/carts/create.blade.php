<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Cart')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.carts.store')}}" method="post">
        
          <x-splade-select :label="__('Account id')" :placeholder="__('Account id')" name="account_id" remote-url="/admin/accounts/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-select :label="__('Product id')" :placeholder="__('Product id')" name="product_id" remote-url="/admin/products/api" remote-root="model.data" option-label=name option-value="id" choices/>
          <x-splade-input :label="__('Session id')" name="session_id" type="text"  :placeholder="__('Session id')" />
          <x-splade-input :label="__('Item')" name="item" type="text"  :placeholder="__('Item')" />
          <x-splade-input :label="__('Price')" :placeholder="__('Price')" type='number' name="price" />
          <x-splade-input :label="__('Discount')" :placeholder="__('Discount')" type='number' name="discount" />
          <x-splade-input :label="__('Vat')" :placeholder="__('Vat')" type='number' name="vat" />
          <x-splade-input :label="__('Qty')" :placeholder="__('Qty')" type='number' name="qty" />
          <x-splade-input :label="__('Total')" :placeholder="__('Total')" type='number' name="total" />
          <x-splade-textarea :label="__('Note')" name="note" :placeholder="__('Note')" autosize />
          
          <x-splade-checkbox :label="__('Is active')" name="is_active" label="Is active" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.carts.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
