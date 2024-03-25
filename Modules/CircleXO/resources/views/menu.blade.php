<x-splade-modal position="left">
    <div class="h-screen flex flex-col justify-center items-center gap-4">
        <x-splade-link :href="route('home')" class="text-white hover:text-main-600 font-bold text-lg">
            {{__('Home')}}
        </x-splade-link>
        @if(auth('accounts')->user())
            <x-splade-link :href="route('profile.index')" class="text-white hover:text-main-600 font-bold text-lg">
                {{__('Profile')}}
            </x-splade-link>
            <x-splade-link method="POST" :href="route('profile.logout')" class="text-white hover:text-main-600 font-bold text-lg">
                {{__('Logout')}}
            </x-splade-link>
        @else
            <x-splade-link :href="route('account.login')" class="text-white hover:text-main-600 font-bold text-lg">
                {{__('Login')}}
            </x-splade-link>
            <x-splade-link :href="route('account.register')" class="text-white hover:text-main-600 font-bold text-lg">
                {{__('Register')}}
            </x-splade-link>
        @endif
    </div>
</x-splade-modal>
