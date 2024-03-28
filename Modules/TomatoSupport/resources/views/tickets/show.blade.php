<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Tickets')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

          <x-tomato-admin-row :label="__('Status')" :value="$model->type?->name" type="text" />

          <x-tomato-admin-row :label="__('Account')" :value="$model->accountable?->name" type="string" />

          <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

          <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />

          <x-tomato-admin-row :label="__('Subject')" :value="$model->subject" type="string" />

          <x-tomato-admin-row :label="__('Code')" :value="$model->code" type="string" />

            <div class="col-span-2">
                <x-tomato-admin-row  :label="__('Message')" :value="$model->message" type="rich" />
            </div>

          <x-tomato-admin-row :label="__('Last update')" :value="$model->last_update" type="text" />

          <x-tomato-admin-row :label="__('Is closed')" :value="$model->is_closed" type="bool" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.tickets.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.tickets.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.tickets.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
