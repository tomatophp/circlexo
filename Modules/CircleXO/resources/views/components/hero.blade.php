<div class="grid grid-cols-1 h-screen">
    <div class="flex flex-col items-center justify-center">
        <div class="flex justify-center items-center w-full">
            <div class="flex flex-col justify-center text-center gap-2 px-16 py-32">
                <i class="bx bxs-user-circle text-9xl text-main-600"></i>
                <h1  class="text-2xl md:text-4xl lg:text-6xl font-bold text-main-600">Start a web journey with a sharable profile link</h1>
                <h6 class="text-md md:text-2xl lg:text-3xl font-light text-gray-300">share your social media <span class="text-thead-600 font-bold">links</span> and your <span class="font-bold text-second-600">skills</span> and more on one place</h6>
                <div class="mt-8">
                    <x-circle-xo-button label="Sign Up" size="lg" href="{{ route('account.register') }}" primary />
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="flex flex-col justify-center  p-16">
                <x-circle-xo-profile-card :account="App\Models\Account::first()"/>
                <div class="flex justify-between gap-4">
                    <x-circle-xo-button />
                    <x-circle-xo-button />
                    <x-circle-xo-button />
                </div>
            </div>
        </div>
    </div>
</div>
