<x-splade-modal>
    <div class="py-10 text-center text-sm pt-20">
        <img src="{{ asset('placeholder.webp') }}" class="w-24 h-24 rounded-full mx-auto mb-3" alt="">
        <div class="mt-8">
            <div class="md:text-xl text-base font-medium text-white">Abdelmjid Saber</div>
            <div class="text-white/80 text-sm mt-1">@AbdelmjidSaber</div>
        </div>
        <div class="mt-5">
            <a href="#"
                class="inline-block rounded-full px-4 py-1.5 text-sm font-semibold bg-zinc-700 text-white">View
                profile</a>
        </div>
    </div>

    <hr class="border-zinc-700 opacity-80">

    <ul class="text-base font-medium p-3">
        <li>
            <div class="flex items-center gap-5 rounded-md p-3 w-full hover:bg-zinc-700 text-white">
                <i class="bx bx-bell-off text-2xl"></i>
                Mute Notification
            </div>
        </li>
        <li>
            <button type="button" class="flex items-center gap-5 rounded-md p-3 w-full hover:bg-zinc-700 text-white">
                <i class="bx bx-flag text-2xl"></i>
                Report
            </button>
        </li>
        <li>
            <button type="button" class="flex items-center gap-5 rounded-md p-3 w-full hover:bg-zinc-700 text-white">
                <i class="bx bx-stop-circle text-2xl"></i>
                Block
            </button>
        </li>
        <li>
            <button type="button" class="flex items-center gap-5 rounded-md p-3 w-full hover:bg-red-50 text-red-500">
                <i class="bx bx-trash text-2xl"></i>
                Delete Chat
            </button>
        </li>
    </ul>
    </div>
</x-splade-modal>
