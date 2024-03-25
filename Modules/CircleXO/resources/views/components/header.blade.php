<header class="p-4 border-b-2 border-gray-800">
    <nav class="flex justify-between">
        <div class="text-white flex justify-start w-full ">
            <x-splade-link slideover :href="route('home.menu')">
                <i class="bx bx-menu bx-sm md:bx-lg px-4 my-2" ></i>
            </x-splade-link>
        </div>
        <div class="w-full flex flex-col items-center justify-center">
            <x-splade-link href="{{ route('home') }}">
                <x-circle-xo-logo class="h-6 md:h-8 w-auto" />
            </x-splade-link>
        </div>
        <div class="w-full flex justify-end text-main-600">
            @if(auth('accounts')->user())
                <x-splade-link modal href="{{ route('profile.notifications.index') }}"
                               class="block shrink-0 relative group">
                    <x-tomato-admin-tooltip :text="__('Notifications')">
                        @php
                            $notifications = \Modules\TomatoNotifications\App\Models\UserNotification::where('model_id', auth('accounts')->user()->id)
                                ->where('model_type', config('tomato-crm.model'))
                                ->doesntHave('userRead')
                                ->count();
                        @endphp
                        @if($notifications)
                            <div class="absolute top-0 font-bold left-6 bg-gray-700 border border-gray-500 shadow-sm text-gray-200 rounded-full text-[10px] w-4 h-4 text-center">
                                {{ $notifications }}
                            </div>
                        @endif

                        <i class="bx bxs-bell bx-sm md:bx-lg text-second-600 px-2 my-2" ></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
                <x-splade-link href="{{ route('profile.index') }}">
                    <x-tomato-admin-tooltip :text="__('Profile')">
                        <i class="bx bxs-user-circle bx-sm md:bx-lg px-2 my-2" ></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
                <x-splade-link method="POST" href="{{ route('profile.logout') }}">
                    <x-tomato-admin-tooltip :text="__('Logout')">
                        <i class="bx bx-log-out bx-sm md:bx-lg  text-danger-500  my-2" ></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
            @else
                <x-splade-link href="{{ route('account.login') }}">
                    <x-tomato-admin-tooltip :text="__('Login')">
                        <i class="bx bx-log-in bx-sm md:bx-lg px-2 my-2" ></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
            @endif
        </div>
    </nav>
</header>
