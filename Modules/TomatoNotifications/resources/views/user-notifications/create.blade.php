<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{ trans('tomato-notifications::global.notifications.single') }}">
    <x-splade-form :default="[
        'privacy' => 'public',
        'model_type' => array_keys(config('tomato-notifications.models'))[0],
    ]" class="flex flex-col space-y-4" action="{{route('admin.user-notifications.store')}}" method="post">
        <x-splade-select :label="trans('tomato-notifications::global.notifications.template_id')" :placeholder="trans('tomato-notifications::global.notifications.template_id')" name="template_id" :options="$templates" option-label="name" option-value="id" choices relation/>
        <x-splade-select choices name="model_type" type="text" :label="trans('tomato-notifications::global.notifications.model_type')"  :placeholder="trans('tomato-notifications::global.notifications.model_type')">
            @foreach(config('tomato-notifications.models') as $key=>$model)
                <option value="{{$key}}">{{trans('tomato-notifications::global.notifications.models.'.$key)}}</option>
            @endforeach
        </x-splade-select>
        <x-splade-select choices name="privacy" type="text" :label="trans('tomato-notifications::global.notifications.privacy')" :placeholder="trans('tomato-notifications::global.notifications.privacy')">
            <option value="public">{{trans('tomato-notifications::global.notifications.public')}}</option>
            <option value="private">{{trans('tomato-notifications::global.notifications.private')}}</option>
        </x-splade-select>
        <x-splade-select v-if="form.privacy === 'private'" name="model_id" type="text" :label="trans('tomato-notifications::global.notifications.model_id')" :placeholder="trans('tomato-notifications::global.notifications.model_id')" method="post" remote-url="`/admin/user-notifications/get/${form.model_type}`" choices />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Send')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.user-notifications.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
