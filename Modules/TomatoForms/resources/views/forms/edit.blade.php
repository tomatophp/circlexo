<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Form')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col gap-4" action="{{route('admin.forms.update', $model->id)}}" method="post" :default="$model">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-2 flex flex-col gap-4">
                <x-tomato-translation :label="__('Title')" name="title" :placeholder="__('Title')" />
                <x-tomato-translation textarea :label="__('Description')" name="description" :placeholder="__('Description')" />
            </div>

            <x-tomato-translation :label="__('Name')" name="name" :placeholder="__('Name')" />

            <x-splade-input class="w-full" label="{{__('Key')}}" name="key" type="text"  placeholder="{{__('Key')}}" />


            <x-splade-select choices name="type" label="{{__('Type')}}"  placeholder="{{__('Type')}}">
                <option value="page">{{__('Page')}}</option>
                <option value="modal">{{__('Modal')}}</option>
                <option value="slideover">{{__('Slideover')}}</option>
            </x-splade-select>

            <x-splade-select choices name="method" label="{{__('Method')}}"  placeholder="{{__('Method')}}">
                <option value="POST">POST</option>
                <option value="GET">GET</option>
                <option value="PUT">PUT</option>
                <option value="DELETE">DELETE</option>
                <option value="PATCH">PATCH</option>
            </x-splade-select>
            <x-splade-input class="col-span-2" name="endpoint" label="{{trans('Endpoint')}}"  type="text"  placeholder="{{__('Endpoint')}}" />


            <x-splade-checkbox class="col-span-2" name="is_active" label="{{__('Is Active?')}}" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
                <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
                <x-tomato-admin-button danger :href="route('admin.forms.destroy', $model->id)"
                                       confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                       confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                       confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                       cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                       method="delete"  label="{{__('Delete')}}" />
                <x-tomato-admin-button secondary :href="route('admin.forms.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
