<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Currency')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.currencies.update', $model->id)}}" method="post" :default="$model">

        <x-tomato-translation name="translations" :label="__('Translations')" :placeholder="__('Translations')"/>


        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Iso')" name="iso" type="text"  :placeholder="__('Iso')" />
        <x-splade-input :label="__('Symbol')" name="symbol" type="text"  :placeholder="__('Symbol')" />
        <x-splade-input :label="__('Rate In USD')" name="exchange_rate" type="number"  :placeholder="__('Rate In USD')" />


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.currencies.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.currencies.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
