@php
$username = str(url()->current())->explode('@')->last();
if($username !== url()->current()){
    $account = str($username)->explode('/')->first();
}
else {
    $account = null;
}
@endphp
@if($account)
<swiper-slide class="club-swiper-slide" >
    <div class="swiper-slide">
        <Link preserve-scroll href="{{ url('@'.$account .'/docs') }}"
              class="px-4 md:px-6 py-2 flex flex-col text-center justify-center gap-2 border border-zinc-700 rounded-lg shadow-sm @if(url()->current() === url('@'.$account .'/docs')) font-bold bg-zinc-800 @endif"
        >
        <div class="flex flex-col justify-center items-center">
            <div  class="rounded-full h-10 w-10 flex flex-col justify-center items-center bg-warning-500">
                <i class="bx bxs-file-doc text-xl"></i>
            </div>
        </div>
        <div>
            {{ __('Docs') }}
        </div>
        </Link>
    </div>
</swiper-slide>
@endif
