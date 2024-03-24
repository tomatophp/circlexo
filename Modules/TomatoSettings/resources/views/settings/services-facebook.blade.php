<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('Facebook Services')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.services.sections.facebook.title')" :description="trans('tomato-settings::global.services.sections.facebook.description')">
                <x-splade-form method="post" action="{{route('admin.settings.services-facebook.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="facebook_pixcel" name="facebook_pixcel" type="text" :label="trans('tomato-settings::global.services.sections.facebook.facebook_pixcel')"  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('facebook_pixcel')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="facebook_chat" name="facebook_chat" type="text" :label="trans('tomato-settings::global.services.sections.facebook.facebook_chat')"  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('facebook_chat')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="facebook_app" name="facebook_app" type="text" :label="trans('tomato-settings::global.services.sections.facebook.facebook_app')"  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('facebook_app')</code></small>
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
