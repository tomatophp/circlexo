<x-circle-xo-profile-layout>
    <div class="my-4">
        <div @preserveScroll class="mx-8 lg:mx-0">
            <Swiper
                :breakpoints="{
          '350': {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          '768': {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          '1024': {
            slidesPerView: 4,
            spaceBetween: 10,
          },
        }"
                :space-between="10"
                :loop="true"
                :centeredSlides="true"
                class="w-full lg:w-1/2"
            >
                <swiper-slide class="club-swiper-slide" >
                    <div class="swiper-slide">
                        <Link preserve-scroll href="{{ route('profile.invoices.index') }}"
                              class="@if(url()->current() === route('profile.invoices.index') && !request()->has('status')) font-bold bg-zinc-800 @endif px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm"
                        >
                        <div class="flex flex-col justify-center items-center">
                            <div class="rounded-full bg-main-600 h-10 w-10 flex flex-col justify-center items-center">
                                <i class="bx bxs-receipt text-xl"></i>
                            </div>
                        </div>
                        <div>
                            {{ __('All Invoices') }}
                        </div>
                        </Link>
                    </div>
                </swiper-slide>
                <swiper-slide class="club-swiper-slide" >
                    <div class="swiper-slide">
                        <Link preserve-scroll href="{{ route('profile.invoices.index') .'?status=pending'}}"
                              class="@if(request()->has('status') && request()->get('status') == 'pending') font-bold bg-zinc-800 @endif px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm"
                        >
                        <div class="flex flex-col justify-center items-center">
                            <div class="rounded-full bg-warning-600 h-10 w-10 flex flex-col justify-center items-center">
                                <i class="bx bx-pause-circle text-xl"></i>
                            </div>
                        </div>
                        <div>
                            {{ __('Pending') }}
                        </div>
                        </Link>
                    </div>
                </swiper-slide>
            </Swiper>
        </div>
        <div class="mx-8 lg:mx-16">
            @yield('content')
        </div>
    </div>
</x-circle-xo-profile-layout>
