<x-splade-link :href="url($item->account->username)">
    @if($item->account->avatar)
        <div  class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700">
            <img src="{{ $item->account->avatar }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
        </div>
    @else
        <div  class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700">
            <div class="flex flex-col justify-center items-center text-center h-full">
                <i class="bx bxs-user text-5xl text-zinc-500"></i>
            </div>
        </div>
    @endif
</x-splade-link>
