@php
    $account = auth('accounts')->user();
@endphp

<div class="bg-zinc-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <x-circle-xo-profile-cover edit :account="$account" />

        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if($account->meta('social'))
                    <x-circle-xo-social-links edit :account="$account"/>
                @endif
            </div>
            <div>
                <x-circle-xo-profile-avatar edit :account="$account" />
                <x-circle-xo-profile-info edit :account="$account" />
            </div>
            <x-circle-xo-profile-buttons edit :account="$account" />
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden ">
                <x-splade-link modal :href="route('profile.social.show')">
                    <i class="bx bx-plus-circle text-2xl text-main-600 hover:text-white"></i>
                </x-splade-link>
                @if($account->meta('social'))
                    <x-circle-xo-social-links edit :account="$account"/>
                @endif
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>

@if(auth('accounts')->user())
    <x-splade-event private :channel="'accounts.'.auth('accounts')->user()->id" listen="UserEvent"/>
@endif

