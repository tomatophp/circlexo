<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('SMS Services')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.services.sections.sms.title')" :description="trans('tomato-settings::global.services.sections.sms.description')">
                <x-splade-form method="post" action="{{route('admin.settings.services-sms.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-checkbox id="sms_active" name="sms_active"  :label="trans('tomato-settings::global.services.sections.sms.sms_active')" autofocus />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('sms_active')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select choices v-if="form.sms_active" id="sms_gate" name="sms_gate" type="text" :label="trans('tomato-settings::global.services.sections.sms.sms_gate')" >
                            <option value="messagebird">{{__('Message Bird')}}</option>
                            <option value="twailo">{{__('Twailo')}}</option>
                            <option value="sms-misr">{{__('SMS Misr')}}</option>
                        </x-splade-select>
                        @if(config('tomato-settings.helpers'))
                            <div v-if="form.sms_active" class="p-1">
                                <small class="text-red-500"><code>setting('sms_gate')</code></small>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
    </div>
</x-tomato-admin-layout>
