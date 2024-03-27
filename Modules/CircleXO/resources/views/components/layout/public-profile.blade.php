<div class="bg-zinc-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-full min-h-screen">
        <x-circle-xo-profile-cover :account="$account" />
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="justify-start gap-4 mt-8 mx-16 hidden lg:flex">
                <x-circle-xo-social-links :account="$account"/>
            </div>
            <div>
                <x-circle-xo-profile-avatar :account="$account" />
                <x-circle-xo-profile-info  :account="$account" />
            </div>
            <x-circle-xo-profile-buttons :account="$account" />
            <div class="justify-center md:justify-start gap-4 my-8 mx-16 flex lg:hidden">
               <x-circle-xo-social-links :account="$account"/>
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
