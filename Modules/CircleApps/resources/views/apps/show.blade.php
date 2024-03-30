<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('App')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Account')" :value="$model->account?->id" type="text" />

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

        <div>
            <div class="flex items-center justify-between gap-x-3">
                <dt class="inline-flex items-center gap-x-3">
                    <span class="text-sm font-medium leading-6 text-zinc-950 dark:text-white">{{ __('Module Files') }}</span>
                </dt>
            </div>
            <div class="grid gap-y-2">
                <div class="flex fi-in-text">
                    <div class="min-w-0 flex-1">
                        <div class="inline-flex items-center gap-1.5 text-sm leading-6 text-zinc-950 dark:text-white">
                            <a href="{{ route('admin.apps.download', $model->id) }}"  class="px-2 cursor-pointer transition-colors ease-in-out duration-20 text-success-500 hover:text-success-400">
                                <x-heroicon-s-arrow-down-circle class="h-6 w-6"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



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
