<x-tomato-admin-layout>
    <x-slot name="header">
        {{trans('tomato-settings::global.site.title')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="__('Main Menu Settings')" :description="__('You can update menu here and use it as your main menu')">
                <x-splade-form method="post" action="{{route('admin.settings.site.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-tomato-admin-repeater :options="['label','icon', 'url', 'route','target']" type="repeater" id="site_menu" name="site_menu" :label="trans('tomato-settings::global.site.sections.interface.site_menu')" required>
                            <x-splade-input class="my-2" v-model="repeater.main[key].label" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_menu_label')"   required  />
                            <x-splade-input class="my-2" v-model="repeater.main[key].icon" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_menu_icon')"   required  />
                            <x-splade-input class="my-2" v-model="repeater.main[key].url" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_menu_url')"   required  />
                            <x-splade-input class="my-2" v-model="repeater.main[key].route" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_menu_route')"   required  />
                            <x-splade-input class="my-2" v-model="repeater.main[key].target" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_menu_target')"   required  />
                        </x-tomato-admin-repeater>
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_menu')</code></small>
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
            <x-tomato-settings-card :title="__('Social Media Networks')" :description="__('You can add social media links here and use it on your theme as links')">
                <x-splade-form method="post" action="{{route('admin.settings.site.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-tomato-admin-repeater :options="['network','url']" id="site_social" name="site_social" type="repeater" :label="trans('tomato-settings::global.site.sections.interface.site_social')"  required>
                            <x-splade-input class="my-2" v-model="repeater.main[key].network" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_social_network')"  required />
                            <x-splade-input class="my-2" v-model="repeater.main[key].url" type="text" :placeholder="trans('tomato-settings::global.site.sections.interface.site_social_url')"  required />
                        </x-tomato-admin-repeater>
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('site_social')</code></small>
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
