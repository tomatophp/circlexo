<div class="h-[150px] lg:h-[350px] bg-zinc-700 bg-cover border-b border-zinc-700">
    @if($account->cover)
        @if($edit)
            <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                <img src="{{ $account->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="cover">
            </x-splade-link>
        @else
            <div class="flex flex-col justify-center items-center text-center h-full">
                <img src="{{ $account->cover }}" class="w-full h-full bg-cover bg-center object-cover" alt="cover">
            </div>
        @endif
    @else
        @if($edit)
            <x-splade-link modal :href="route('profile.cover.show')" class="flex flex-col justify-center items-center text-center h-full">
                <i class="bx bx-upload text-5xl text-zinc-500"></i>
                <h1>{{__('Upload a Cover')}}</h1>
            </x-splade-link>
        @else
            <div class="flex flex-col justify-center items-center text-center h-full">
                <i class="bx bxs-image text-5xl text-zinc-500"></i>
            </div>
        @endif
    @endif
</div>
