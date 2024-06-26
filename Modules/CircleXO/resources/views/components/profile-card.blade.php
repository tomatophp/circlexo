<div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64">
    <div class="flex flex-col items-center justify-center">
        <div class="my-4">
            @if($account->avatar)
                <div  class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700">
                    <img src="{{ $account->avatar }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                </div>
            @else
                <div  class="w-24 h-24 rounded-full bg-zinc-800 flex justify-center border border-zinc-700">
                    <div class="flex flex-col justify-center items-center text-center h-full">
                        <i class="bx bxs-user text-5xl text-zinc-500"></i>
                    </div>
                </div>
            @endif
        </div>
        <x-splade-link href="{{ route('profile', $account->username) }}" class="flex justify-center gap-2 font-bold w-full">
            <h1 class="text-xl truncate">{{ $account->name }}</h1>
            @if($account->type === 'verified')
                <div class="flex flex-col justify-center items-center mt-1">
                    <x-tomato-admin-tooltip :text="__('Verified Account')">
                        <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                    </x-tomato-admin-tooltip>
                </div>
            @endif
        </x-splade-link>
        <h6 class="text-sm font-medium text-zinc-300">{{$account->username}}</h6>
        @if($account->bio)
        <p class="text-xs text-center my-2 w-full truncate">
            {{$account->bio}}
        </p>
        @endif
        <div class="my-4">
            @if(auth('accounts')->user())
                @if(!auth('accounts')->user()->isFollowing($account))
                    <x-circle-xo-button  href="{{route('profile.actions.follow', $account->username)}}"  :label="__('Follow')" size="sm"/>
                @else
                    <x-circle-xo-button  href="{{route('profile.actions.unfollow', $account->username)}}" danger confirm-danger :label="__('UnFollow')" size="sm"/>
                @endif
            @endif
        </div>
        <h6 class="mt-2 text-sm text-zinc-300">
            <span>{{  $account->followers()->count() .' ' . __('Followers')}}</span> .
            <span>{{  $account->followings()->count() .' ' . __('Following') }}</span>
        </h6>
        <h6 class="my-2 text-sm text-zinc-300">
            {{__('Joined')}} {{ $account->created_at->diffForHumans() }}
        </h6>
    </div>
</div>
