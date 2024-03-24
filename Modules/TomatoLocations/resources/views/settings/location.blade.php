<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-locations::global.settings.title')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-locations::global.settings.card_title')" :description="trans('tomato-locations::global.settings.card_description')">
                <x-splade-form method="post" action="{{route('admin.settings.locations.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-select remote-url="/admin/countries/api" remote-root="data" option-label="name" option-value="id"  name="local_country" :label="trans('tomato-locations::global.settings.local_country')" choices relation/>
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_country')</code></small>
                            </div>
                        @endif
                        <x-splade-input id="local_phone" name="local_phone" type="text" :label="trans('tomato-locations::global.settings.local_phone')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_phone')</code></small>
                            </div>
                        @endif
                        <x-splade-select remote-url="/admin/languages/api" remote-root="data" option-label="name" option-value="name"  name="local_lang" :label="trans('tomato-locations::global.settings.local_lang')" choices relation/>
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_lang')</code></small>
                            </div>
                        @endif
                        <x-splade-select remote-url="/admin/currencies/api" remote-root="data" option-label="name" option-value="iso"  name="local_currency" :label="trans('tomato-locations::global.settings.local_currency')" choices relation/>
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_currency')</code></small>
                            </div>
                        @endif
                        <x-splade-input id="local_lat" name="local_lat" type="number" :label="trans('tomato-locations::global.settings.local_lat')" />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_lat')</code></small>
                            </div>
                        @endif
                        <x-splade-input id="local_lng" name="local_lng" type="number" :label="trans('tomato-locations::global.settings.local_lng')" />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('local_lng')</code></small>
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
