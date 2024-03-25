<div class="bg-gray-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <div class="h-[150px] lg:h-[350px] bg-gray-700 bg-cover border-b border-gray-700">
            @if($account->cover)
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <img src="{{ $account->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="avatar">
                </div>
            @else
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bxs-image text-5xl text-gray-500"></i>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                @if($account->meta('social'))
                    @foreach($account->meta('social') as $social)
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
                <div class="flex justify-center flex-col items-center -mt-12">
                    @if($account->avatar)
                        <div  class="w-32 h-32 rounded-full bg-gray-800 border border-gray-700">
                            <img src="{{ $account->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
                        </div>
                    @else
                        <div  class="w-32 h-32 rounded-full bg-gray-800 flex justify-center border border-gray-700">
                            <div class="flex flex-col justify-center items-center text-center h-full">
                                <i class="bx bxs-user text-5xl text-gray-500"></i>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="text-center flex flex-col mt-4">
                    <div class="flex justify-center gap-2  font-bold">
                        <x-splade-link href="{{ url($account->username) }}" class="text-2xl">{{ $account->name }}</x-splade-link>
                        @if($account->type === 'verified')
                            <div class="flex flex-col justify-center items-center mt-1">
                                <i class="bx bxs-badge-check text-blue-400 text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <h6 class="text-sm font-medium text-gray-300">{{ $account->username }}</h6>
                    @if($account->bio)
                        <p class="text-xs text-center my-2 mx-2">
                            {{ $account->bio  }}
                        </p>
                    @endif
                    @if($account->address)
                        <div class="flex justify-center gap-2 text-sm">
                            <i class="bx bxs-map mt-1 text-main-600 "></i>
                            <h1 class="text-gray-300">
                                {{ $account->address }}
                            </h1>
                        </div>
                    @endif
                    <h6 class="my-2 text-sm text-gray-300">{{__('Joined')}} {{ $account->created_at?->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-center md:justify-end gap-4 mt-8 mx-16">
                <x-circle-xo-button modal href="{{route('home.contact', $account->username)}}" :label="__('Send Message')" size="sm"/>
            </div>
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden">
                @if($account->meta('social'))
                    @foreach($account->meta('social') as $social)
                        <a href="{{ $social['link'] }}" target="_blank">
                            <x-tomato-admin-tooltip :text="isset($social['label']) ? $social['label'] : $social['name'] ">
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