<x-splade-modal>
    <x-slot:title>
        {{ __('Link Social Accounts') }}
    </x-slot>
    <div class="flex flex-col gap-4">
        @if(!auth('accounts')->user()->meta('twitter-oauth-2_id'))
            <a href="{{ url('login/twitter') }}" class="flex justify-center gap-2 text-white px-4 py-2 rounded-lg" style="background-color: #1DA1F2">
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-twitter text-lg"></i>
                </div>
                <div>
                    {{__('Link Twitter Account')}}
                </div>
            </a>
        @else
            <x-splade-link confirm-danger method="POST" data="{'provider': 'twitter-oauth-2'}" href="{{ route('profile.social-accounts.update') }}" class="flex justify-center gap-2 text-white px-4 py-2 rounded-lg bg-danger-500" >
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-twitter text-lg"></i>
                </div>
                <div>
                    {{__('Disconnect Twitter Account')}}
                </div>
            </x-splade-link>
        @endif
        @if(!auth('accounts')->user()->meta('github_id'))
            <a href="{{ url('login/github') }}" class="flex justify-center gap-2 text-white bg-zinc-700 px-4 py-2 rounded-lg">
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-github text-lg"></i>
                </div>
                <div>
                    {{__('Link GitHub Account')}}
                </div>
            </a>
        @else
            <x-splade-link confirm-danger method="POST" data="{'provider': 'github'}" href="{{ route('profile.social-accounts.update') }}" class="flex justify-center gap-2 text-white bg-danger-500 px-4 py-2 rounded-lg">
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-github text-lg"></i>
                </div>
                <div>
                    {{__('Disconnect GitHub Account')}}
                </div>
            </x-splade-link>
        @endif
        @if(!auth('accounts')->user()->meta('discord_id'))
            <a href="{{ url('login/discord') }}" class="flex justify-center gap-2 text-white px-4 py-2 rounded-lg" style="background-color: #7289da">
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-discord text-lg"></i>
                </div>
                <div>
                    {{__('Link Discord Account')}}
                </div>
            </a>
        @else
            <x-splade-link confirm-danger method="POST" data="{'provider': 'discord'}" href="{{ route('profile.social-accounts.update') }}" class="flex justify-center gap-2 text-white px-4 py-2 rounded-lg bg-danger-500">
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bxl-discord text-lg"></i>
                </div>
                <div>
                    {{__('Disconnect Discord Account')}}
                </div>
            </x-splade-link>
        @endif
    </div>
</x-splade-modal>
