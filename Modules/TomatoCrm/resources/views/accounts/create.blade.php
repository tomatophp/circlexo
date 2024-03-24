<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Account')}}">
    <x-splade-form :default="['loginBy' => config('tomato-crm.login_by'), 'type' => 'customer']" class="flex flex-col space-y-4" action="{{route('admin.accounts.store')}}" method="post">
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

        @if(\Modules\TomatoCrm\App\Facades\TomatoCrm::getCreateForm())
            @include(\Modules\TomatoCrm\App\Facades\TomatoCrm::getCreateForm())
        @endif

        @foreach(\Modules\TomatoCrm\App\Facades\TomatoCrm::getCreateInputs() as $key=>$item)
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
            @else
                <x-splade-input :type="$item['type']" label="{{$item['label']}}" name="{{$key}}" placeholder="{{$item['label']}}" />
            @endif
        @endforeach

        <x-splade-checkbox label="{{ __('Login') }}" name="is_login" />

        <div v-if="form.is_login">
            <div class="flex flex-col space-y-4">
                <x-splade-input label="{{__('Password')}}" name="password" type="password"  placeholder="{{__('Password')}}" />
                <x-splade-input label="{{__('Password Confirmation')}}" name="password_confirmation" type="password"  placeholder="{{__('Password Confirmation')}}" />
            </div>
        </div>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
