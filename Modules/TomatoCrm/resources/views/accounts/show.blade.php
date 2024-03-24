<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Account') }} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="text" />
        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text" />
        <x-tomato-admin-row :label="__('Username')" :value="$model->username" type="text" />
        <x-tomato-admin-row :label="__('Email')" :value="$model->email" type="email" />
        <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />
        <x-tomato-admin-row :label="__('Login By')" :value="$model->loginBy" type="text" />
        <x-tomato-admin-row :label="__('Address')" :value="$model->address" type="text" />
        <x-tomato-admin-row :label="__('Last login')" :value="\Carbon\Carbon::parse($model->last_login)?->diffForHumans()" type="text" />
        <x-tomato-admin-row :label="__('Host')" :value="$model->host" type="text" />
        @foreach(\Modules\TomatoCrm\App\Facades\TomatoCrm::getShow() as $key=>$item)
            @if(is_array($item))
                @if($item['type'] === 'media')
                    <x-tomato-admin-row :label="$item['label']" type="image" :value="$model->getMedia($key)?->first()?->getUrl()" />
                @else
                    <x-tomato-admin-row :label="$item['label']" :type="$item['type']" :value="$model->meta($key)" />
                @endif
            @else
                <x-tomato-admin-row :label="$item" :value="$model->meta($key)" />
            @endif
        @endforeach
        <x-tomato-admin-row :label="__('Login')" :value="$model->is_login" type="bool" />
        <x-tomato-admin-row :label="__('Activated')" :value="$model->is_active" type="bool" />

        @if(class_exists(\Bavix\Wallet\Models\Wallet::class))
            <x-tomato-admin-row :label="__('Balance')" value="{!! dollar($model->balance) !!}" type="text" />
        @endif

    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning :href="route('admin.accounts.edit', $model->id)">
            {{__('Edit')}}
        </x-tomato-admin-button>
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

    @php
        $groups = [];
        $groups['groups'] = __('Groups');
        if(config('tomato-crm.features.locations')){
            $groups['locations'] = __('Locations');
        }
        foreach (array_merge(config('tomato-crm.relations'), \Modules\TomatoCrm\App\Facades\TomatoCrm::loadRelation()) as $item){
            $groups[$item['name']] = $item['label'][app()->getLocale()];
        }
    @endphp
    <x-tomato-admin-relations-group :relations="$groups">
        <x-tomato-admin-relations
            :model="$model"
            name="groups"
            :table="\Modules\TomatoCrm\App\Tables\GroupTable::class"
        />
        @if(config('tomato-crm.features.locations'))
            <x-tomato-admin-relations
                :model="$model"
                name="locations"
                :table="\Modules\TomatoCrm\App\Tables\LocationTable::class"
                view="tomato-crm::locations.index"
            />
        @endif
        @foreach (array_merge(config('tomato-crm.relations'), \Modules\TomatoCrm\App\Facades\TomatoCrm::loadRelation()) as $item)
            <x-tomato-admin-relations
                :model="$model"
                name="{{$item['name']}}"
                :table="$item['table']"
                :show="$item['show']"
                :edit="$item['edit']"
                :delete="$item['delete']"
                :path="$item['path']"
                :view="$item['view'] ?: 'tomato-admin::components.relations'"
            />
        @endforeach
    </x-tomato-admin-relations-group>

</x-tomato-admin-container>
