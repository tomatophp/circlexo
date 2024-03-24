<x-tomato-admin-layout>
    <x-slot name="header">
        {{__('Link AddThis Service')}}
    </x-slot>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-settings::global.services.sections.addthis.title')" :description="trans('tomato-settings::global.services.sections.addthis.description')">
                <x-splade-form method="post" action="{{route('admin.settings.services-addthis.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-input id="addthis_key" name="addthis_key" type="text" :label="trans('tomato-settings::global.services.sections.addthis.addthis_key')"  />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('addthis_key')</code></small>
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
