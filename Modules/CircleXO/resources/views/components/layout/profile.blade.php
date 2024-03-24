<div class="bg-gray-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-screen">
        <div class="h-[350px] bg-gray-700 bg-cover border-b border-gray-700">
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
        <div class="grid grid-cols-3">
            <div class="flex justify-start gap-4 mt-8 mx-16">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @foreach(auth('accounts')->user()->meta('social') as $social)
                    <a href="{{ $social['link'] }}" target="_blank">
                        <x-tomato-admin-tooltip :text="$social['name']">
                            @if(in_array($social['name'], ['facebook', 'twitter', 'github', 'youtube', 'linkedin']))
                                <i class="bx bxl-{{ $social['name'] }} text-2xl text-gray-200 hover:text-white"></i>
                            @else
                                <i class="bx bx-link text-2xl text-gray-200 hover:text-white"></i>
                            @endif
                        </x-tomato-admin-tooltip>
                    </a>
                @endforeach
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
                        <x-splade-link modal :href="route('profile.info.show')" class="text-2xl">{{ auth('accounts')->user()->name }}</x-splade-link>
                        <div class="flex flex-col justify-center items-center mt-1">
                            <i class="bx bxs-check-circle text-green-500 text-lg"></i>
                        </div>
                    </div>
                    <h6 class="text-sm font-medium text-gray-300">{{ auth('accounts')->user()->username }}</h6>
                    @if(auth('accounts')->user()->bio)
                        <p class="text-xs text-center my-2">
                            {{ auth('accounts')->user()->bio }}
                        </p>
                    @endif

                    <h6 class="my-2 text-sm text-gray-300">Joined {{ auth('accounts')->user()->created_at->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-8 mx-16">
                <x-circle-xo-button href="{{url('qr')}}" label="QR" size="sm"/>
                <x-circle-xo-button href="{{url('contact')}}" label="Contact" size="sm"/>
                <x-circle-xo-button href="{{url('follow')}}" label="Follow" size="sm"/>
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
