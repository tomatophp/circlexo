<x-tomato-admin-dropdown>
    <x-slot:button>
        {{ $slot }}
    </x-slot:button>

    <ShareNetwork
        network="facebook"
        url="{{$url ?? url()->current()}}"
        title="{{$title}}"
        description="{{$description}}"
        quote="{{$description}}"
    >
        <div class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2 ">
                <div class="flex flex-col items-center justify-center">
                    <i class="bx bxl-facebook text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{__('Share On Facebook')}}
                </div>
            </div>
        </div>
    </ShareNetwork>
    <ShareNetwork
        network="twitter"
        url="{{$url ?? url()->current()}}"
        title="{{$title}}"
        description="{{$description}}"
        quote="{{$description}}"
    >
        <div class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2 ">
                <div class="flex flex-col items-center justify-center">
                    <i class="bx bxl-twitter text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{__('Share On Twitter')}}
                </div>
            </div>
        </div>
    </ShareNetwork>
    <ShareNetwork
        network="linkedin"
        url="{{$url ?? url()->current()}}"
        title="{{$title}}"
        description="{{$description}}"
        quote="{{$description}}"
    >
        <div class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2 ">
                <div class="flex flex-col items-center justify-center">
                    <i class="bx bxl-linkedin text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{__('Share On Linkedin')}}
                </div>
            </div>
        </div>
    </ShareNetwork>
    <ShareNetwork
        network="whatsapp"
        url="{{$url ?? url()->current()}}"
        title="{{$title}}"
        description="{{$description}}"
        quote="{{$description}}"
    >
        <div class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2 ">
                <div class="flex flex-col items-center justify-center">
                    <i class="bx bxl-whatsapp text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{__('Share On Whatsapp')}}
                </div>
            </div>
        </div>
    </ShareNetwork>
    <ShareNetwork
        network="telegram"
        url="{{$url ?? url()->current()}}"
        title="{{$title}}"
        description="{{$description}}"
        quote="{{$description}}"
    >
        <div class="whitespace-nowrap block w-full px-4 py-2  text-sm leading-5 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:bg-zinc-100 dark:focus:bg-zinc-800 transition duration-150 ease-in-out">
            <div class="flex justify-start gap-2 ">
                <div class="flex flex-col items-center justify-center">
                    <i class="bx bxl-telegram text-sm"></i>
                </div>
                <div class="text-sm ">
                    {{__('Share On Telegram')}}
                </div>
            </div>
        </div>
    </ShareNetwork>
</x-tomato-admin-dropdown>
