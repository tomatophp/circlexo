<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Account')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.accounts.update', $model->id)}}" method="post" :default="$model">
        <x-splade-file filepond preview name="avatar" label="{{__('Account Avatar')}}" />
        <x-splade-select  label="{{__('Account Type')}}" placeholder="{{__('Account Type')}}" name="type" choices>
            @foreach($types as $type)
                <option value="{{$type->key}}">{{$type->name}}</option>
            @endforeach
        </x-splade-select>


        <div class="grid grid-cols-2 gap-4">
            <x-splade-input label="{{__('Name')}}" name="name" type="text"  placeholder="{{__('Name')}}" />
            <x-splade-input label="{{__('Email')}}" name="email" type="email"  placeholder="{{__('Email')}}" />
            <x-splade-input class="col-span-2" label="{{__('Phone')}}" name="phone" type="tel"  placeholder="{{__('Phone')}}" />
        </div>
        @if(config('tomato-crm.features.locations'))
            <x-splade-textarea label="{{__('Address')}}" name="address" placeholder="{{__('Address')}}" autosize />
        @endif
        @if(config('tomato-crm.features.groups'))
            <x-splade-select choices multiple :options="$groups" option-value="id" option-label="name"  label="{{__('Groups')}}" name="groups" placeholder="{{__('Groups')}}" autosize />
        @endif

        @if(\Modules\TomatoCrm\App\Facades\TomatoCrm::getEditForm())
            @include(\Modules\TomatoCrm\App\Facades\TomatoCrm::getEditForm())
        @endif

        @foreach(\Modules\TomatoCrm\App\Facades\TomatoCrm::getEditInputs() as $key=>$item)
            @if($item['type'] === 'date')
                <x-splade-input date label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'datetime')
                <x-splade-input date time label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'time')
                <x-splade-input time label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'textarea')
                <x-splade-textarea label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'checkbox')
                <x-splade-checkbox label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @elseif($item['type'] === 'media')
                <x-splade-file filepond preview label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @else
                <x-splade-input :type="$item['type']" label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @endif
        @endforeach


        <x-splade-checkbox label="{{ __('Activated') }}" name="is_active" />


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button
                danger
                :href="route('admin.accounts.destroy', $model->id)"
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
            <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
