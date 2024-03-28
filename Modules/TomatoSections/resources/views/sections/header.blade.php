@php $section = $page->meta($section['uuid']); @endphp
<header class="bg-white border-b border-gray-200">
    <div
        class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8 z-10"
    >
        <x-splade-link class="block text-teal-600" :href="route('home.index')">
            <span class="sr-only">{{__('Home')}}</span>
            @if(setting('site_logo'))
                <img src="{{setting('site_logo')}}" class="h-8" />
            @else
                <x-tomato-application-logo class="w-8 h-8"/>
            @endif
        </x-splade-link>

        <div class="flex flex-1 items-center justify-end md:justify-between">
            <nav aria-label="Global" class="hidden md:block">
                <ul class="flex items-center gap-6 text-sm">
                    @foreach(menu($section['menu_id'] ?? 'main') as $item)
                        <li>
                            <x-splade-link :href="$item->url" class="text-gray-500 transition hover:text-gray-500/75">
                                {{$item->name}}
                            </x-splade-link>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-4">
                    <x-splade-form method="GET" action="{{\Module::find('TomatoEcommerce')->isEnabled() ? url('shop') : url('blog')}}" class="hidden lg:block relative border border-gray-500 rounded-full" :default="['search' => request()->search ?? '']">
                        <label class="sr-only" for="search"> {{__('Search')}} </label>

                        <input

                            class="h-10 w-full rounded-full border-none bg-white pe-10 ps-4 text-sm shadow-sm sm:w-56"
                            id="search"
                            v-model="form.search"
                            type="search"
                            placeholder="{{__('Search website...')}}"
                        />

                        <button
                            type="button"
                            class="absolute end-1 top-1/2 -translate-y-1/2 rounded-full bg-gray-50 p-2 text-gray-600   transition hover:text-gray-700"
                        >
                            <span class="sr-only">{{__('Search')}}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </button>
                    </x-splade-form>

                    @if(\Module::find('TomatoEcommerce')->isEnabled())
                     <x-splade-link
                        modal
                        :href="route('cart.cart')"
                        class="block shrink-0 rounded-full border border-gray-500 p-2 text-gray-600 shadow-sm hover:text-gray-700 relative group"
                    >
                        @php
                            $cart = \Modules\TomatoEcommerce\App\Models\Cart::where('session_id', \Illuminate\Support\Facades\Cookie::get('cart'))->count();
                        @endphp
                        @if($cart)
                            <div class="absolute top-0 font-bold left-6 bg-white border border-gray-500 shadow-sm text-gray-500 rounded-full text-[10px] w-4 h-4 text-center">
                                {{ $cart }}
                            </div>
                        @endif
                        <span class="sr-only">{{__('Cart')}}</span>
                        <div class="flex flex-col justify-center items-center text-gray-500 group-hover:text-warning-500 cursor-pointer transition-colors ease-in-out duration-30">
                            <i class="bx bxs-cart text-lg"></i>
                        </div>
                    </x-splade-link>
                    @endif

                    @if(auth('accounts')->user())
                        @if(\Module::find('TomatoEcommerce')->isEnabled())
                        <x-splade-link
                            modal
                            :href="route('profile.wishlist.index')"
                            class="block shrink-0 rounded-full border border-gray-500 p-2 text-gray-600 shadow-sm hover:text-gray-700 relative group"
                        >
                            @php
                                $wishlist = \Modules\TomatoEcommerce\App\Models\Wishlist::where('account_id', auth('accounts')->user()->id)->count();
                            @endphp
                            @if($wishlist)
                                <div class="absolute top-0 font-bold left-6 bg-white border border-gray-500 shadow-sm text-gray-500 rounded-full text-[10px] w-4 h-4 text-center">
                                    {{ $wishlist }}
                                </div>
                            @endif
                            <span class="sr-only">{{__('Wishlist')}}</span>
                            <div class="flex flex-col justify-center items-center text-gray-500 group-hover:text-danger-500 cursor-pointer transition-colors ease-in-out duration-30">
                                <i class="bx bxs-heart text-md"></i>
                            </div>
                        </x-splade-link>
                        @endif

                        @if(\Module::find('TomatoNotifications')->isEnabled())
                        <x-splade-link
                            modal
                            :href="route('profile.notifications.index')"
                            class="block shrink-0 rounded-full border border-gray-500 p-2 text-gray-600 shadow-sm hover:text-gray-700 relative group"
                        >
                            @php
                                $notifications = \Modules\TomatoNotifications\App\Models\UserNotification::where('model_id', auth('accounts')->user()->id)->where('model_type', config('tomato-crm.model'))->whereDoesntHave('userRead')->count();
                            @endphp
                            @if($notifications)
                                <div class="absolute top-0 font-bold left-6 bg-white border border-gray-500 shadow-sm text-gray-500 rounded-full text-[10px] w-4 h-4 text-center">
                                    {{ $notifications }}
                                </div>
                            @endif
                            <span class="sr-only">{{__('Notifications')}}</span>
                            <div class="flex flex-col justify-center items-center text-gray-500 group-hover:text-primary-500 cursor-pointer transition-colors ease-in-out duration-30">
                                <i class="bx bxs-bell text-md"></i>
                            </div>
                        </x-splade-link>
                            @endif
                    @endif
                </div>

                @if(auth('accounts')->user())
                    <span
                        aria-hidden="true"
                        class="block h-6 w-px rounded-full bg-gray-200"
                    ></span>

                    @php
                        $email = auth('accounts')->user()->email;
                        $default = url('placeholder.webp');
                        $size = 40;
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=mp&s=" . $size;
                    @endphp



                    <x-tomato-admin-dropdown id="profile-dropdown">
                        <x-slot:button>
                            <div class="block shrink-0">
                                <span class="sr-only">{{__('Profile')}}</span>
                                <img
                                    alt="{{auth('accounts')->user()->name}}"
                                    src="{{$grav_url}}"
                                    class="h-10 w-10 rounded-full object-cover"
                                />
                            </div>
                        </x-slot:button>

                        <x-tomato-admin-dropdown-item icon="bx bxs-user" type="link" label="{{__('Profile')}}" :href="route('profile.index')" />
                        @if(\Module::find('TomatoEcommerce')->isEnabled())
                            <x-tomato-admin-dropdown-item warning icon="bx bxs-map" type="link" label="{{__('Address')}}" :href="route('profile.address.index')" />
                            <x-tomato-admin-dropdown-item warning icon="bx bxs-rocket" type="link" label="{{__('Orders')}}" :href="route('profile.orders.index')" />
                        @endif
                        <x-tomato-admin-dropdown-item success icon="bx bxs-wallet" type="link" label="{{__('Wallet')}}" :href="route('profile.wallet.index')" />
                        <x-tomato-admin-dropdown-item icon="bx bxs-cog" type="link" label="{{__('Settings')}}" :href="route('profile.edit')" />
                        <x-tomato-admin-dropdown-item danger icon="bx bxs-user" type="link" label="{{__('Logout')}}" :href="route('profile.logout')" />

                    </x-tomato-admin-dropdown>
                @else

                    <div class="sm:flex sm:gap-4">
                        <x-splade-link
                            class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                            :href="route('accounts.login')"
                        >
                            {{__('Login')}}
                        </x-splade-link>

                        <x-splade-link
                            class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block"
                            :href="route('accounts.register')"
                        >
                            {{__('Register')}}
                        </x-splade-link>
                    </div>

                @endif

                <button
                    class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden"
                >
                    <span class="sr-only">{{__('Toggle menu')}}</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
