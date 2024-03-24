<x-tomato-admin-container label="{{__('Send Notification')}}">
    <x-slot:icon>
       bx bxs-bell
    </x-slot:icon>
    <x-splade-form :default="[
                'use_template' => true,
                'privacy' => isset($model) ? 'customer':'public',
                'providers' => ['email'],
                'type' => 'alert',
                'account_id' => $model->id ?? null,
            ]" action="{{route('admin.accounts.notifications.send')}}" method="post">

        <div  class="flex flex-col gap-4 mb-4">
        <x-splade-checkbox name="use_template" :label="__('Use Notification Template?')"></x-splade-checkbox>
        <x-splade-select v-if="form.use_template" :placeholder="trans('tomato-notifications::global.notifications.template_id')" name="template_id" :options="$templates" option-label="name" option-value="id" choices relation/>
        <div v-else class="flex flex-col gap-4">
            <x-splade-file :label="__('Notification Image Placeholder')" name="image"  filepond />
            <x-splade-input  name="title" type="text"  placeholder="{{__('New Offer ..')}}" label="{{trans('Notification Title')}} " required/>
            <x-splade-textarea name="body" type="text"  placeholder="{{__('Please use this offer ...')}}" label="{{__('Notification Body')}}" required/>
        </div>

        <div class="flex justify-between gap-4">
            <x-splade-select class="w-full" name="privacy" type="text" :label="__('Send Notification To')"  :placeholder="trans('tomato-notifications::global.notifications.privacy')">
                <option value="public">{{__('All Customer')}}</option>
                <option value="customer">{{__('Selected Customer')}}</option>
                <option value="group">{{__('Selected Customer Group')}}</option>
            </x-splade-select>

            <x-splade-select class="w-full" name="type" label="{{trans('tomato-notifications::global.templates.type')}}" required choices>
                @foreach(config('tomato-notifications.types') as $type)
                    <option value="{{$type['id']}}">{{trans('tomato-notifications::global.templates.types.' . $type['id'])}}</option>
                @endforeach
            </x-splade-select>
        </div>

        <x-splade-select v-if="form.privacy === 'customer'" choices name="account_id" remote-url="/admin/accounts/api" remote-root="data" option-label="name" option-value="id"  :options="[]"  :label="__('Select Customer')" :placeholder="__('Select Customer from list')"/>
        <x-splade-select v-if="form.privacy === 'group'" choices name="group_id" remote-url="/admin/groups/api" remote-root="data" option-label="name.{{app()->getLocale()}}" option-value="id"  :options="[]"  :label="__('Select Group')" :placeholder="__('Select Customer Group from list')" />

        <x-splade-select class="w-full" name="providers[]" label="{{__('Send Notification By')}}" :placeholder="__('Email, FCM')"   required multiple choices>
            @foreach(config('tomato-notifications.providers') as $provider)
                <option value="{{$provider['id']}}">{{trans('tomato-notifications::global.templates.provider.' . $provider['id'])}}</option>
            @endforeach
        </x-splade-select>

        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit :label="__('Send Notification')" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
