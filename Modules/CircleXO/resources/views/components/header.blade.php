<header class="p-4 border-b-2 border-zinc-800">
    <nav class="flex justify-between">
        <div class="text-white flex justify-start w-full ">
            <Link href="#menu">
            <i class="bx bx-menu bx-sm md:bx-lg px-4 my-2"></i>
            </Link>
        </div>
        <div class="w-full flex flex-col items-center justify-center">
            <x-splade-link href="{{ route('home') }}">
                <x-circle-xo-logo class="h-6 md:h-8 w-auto"/>
            </x-splade-link>
        </div>
        <div class="w-full flex justify-end text-main-600">
            @php $headerMenuSlots = \Modules\CircleXO\App\Facades\CircleXo::slots('header-menu'); @endphp
            @foreach($headerMenuSlots as $slot)
                @if(view()->exists($slot))
                    @include($slot)
                @endif
            @endforeach

            <Link href="#search">
            <x-tomato-admin-tooltip :text="__('Search')">
                <i class="bx bx-search bx-sm md:bx-lg px-2 my-2"></i>
            </x-tomato-admin-tooltip>
            </Link>
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
                            <div class="absolute top-0 font-bold left-6 bg-zinc-700 border border-zinc-500 shadow-sm text-zinc-200 rounded-full text-[10px] w-4 h-4 text-center">
                                {{ $notifications }}
                            </div>
                        @endif

                        <i class="bx bxs-bell bx-sm md:bx-lg text-second-600 px-2 my-2"></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>


                <x-splade-link href="{{ route('profile.messages') }}">
                    <x-tomato-admin-tooltip :text="__('Messages')">
                        <i class="bx bxs-message bx-sm md:bx-lg px-2 my-2 text-main-600"></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
                <x-splade-link href="{{ route('profile.index') }}">
                    <x-tomato-admin-tooltip :text="__('Profile')">
                        <i class="bx bxs-user-circle bx-sm md:bx-lg px-2 my-2"></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
                <x-splade-link method="POST" href="{{ route('profile.logout') }}">
                    <x-tomato-admin-tooltip :text="__('Logout')">
                        <i class="bx bx-log-out bx-sm md:bx-lg  text-danger-500  my-2"></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
            @else
                <x-splade-link href="{{ route('account.login') }}">
                    <x-tomato-admin-tooltip :text="__('Login')">
                        <i class="bx bx-log-in bx-sm md:bx-lg px-2 my-2"></i>
                    </x-tomato-admin-tooltip>
                </x-splade-link>
            @endif
        </div>
    </nav>


    <x-splade-modal name="search">
        <x-slot:title>
            {{__('Search')}}
        </x-slot:title>
        <Search url="{{ url('/') }}" placeholder="{{__('Search By Username @')}}"/>
    </x-splade-modal>
    <x-splade-modal name="menu" position="left" max-width="sm" slideover>
        <div>
            <x-splade-link href="{{ route('home') }}">
                <x-circle-xo-logo class="h-6 md:h-8 w-auto"/>
            </x-splade-link>

            <nav class="flex flex-col justify-around space-y-2 mt-6">
                <x-circle-xo-menu-items/>
            </nav>
        </div>
    </x-splade-modal>
</header>
