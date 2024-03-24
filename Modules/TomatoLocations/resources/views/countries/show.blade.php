<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('countries')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />
          <x-tomato-admin-row :label="__('ISO 2')" :value="$model->code" type="string" />
          <x-tomato-admin-row :label="__('ISO 3')" :value="$model->iso3" type="string" />
          <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />
          <x-tomato-admin-row :label="__('Lat')" :value="$model->lat" type="number" />
          <x-tomato-admin-row :label="__('Lng')" :value="$model->lng" type="number" />
          <x-tomato-admin-row :label="__('Numeric Code')" :value="$model->numeric_code"  />
          <x-tomato-admin-row :label="__('Is Activated')" :value="$model->is_activated" type="bool" />
          <x-tomato-admin-row :label="__('Emoji')" :value="$model->emoji" />
          <x-tomato-admin-row :label="__('Currency Symbol')" :value="$model->currency_symbol" />
          <x-tomato-admin-row :label="__('Currency Name')" :value="$model->currency_name" />
          <x-tomato-admin-row :label="__('Currency')" :value="$model->currency" />
          <x-tomato-admin-row :label="__('Region')" :value="$model->region" />
          <x-tomato-admin-row :label="__('Native')" :value="$model->native" />
          <x-tomato-admin-row :label="__('TLD')" :value="$model->tld" />
          <x-tomato-admin-row :label="__('Capital')" :value="$model->capital" />
          <x-tomato-admin-row :label="__('Nationality')" :value="$model->nationality" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.countries.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.countries.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.countries.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
