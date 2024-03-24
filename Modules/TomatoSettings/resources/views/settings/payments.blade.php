<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-settings::global.payments.title')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.payments.sections.gate.title')" :description="trans('tomato-settings::global.payments.sections.gate.description')">
                <x-splade-form method="post" action="{{route('admin.settings.payments.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-checkbox id="payment_online" name="payment_online" type="checkbox" :label="trans('tomato-settings::global.payments.sections.gate.payment_online')" :default="0"  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('payment_online')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select choices v-if="form.payment_online" id="payment_gate" name="payment_gate" :label="trans('tomato-settings::global.payments.sections.gate.payment_gate')" required autofocus>
                            <option value="paytabs">{{__('PayTabs')}}</option>
                            <option value="paymob">{{__('PayMob')}}</option>
                            <option value="fawrypay">{{__('Fawry Pay')}}</option>
                            <option value="payfort">{{__('Payfort')}}</option>
                            <option value="paypal">{{__('Paypal')}}</option>
                            <option value="strip">{{__('Strip')}}</option>
                        </x-splade-select>
                        @if(config('tomato-settings.helpers'))
                            <div v-if="form.payment_online" class="p-1">
                                <small class="text-red-500"><code>setting('payment_gate')</code></small>
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
