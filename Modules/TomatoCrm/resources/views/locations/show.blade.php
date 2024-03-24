<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Location') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Account')" :value="$model->account->name"/>
        <x-tomato-admin-row :label="__('Street')" :value="$model->street"/>
        <x-tomato-admin-row :label="__('Area')" :value="$model->area?->name"/>
        <x-tomato-admin-row :label="__('City')" :value="$model->city?->name"/>
        <x-tomato-admin-row :label="__('Country')" :value="$model->country?->name"/>
        <x-tomato-admin-row :label="__('Home number')" :value="$model->home_number"/>
        <x-tomato-admin-row :label="__('Flat number')" :value="$model->flat_number"/>
        <x-tomato-admin-row :label="__('Floor number')" :value="$model->floor_number"/>
        <x-tomato-admin-row :label="__('Zip')" :value="$model->zip"/>
        <x-tomato-admin-row :label="__('Mark')" :value="$model->mark"/>
        <x-tomato-admin-row :label="__('Map url')" :value="$model->map_url"/>
        <x-tomato-admin-row :label="__('Note')" :value="$model->note"/>
        <x-tomato-admin-row :label="__('Is Main')" :value="$model->is_main" type="bool"/>
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning :href="route('admin.locations.edit', $model->id)" label="{{__('Edit')}}" />
        <x-tomato-admin-button
            danger
            :href="route('admin.locations.destroy', $model->id)"
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
        <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
