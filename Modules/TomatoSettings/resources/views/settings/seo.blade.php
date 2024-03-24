<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('SEO Settings')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.site.sections.media.title')" :description="trans('tomato-settings::global.site.sections.media.description')">
                <x-splade-form method="post" action="{{route('admin.settings.seo.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-file id="site_profile" name="site_profile" :label="trans('tomato-settings::global.site.sections.media.site_profile')"  filepond preview required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_profile')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-file id="site_logo" name="site_logo" :label="trans('tomato-settings::global.site.sections.media.site_logo')" filepond preview required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_logo')</code></small>
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
            <x-tomato-settings-card :title="trans('tomato-settings::global.site.sections.seo.title')" :description="trans('tomato-settings::global.site.sections.seo.description')">
                <x-splade-form method="post" action="{{route('admin.settings.seo.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="site_name" name="site_name" type="text" :label="trans('tomato-settings::global.site.sections.seo.site_name')" required autofocus />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_name')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-input id="site_author" name="site_author" type="text" :label="trans('tomato-settings::global.site.sections.seo.site_author')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_author')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-textarea id="site_description" name="site_description" :label="trans('tomato-settings::global.site.sections.seo.site_description')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_description')</code></small>
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-splade-textarea id="site_keywords" name="site_keywords" :label="trans('tomato-settings::global.site.sections.seo.site_keywords')" required  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_keywords')</code></small>
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
