<div class="text-center flex flex-col mt-4">
    <div class="flex justify-center gap-2 font-bold">
        <x-splade-link :href="url($account->username)"  class="text-2xl">{{ $account->name }}</x-splade-link>
        @if($account->type === 'verified')
            <div class="flex flex-col justify-center items-center mt-2">
                <x-tomato-admin-tooltip :text="__('Verified Account')">
                    <i class="bx bxs-badge-check text-blue-400 text-xl"></i>
                </x-tomato-admin-tooltip>
            </div>
        @endif
        @if($edit)
            <x-splade-link modal :href="route('profile.info.show')" class="flex flex-col justify-center items-center mt-1">
                <i class="bx bxs-edit text-green-500 text-lg"></i>
            </x-splade-link>
        @endif
    </div>
    @if($edit)
        <x-tomato-admin-copy :text="url('/' . $account->username)">
            <div class="flex justify-center gap-2">
                <i class="bx bx-copy text-sm text-main-600 mt-1"></i>
                <h6 class="text-sm font-medium text-zinc-300">{{ $account->username }}</h6>
            </div>
        </x-tomato-admin-copy>
    @else
        <div class="flex justify-center gap-2">
            <h6 class="text-sm font-medium text-zinc-300">{{ $account->username }}</h6>
        </div>
    @endif
    @if($account->bio)
        <p class="text-xs text-center my-2 mx-2">
            {{ $account->bio }}
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
    <h6 class="my-2 text-sm text-zinc-300">
        @if($edit)
            <x-splade-link :href="route('profile.followers')">{{  $account->followers()->count() .' ' . __('Followers')}}</x-splade-link> .
            <x-splade-link :href="route('profile.following')">{{  $account->followings()->count() .' ' . __('Following') }}</x-splade-link> .
        @else
            <span>{{  $account->followers()->count() .' ' . __('Followers')}}</span> .
            <span>{{  $account->followings()->count() .' ' . __('Following') }}</span> .
        @endif
        {{__('Joined')}} {{ $account->created_at->diffForHumans() }}
    </h6>
</div>
