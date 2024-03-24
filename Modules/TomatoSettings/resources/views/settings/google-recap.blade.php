<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('Google reCAPTCHA')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.google.sections.recap.title')" :description="trans('tomato-settings::global.google.sections.recap.description')">
                <x-splade-form method="post" action="{{route('admin.settings.google-recap.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="google_recaptcha_key" name="google_recaptcha_key" type="text" :label="trans('tomato-settings::global.google.sections.recap.google_recaptcha_key')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('google_recaptcha_key')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="google_recaptcha_secret" name="google_recaptcha_secret" type="text" :label="trans('tomato-settings::global.google.sections.recap.google_recaptcha_secret')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('google_recaptcha_secret')</code></small>
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
