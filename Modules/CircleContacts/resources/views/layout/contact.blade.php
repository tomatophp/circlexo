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
                        <Link preserve-scroll href="{{ route('profile.contacts.index') }}"
                              class="@if(url()->current() === route('profile.contacts.index') && !request()->has('group_id')) font-bold bg-zinc-800 @endif px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm"
                        >
                        <div class="flex flex-col justify-center items-center">
                            <div class="rounded-full bg-main-600 h-10 w-10 flex flex-col justify-center items-center">
                                <i class="bx bxs-user text-xl"></i>
                            </div>
                        </div>
                        <div>
                            {{ __('All Contacts') }}
                        </div>
                        </Link>
                    </div>
                </swiper-slide>
                @php $groups = \Modules\CircleContacts\App\Models\CircleXoContactsGroup::all(); @endphp
                @foreach($groups as $group)
                    <swiper-slide class="club-swiper-slide" >
                        <div class="swiper-slide">
                            <Link preserve-scroll href="{{ route('profile.contacts.index') .'?group_id='. $group->id }}"
                                  class="@if(request()->has('group_id') && request()->get('group_id') == $group->id) font-bold bg-zinc-800 @endif px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm"
                            >
                            <div class="flex flex-col justify-center items-center">
                                <div style="background-color: {{ $group->color ?: 'rgb(0 224 178 / var(--tw-text-opacity))' }}" class="rounded-full h-10 w-10 flex flex-col justify-center items-center">
                                    @if($group->icon)
                                        <i class="{{ $group->icon }} text-xl"></i>
                                    @else
                                        <i class="bx bxs-group text-xl"></i>
                                    @endif
                                </div>
                            </div>
                            <div>
                                {{ $group->name }}
                            </div>
                            </Link>
                        </div>
                    </swiper-slide>
                @endforeach

            </Swiper>
        </div>
        <div class="mx-8 lg:mx-16">
            @yield('content')
        </div>
    </div>
</x-circle-xo-profile-layout>
