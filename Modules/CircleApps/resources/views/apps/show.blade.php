<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('App')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
          <x-tomato-admin-row :label="__('Account')" :value="$model->Account->id" type="text" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Key')" :value="$model->key" type="string" />

          <x-tomato-admin-row :label="__('Readme')" :value="$model->readme" type="rich" />

          <x-tomato-admin-row :label="__('Homepage')" :value="$model->homepage" type="string" />

          <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="string" />

          <x-tomato-admin-row :label="__('Docs')" :value="$model->docs" type="string" />

          <x-tomato-admin-row :label="__('Github')" :value="$model->github" type="string" />

          <x-tomato-admin-row :label="__('Privacy')" :value="$model->privacy" type="string" />

          <x-tomato-admin-row :label="__('Faq')" :value="$model->faq" type="string" />

          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

          <x-tomato-admin-row :label="__('Is active')" :value="$model->is_active" type="bool" />

          <x-tomato-admin-row :label="__('Price')" :value="$model->price" type="number" />

          <x-tomato-admin-row :label="__('Discount')" :value="$model->discount" type="number" />

          <x-tomato-admin-row :label="__('Discount to')" :value="$model->discount_to" type="text" />

          <x-tomato-admin-row :label="__('Is free')" :value="$model->is_free" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.apps.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.apps.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.apps.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
