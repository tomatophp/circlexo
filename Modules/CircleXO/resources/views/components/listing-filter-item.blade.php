@php
    $username = str(url()->current())->explode('@')->last();
    if($username !== url()->current()){
        $account = '@'.str($username)->explode('/')->first();
    }
    else {
        if(str(url()->current())->contains('profile')){
            $account = url('profile');
        }
        $account = null;
    }
@endphp
@if($link)
    <swiper-slide class="club-swiper-slide" >
        <div class="swiper-slide">
            <Link preserve-scroll href="{{ $account ? url($account) . '?type='.$filter : url('profile') . '?type='.$filter }}"
                {{ $attributes->class([
                  "px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm",
                  "font-bold bg-zinc-800" => (request()->has('type') && request()->get('type') === $filter),
                ]) }}
            >
            <div class="flex flex-col justify-center items-center">
                <div style="background-color: {{ $color }}" class="rounded-full h-10 w-10 flex flex-col justify-center items-center">
                    <i class="{{ $icon }} text-xl"></i>
                </div>
            </div>
            <div>
                {{ $label }}
            </div>
            </Link>
        </div>
    </swiper-slide>
@else
    <button @click.prevent="form.type = @js($filter)"
            class="px-4 md:px-6 py-2 border border-zinc-900 rounded-lg shadow-sm bg-zinc-800 text-white"
            :class="{'font-bold bg-zinc-900': form.type === @js($filter)}"
    >
        <div class="flex flex-col text-center justify-center gap-2">
            <div class="flex flex-col justify-center items-center">
                <div style="background-color: {{ $color }}" class="rounded-full h-10 w-10 flex flex-col justify-center items-center">
                    <i class="{{ $icon }} text-xl"></i>

                </div>
            </div>
            <div>
                {{ $label }}
            </div>
        </div>
    </button>
@endif
