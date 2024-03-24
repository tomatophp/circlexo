<x-tomato-admin-layout>
    <x-slot:header>
        {{trans('tomato-notifications::global.settings.title')}}
    </x-slot:header>

    <x-slot:buttons>
        <div class="flex">
            <Link href="/admin/user-notifications" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
                {{ trans('tomato-notifications::global.logs.back') }}
            </Link>
        </div>
    </x-slot:buttons>

    <div class="flex flex-col gap-4 mb-4">
        <div>
            <x-tomato-settings-card :title="trans('tomato-notifications::global.settings.card_title')" :description="trans('tomato-notifications::global.settings.card_description')">
                <x-splade-form method="post" action="{{route('admin.settings.notifications.store')}}" class="mt-6 space-y-6" :default="$settings">
                    <div>
                        <x-splade-checkbox id="notifications_allow" name="notifications_allow" :label="trans('tomato-notifications::global.settings.notifications_allow')" required autofocus />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('notifications_allow')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_apiKey" name="fcm_apiKey" :label="trans('tomato-notifications::global.settings.fcm_apiKey')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('notifications_allow')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_authDomain" name="fcm_authDomain" :label="trans('tomato-notifications::global.settings.fcm_authDomain')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_authDomain')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_projectId" name="fcm_projectId" :label="trans('tomato-notifications::global.settings.fcm_projectId')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_projectId')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_storageBucket" name="fcm_storageBucket" :label="trans('tomato-notifications::global.settings.fcm_storageBucket')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_storageBucket')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_messagingSenderId" name="fcm_messagingSenderId" :label="trans('tomato-notifications::global.settings.fcm_messagingSenderId')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_messagingSenderId')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_appId" name="fcm_appId" :label="trans('tomato-notifications::global.settings.fcm_appId')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_appId')</code></small>
                            </div>
                        @endif
                    </div>
                    <div v-if="form.notifications_allow">
                        <x-splade-input type="text" id="fcm_measurementId" name="fcm_measurementId" :label="trans('tomato-notifications::global.settings.fcm_measurementId')" required />
                        @if(config('tomato-settings.helpers'))
                            <div class="p-1">
                                <small class="text-red-500"><code>setting('fcm_measurementId')</code></small>
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
