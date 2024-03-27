<div class="flex justify-center flex-col items-center -mt-24 ">
    @if($account->avatar)
        @if($edit)
            <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-zinc-800 border border-zinc-700">
                <img src="{{ $account->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
            </x-splade-link>
        @else
            <div  class="w-32 h-32 rounded-full bg-zinc-800 border border-zinc-700">
                <img src="{{ $account->avatar }}" class="w-32 h-32 rounded-full object-cover" alt="avatar">
            </div>
        @endif
    @else
        @if($edit)
            <x-splade-link modal href="{{ route('profile.avatar.show') }}" class="w-32 h-32 rounded-full bg-zinc-800 flex justify-center border border-zinc-700">
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bx-upload text-5xl text-zinc-500"></i>
                </div>
            </x-splade-link>
        @else
            <div class="w-32 h-32 rounded-full bg-zinc-800 flex justify-center border border-zinc-700">
                <div class="flex flex-col justify-center items-center text-center h-full">
                    <i class="bx bxs-user text-5xl text-zinc-500"></i>
                </div>
            </div>
        @endif
    @endif
</div>
