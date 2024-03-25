<div class="bg-gray-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <div class="h-[150px] lg:h-[350px] bg-gray-700 bg-cover border-b border-gray-700">
            @if(auth('accounts')->user()->cover)
                <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                    <img src="{{ auth('accounts')->user()->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="avatar">
                </x-splade-link>
            @else
                <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bx-upload text-5xl text-gray-500"></i>
                    <h1>{{__('Upload a Cover')}}</h1>
                </x-splade-link>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if(auth('accounts')->user()->meta('social'))
                    @foreach(auth('accounts')->user()->meta('social') as $social)
                        <a href="{{ $social['link'] }}" target="_blank">
                            <x-tomato-admin-tooltip :text="isset($social['label']) ? $social['label'] : $social['name']">
                                @if($social['name'] !== 'website')
                                    <i class="bx bxl-{{ $social['name'] }} text-2xl text-gray-200 hover:text-white"></i>
                                @else
                                    <i class="bx bx-link text-2xl text-gray-200 hover:text-white"></i>
                                @endif
                            </x-tomato-admin-tooltip>
                        </a>
                    @endforeach
                @endif
            </div>
            <div>
                <div class="flex justify-center flex-col items-center -mt-12 ">
                    @if(auth('accounts')->user()->avatar)
                        <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-gray-800 border border-gray-700">
                            <img src="{{ auth('accounts')->user()->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
                        </x-splade-link>
                    @else
                        <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-gray-800 flex justify-center border border-gray-700">
                            <div class="flex flex-col justify-center items-center text-center h-full">
                                <i class="bx bx-upload text-5xl text-gray-500"></i>
                            </div>
                        </x-splade-link>
                    @endif

                </div>
                <div class="text-center flex flex-col mt-4">
                    <div class="flex justify-center gap-2  font-bold">
                        <x-splade-link :href="url(auth('accounts')->user()->username)"  class="text-2xl">{{ auth('accounts')->user()->name }}</x-splade-link>
                        @if(auth('accounts')->user()->type === 'verified')
                            <div class="flex flex-col justify-center items-center mt-2">
                                <x-tomato-admin-tooltip :text="__('Verified Account')">
                                    <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                                </x-tomato-admin-tooltip>
                            </div>
                        @endif
                        <x-splade-link modal :href="route('profile.info.show')" class="flex flex-col justify-center items-center mt-1">
                            <i class="bx bxs-edit text-green-500 text-lg"></i>
                        </x-splade-link>
                    </div>
                    <x-tomato-admin-copy :text="url('/' . auth('accounts')->user()->username)">
                        <div class="flex justify-center gap-2">
                            <i class="bx bx-copy text-sm text-main-600 mt-1"></i>
                            <h6 class="text-sm font-medium text-gray-300">{{ auth('accounts')->user()->username }}</h6>
                        </div>
                    </x-tomato-admin-copy>
                    @if(auth('accounts')->user()->bio)
                        <p class="text-xs text-center my-2 mx-2">
                            {{ auth('accounts')->user()->bio }}
                        </p>
                    @endif

                    @if(auth('accounts')->user()->address)
                    <div class="flex justify-center gap-2 text-sm">
                        <i class="bx bxs-map mt-1 text-main-600 "></i>
                        <h1 class="text-gray-300">
                            {{ auth('accounts')->user()->address }}
                        </h1>
                    </div>
                    @endif
                    <h6 class="my-2 text-sm text-gray-300">{{__('Joined')}} {{ auth('accounts')->user()->created_at->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-center md:justify-end gap-4 mt-8 mx-16">
                <x-circle-xo-button modal href="{{route('profile.qr')}}"  size="sm" success>
                    <i class="bx bx-qr"></i>
                </x-circle-xo-button>
                <x-tomato-admin-tooltip :text="__('Settings')">
                    <x-tomato-admin-dropdown>
                        <x-slot:button>
                            <button>
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                        </x-slot:button>
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-edit" :label="__('Edit Profile')" href="{{ route('profile.info.show') }}" />
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-lock" :label="__('Edit Password')" href="{{ route('profile.password.show') }}" />
                        <x-tomato-admin-dropdown-item modal type="link" icon="bx bx-plus-circle" :label="__('List Item')" href="{{ route('profile.listing.create') }}" />
                        <x-tomato-admin-dropdown-item type="link" icon="bx bx-message" :label="__('Messages')" href="{{ route('profile.messages') }}" />
                        <x-tomato-admin-dropdown-item type="link" icon="bx bxs-user-plus" :label="__('Following')" href="{{ route('profile.following') }}" />
                    </x-tomato-admin-dropdown>
                </x-tomato-admin-tooltip>
            </div>
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden ">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if(auth('accounts')->user()->meta('social'))
                    @foreach(auth('accounts')->user()->meta('social') as $social)
                        <a href="{{ $social['link'] }}" target="_blank">
                            <x-tomato-admin-tooltip :text="isset($social['label']) ? $social['label'] : $social['name']">
                                @if($social['name'] !== 'website')
                                    <i class="bx bxl-{{ $social['name'] }} text-2xl text-gray-200 hover:text-white"></i>
                                @else
                                    <i class="bx bx-link text-2xl text-gray-200 hover:text-white"></i>
                                @endif
                            </x-tomato-admin-tooltip>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
