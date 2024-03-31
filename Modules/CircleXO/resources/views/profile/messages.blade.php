<x-circle-xo-profile-layout>
    <x-splade-data
        default="{
        makeMenuHide: false,
    }"

    remember="admin"
    local-storage
>

<div
        v-cloak
        v-show="data.makeMenuHide"
        @click.prevent="data.makeMenuHide = !data.makeMenuHide"
        class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay lg:hidden backdrop-blur"
>

</div>

    <div class="my-12 mx-8 lg:mx-16">
        <div class="relative overflow-hidden border border-zinc-700 -m-2.5 rounded-xl">
            <div class="flex bg-zinc-800">
                
                {{-- sidebar --}}
                <aside class="md:w-[360px] relative border-r border-zinc-700" >
                    <div :class="{'hidden md:block': !data.makeMenuHide}" class="top-0 left-0 max-md:fixed max-md:w-5/6 max-md:h-screen bg-zinc-800 z-50 max-md:shadow max-md:-tranzinc-x-full">
                        {{-- heading title --}}
                        <div class="p-4 border-b border-zinc-700">
                            <div class="flex mt-2 items-center justify-between">
                                <h2 class="text-2xl font-bold text-white ml-1">Chats</h2>
                            </div>
                            {{-- search --}}
                            <div class="relative mt-4">
                                <x-splade-form method="GET" action="{{url()->current()}}" :default="['search' => request()->get('search') ?? '']">
                                    <x-splade-input type="search" name="search" placeholder="{{__('Search ...')}}" />
                                </x-splade-form>
                            </div> 
                        </div> 

                        {{-- users list --}}
                        <div class="space-y-2 p-2 overflow-y-auto md:h-[calc(100vh-204px)] h-[calc(100vh-130px)]">
                            <a href="#" class="relative flex items-center gap-4 p-2 duration-200 rounded-xl hover:bg-zinc-700">
                                <div class="relative w-14 h-14 shrink-0"> 
                                    <img src="{{ asset('placeholder.webp') }}" alt="" class="object-cover w-full h-full rounded-full">
                                    <div class="w-4 h-4 absolute bottom-0 right-0  bg-green-500 rounded-full border border-zinc-800"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <div class="mr-auto text-sm text-white font-medium">Abdelmjid Saber</div>
                                        <div class="text-xs font-light text-white/70">09:40AM</div> 
                                    </div>
                                    <div class="font-medium overflow-hidden text-ellipsis text-sm whitespace-nowrap">Great, thank you.</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </aside> 

                {{-- message center --}}
                <div class="flex-1">
                    {{-- chat heading --}}
                    <div class="flex items-center justify-between gap-2 w- px-6 py-3.5 z-10 border-b border-zinc-700 uk-animation-slide-top-medium">
                        <div class="flex items-center sm:gap-4 gap-2">
                            {{-- toggle for mobile --}}
                            <button type="button" @click.prevent="data.makeMenuHide = !data.makeMenuHide" class="md:hidden">
                                <i class="bx bx-chevron-left text-4xl -ml-4"></i>
                            </button>
                            <div class="relative cursor-pointer max-md:hidden">
                                <img src="{{ asset('placeholder.webp') }}" alt="" class="w-8 h-8 rounded-full shadow">
                                <div class="w-2 h-2 bg-teal-500 rounded-full absolute right-0 bottom-0 m-px"></div>
                            </div>
                            <div class="cursor-pointer">
                                <div class="text-base font-bold">Abdelmjid Saber</div>
                                <div class="text-xs text-green-500 font-semibold">Online</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <Link slideover href="{{ route('profile.messages.profile-info.show', 'abdelmjid') }}" class="hover:bg-zinc-700 p-1.5 rounded-full">
                                <i class="bx bx-info-circle text-lg"></i>
                            </Link> 
                        </div>
                    </div>
                        
                    {{-- chats bubble --}}
                    <div class="w-full p-5 py-10 overflow-y-auto md:h-[calc(100vh-204px)] h-[calc(100vh-195px)]">

                        <div class="py-10 text-center text-sm lg:pt-8">
                            <img src="{{ asset('placeholder.webp') }}" class="w-24 h-24 rounded-full mx-auto mb-3" alt="">
                            <div class="mt-8">
                                <div class="md:text-xl text-base font-medium text-white">Abdelmjid Saber </div>
                                <div class="text-white/80 text-sm"> @AbdelmjidSaber </div>
                            </div>
                            <div class="mt-3.5">
                                <a href="#" class="inline-block rounded-lg px-4 py-1.5 text-sm font-semibold bg-zinc-700">View profile</a>
                            </div>
                        </div>

                        <div class="text-sm font-medium space-y-6">

                            {{-- received --}}
                            <div class="flex gap-3">
                                <img src="{{ asset('placeholder.webp') }}" alt="" class="w-9 h-9 rounded-full shadow">
                                <div class="px-4 py-2 rounded-[20px] max-w-sm bg-zinc-700"> Hi, I’m Fady </div>
                            </div> 

                            {{-- sent --}}
                            <div class="flex gap-2 flex-row-reverse items-end">
                                <img src="{{ asset('placeholder.webp') }}" alt="" class="w-5 h-5 rounded-full shadow">
                                <div class="px-4 py-2 rounded-[20px] max-w-sm bg-gradient-to-tr from-sky-500 to-blue-500 text-white shadow">  I’m Abdelmjid. welcome Fady</div>
                            </div> 

                            {{-- time --}}
                            <div class="flex justify-center "> 
                                <div class="font-medium text-white/70 text-sm">
                                    March 29,2024,6:30 PM
                                </div> 
                            </div>

  
                            {{-- sent --}}
                            <div class="flex gap-2 flex-row-reverse items-end">
                                <img src="{{ asset('placeholder.webp') }}" alt="" class="w-5 h-5 rounded-full shadow">
                                <div class="px-4 py-2 rounded-[20px] max-w-sm bg-gradient-to-tr from-sky-500 to-blue-500 text-white shadow">Great, thank you.</div>
                            </div> 
                        </div>
                    </div> 

                    {{-- sending message area --}}
                    <div class="flex items-center md:gap-4 gap-2 md:p-3 p-2 overflow-hidden">
                        <div class="relative flex-1">
                            <textarea placeholder="Write your message" rows="1" class="w-full resize-none bg-zinc-700 rounded-full px-4 p-2"></textarea>
                            <button type="submit" class="text-white shrink-0 p-2 absolute right-0.5 top-0">
                                <i class="bx bx-send text-xl flex"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-splade-data>
</x-circle-xo-profile-layout>
