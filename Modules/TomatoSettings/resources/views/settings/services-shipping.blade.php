<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('Shipping Services')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.services.sections.shipping.title')" :description="trans('tomato-settings::global.services.sections.shipping.description')">
                <x-splade-form method="post" action="{{route('admin.settings.services-shipping.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-checkbox id="shipping_active" name="shipping_active"  :label="trans('tomato-settings::global.services.sections.shipping.shipping_active')" autofocus />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('shipping_active')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-select choices v-if="form.shipping_active" id="shipping_gate" name="shipping_gate" type="text" :label="trans('tomato-settings::global.services.sections.shipping.shipping_gate')" >
                            <option value="aramx">{{__('Aramx')}}</option>
                            <option value="dhl">{{__('DHL')}}</option>
                            <option value="green-zone">{{__('Green Zone')}}</option>
                            <option value="posta">{{__('Posta')}}</option>
                        </x-splade-select>
                        @if(config('tomato-settings.helpers'))
                            <div v-if="form.shipping_active" class="p-1">
                                <small class="text-red-500"><code>setting('shipping_gate')</code></small>
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
