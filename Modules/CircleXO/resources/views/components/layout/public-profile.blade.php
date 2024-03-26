<div class="bg-zinc-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <div class="h-[150px] lg:h-[350px] bg-zinc-700 bg-cover border-b border-zinc-700">
            @if($account->cover)
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <img src="{{ $account->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="avatar">
                </div>
            @else
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bxs-image text-5xl text-zinc-500"></i>
                </div>
            @endif
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                <x-circle-xo-social-links :account="$account"/>
            </div>
            <div>
                <div class="flex justify-center flex-col items-center -mt-12">
                    @if($account->avatar)
                        <div  class="w-32 h-32 rounded-full bg-zinc-800 border border-zinc-700">
                            <img src="{{ $account->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
                        </div>
                    @else
                        <div  class="w-32 h-32 rounded-full bg-zinc-800 flex justify-center border border-zinc-700">
                            <div class="flex flex-col justify-center items-center text-center h-full">
                                <i class="bx bxs-user text-5xl text-zinc-500"></i>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="text-center flex flex-col mt-4">
                    <div class="flex justify-center gap-2  font-bold">
                        <x-splade-link href="{{ url($account->username) }}" class="text-2xl">{{ $account->name }}</x-splade-link>
                        @if($account->type === 'verified')
                            <div class="flex flex-col justify-center items-center mt-2">
                                <x-tomato-admin-tooltip :text="__('Verified Account')">
                                    <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                                </x-tomato-admin-tooltip>
                            </div>
                        @endif
                    </div>
                    <h6 class="text-sm font-medium text-zinc-300">{{ $account->username }}</h6>
                    @if($account->bio)
                        <p class="text-xs text-center my-2 mx-2">
                            {{ $account->bio  }}
                        </p>
                    @endif
                    @if($account->address)
                        <div class="flex justify-center gap-2 text-sm">
                            <i class="bx bxs-map mt-1 text-main-600 "></i>
                            <h1 class="text-zinc-300">
                                {{ $account->address }}
                            </h1>
                        </div>
                    @endif
                    <h6 class="my-2 text-sm text-zinc-300">{{__('Joined')}} {{ $account->created_at?->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-center md:justify-end gap-4 mt-8 mx-16">
                <x-circle-xo-button modal href="{{route('home.contact', $account->username)}}" :label="__('Send Message')" size="sm" />
                @if(auth('accounts')->user())
                    @if(!auth('accounts')->user()->isFollowing($account))
                        <x-circle-xo-button  href="{{route('profile.actions.follow', $account->username)}}"  :label="__('Follow')" size="sm"/>
                    @else
                        <x-circle-xo-button  href="{{route('profile.actions.unfollow', $account->username)}}" danger confirm-danger :label="__('UnFollow')" size="sm"/>
                    @endif
                @endif
                @if($account->meta('sponsoring_link'))
                    <x-tomato-admin-tooltip :text="__('Sponsoring')">
                        <x-splade-link href="{{ route('home.sponsoring', $account->username) }}" class="bg-danger-600 text-white rounded-md shadow-md font-bold text-sm px-4 py-2">
                            <i class="bx bxs-heart text-white"></i>
                        </x-splade-link>
                    </x-tomato-admin-tooltip>
                @endif
            </div>
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden">
               <x-circle-xo-social-links :account="$account"/>
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
