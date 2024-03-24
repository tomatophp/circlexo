<div class="bg-gray-900 min-h-screen min-w-screen h-full w-full text-white">
    <x-circle-xo-header />
    <div class="h-screen">
        <div class="h-[350px] bg-gray-700 bg-cover">

        </div>
        <div class="grid grid-cols-3">
            <div class="flex justify-start gap-4 mt-8 mx-16">
                <a href="https://www.facebook.com" target="_blank">
                    <i class="bx bxl-facebook text-2xl text-gray-200 hover:text-white"></i>
                </a>
                <a href="https://www.twitter.com" target="_blank">
                    <i class="bx bxl-twitter text-2xl text-gray-200 hover:text-white"></i>
                </a>
                <a href="https://www.github.com" target="_blank">
                    <i class="bx bxl-github text-2xl text-gray-200 hover:text-white"></i>
                </a>
                <a href="https://www.youtube.com" target="_blank">
                    <i class="bx bxl-youtube text-2xl text-gray-200 hover:text-white"></i>
                </a>
            </div>
            <div>
                <div class="flex justify-center flex-col items-center -mt-12">
                    <div class="w-32 h-32 rounded-full bg-gray-800">

                    </div>
                </div>
                <div class="text-center flex flex-col mt-4">
                    <div class="flex justify-center gap-2  font-bold">
                        <h1 class="text-2xl">{{ $account->name }}</h1>
                        <div class="flex flex-col justify-center items-center mt-1">
                            <i class="bx bxs-check-circle text-green-500 text-lg"></i>
                        </div>
                    </div>
                    <h6 class="text-sm font-medium text-gray-300">{{ $account->username }}</h6>
                    @if($account->bio)
                        <p class="text-xs text-center my-2">
                            {{ $account->bio  }}
                        </p>
                    @endif

                    <h6 class="my-2 text-sm text-gray-300">Joined {{ $account->created_at?->diffForHumans() }}</h6>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-8 mx-16">
                <x-circle-xo-button href="{{url('qr')}}" label="QR" size="sm"/>
                <x-circle-xo-button href="{{url('contact')}}" label="Contact" size="sm"/>
                <x-circle-xo-button href="{{url('follow')}}" label="Follow" size="sm"/>
            </div>
        </div>
        {{ $slot }}
    </div>
    <x-circle-xo-footer />
</div>
