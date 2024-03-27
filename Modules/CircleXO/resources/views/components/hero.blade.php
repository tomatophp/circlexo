<section class="container max-w-screen-xl px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 h-full">
        <div class="flex justify-center items-start w-full">
            <div class="flex flex-col justify-center text-start gap-2 px-16 py-16 md:py-32">
                <h1 class="text-4xl lg:text-6xl font-bold text-main-600">Join Our Hub</h1>
                <h6 class="text-xl md:text-3xl lg:text-4xl font-bold text-zinc-300">Full Busincess Services on your
                    profile</h6>
                <div class="mt-8">
                    @if (auth('accounts')->user())
                        <x-circle-xo-button :label="__('Profile')" size="lg" href="{{ route('profile.index') }}"
                            primary />
                    @else
                        <x-circle-xo-button :label="__('Sign Up')" size="lg" href="{{ route('account.register') }}"
                            primary />
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center items-start py-8 md:py-32">
            @php
                $accounts = \App\Models\Account::inRandomOrder()->take(4)->get();
            @endphp
            <CardsSlider>
                @foreach ($accounts as $account)
                    <swiper-slide>
                        <x-circle-xo-profile-card :account="$account" />
                    </swiper-slide>
                @endforeach
            </CardsSlider>
        </div>
    </div>
</section>
