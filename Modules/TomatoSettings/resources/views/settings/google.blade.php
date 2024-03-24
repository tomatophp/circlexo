<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-settings::global.google.title')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.google.sections.google_api.title')" :description="trans('tomato-settings::global.google.sections.google_api.description')">
                <x-splade-form method="post" action="{{route('admin.settings.google.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="google_api_key" name="google_api_key" type="text" :label="trans('tomato-settings::global.google.sections.google_api.google_api_key')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('google_api_key')</code></small>
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
