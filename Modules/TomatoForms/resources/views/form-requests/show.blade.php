<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('Form Request')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <x-tomato-admin-row :label="__('Form')" :value="$model->form->name" type="text" />
          <x-tomato-admin-row :label="__('User')" :value="$model->model_type::find($model->model_id)?->name" type="string" />
          <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />
    </div>
    <hr class="my-4" />
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach($model->payload as $key=>$item)
            @if($key !== 'form_id')
                <x-tomato-admin-row :label="str($key)->replace('_', ' ')->title()" :value="$item"/>
            @endif
        @endforeach
        @foreach($model->formRequestsMetas as $item)
            @if($item->model_id)
                    <x-tomato-admin-row :label="str($item->key)->replace('_', ' ')->title()" :value="$item->model_type::find($item->model_id)?->name"/>
            @elseif($item->value === 'image')
                    <x-tomato-admin-row :label="str($item->key)->replace('_', ' ')->title()" type="image" :value="$item->getMedia('image')->first()->getUrl()"/>
            @else
                <x-tomato-admin-row :label="str($item->key)->replace('_', ' ')->title()" :value="$item->value"/>
            @endif
        @endforeach
    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button danger :href="route('admin.form-requests.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.form-requests.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
