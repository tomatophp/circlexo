<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('Location Settings')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.site.sections.contact.title')" :description="trans('tomato-settings::global.site.sections.contact.description')">
                <x-splade-form method="post" action="{{route('admin.settings.local.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-textarea id="site_address" name="site_address" :label="trans('tomato-settings::global.site.sections.contact.site_address')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_address')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_email" name="site_email" type="text" :label="trans('tomato-settings::global.site.sections.contact.site_email')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_email')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_phone" name="site_phone" type="text" :label="trans('tomato-settings::global.site.sections.contact.site_phone')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_phone')</code></small>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <x-splade-submit :label="trans('tomato-admin::global.save')" />
                    </div>
                </x-splade-form>
            </x-tomato-settings-card>
        </div>
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.site.sections.location.title')" :description="trans('tomato-settings::global.site.sections.location.description')">
                <x-splade-form method="post" action="{{route('admin.settings.local.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="site_phone_code" name="site_phone_code" type="text" :label="trans('tomato-settings::global.site.sections.location.site_phone_code')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_phone_code')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_location" name="site_location" type="text" :label="trans('tomato-settings::global.site.sections.location.site_location')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_location')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_currency" name="site_currency" type="text" :label="trans('tomato-settings::global.site.sections.location.site_currency')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_currency')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_language" name="site_language" type="text" :label="trans('tomato-settings::global.site.sections.location.site_language')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_language')</code></small>
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
