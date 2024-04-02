<x-circle-xo-profile-layout>
    <x-splade-data
        default="{
        makeMenuHide: false,
    }"

    remember="profile_messages"
    local-storage
>

<div
        v-cloak
        v-show="data.makeMenuHide"
        @click.prevent="data.makeMenuHide = !data.makeMenuHide"
        class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay lg:hidden backdrop-blur"
>

</div>

    <div class="my-12 mx-8 lg:mx-16 " @preserveScroll('message')>
        <div class="relative overflow-hidden border border-zinc-700 -m-2.5 rounded-xl">
            <div class="flex bg-zinc-800">

                {{-- sidebar --}}
                <aside class="md:w-[360px] relative border-r border-zinc-700" >
                    <div :class="{'hidden md:block': !data.makeMenuHide}" class="top-0 left-0 max-md:fixed max-md:w-5/6 max-md:h-screen bg-zinc-800 z-50 max-md:shadow max-md:-tranzinc-x-full">
                        {{-- heading title --}}
                        <div class="p-4 border-b border-zinc-700">
                            <div class="flex mt-2 items-center justify-between">
                                <h2 class="text-2xl font-bold text-white ml-1">{{__('Chats')}}</h2>
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
                            @foreach($chats as $chat)
                                <x-splade-link preserve-scroll href="{{url()->current().'?chat='.$chat->id}}" class="relative flex items-center gap-4 p-2 duration-200 rounded-xl hover:bg-zinc-700">
                                    <div class="relative w-14 h-14 shrink-0">
                                        <img src="{{ $chat->sender?->getMedia('avatar')->first()?->getUrl() ?? asset('placeholder.webp') }}" alt="" class="border border-zinc-700 object-cover w-full h-full rounded-full">
{{--                                        <div class="w-4 h-4 absolute bottom-0 right-0  bg-green-500 rounded-full border border-zinc-800"></div>--}}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <div class="mr-auto text-sm text-white font-medium">{{$chat->sender?->name ?? __('Anonymous')}}</div>
                                            <div class="text-xs font-light text-white/70">{{$chat->created_at->diffForHumans()}}</div>
                                        </div>
                                        <div class="font-medium overflow-hidden text-ellipsis text-sm whitespace-nowrap">
                                            {{ $chat->message }}
                                        </div>
                                    </div>
                                </x-splade-link>
                            @endforeach

                            @if($chats->count() < 1)
                                <div class="relative flex items-center gap-4 p-2 duration-200 rounded-xl hover:bg-zinc-700">
                                       {{ __('No Message Here!') }}
                               </div>
                            @endif

                            {!! $chats->links('tomato-admin::components.pagination') !!}
                        </div>
                    </div>
                </aside>

                @php $lastMessage = $getSelectedChat ?: $chats->first(); @endphp
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
                                <img src="{{ $lastMessage->sender?->getMedia('avatar')->first()?->getUrl() ?? asset('placeholder.webp') }}" alt="" class="w-8 h-8 border border-zinc-700 rounded-full shadow">
{{--                                <div class="w-2 h-2 bg-teal-500 rounded-full absolute right-0 bottom-0 m-px"></div>--}}
                            </div>
                            <div class="cursor-pointer">
                                <div class="text-base font-bold">{{ $lastMessage->sender?->name ??__('Anonymous') }}</div>
{{--                                <div class="text-xs text-green-500 font-semibold">Online</div>--}}
                            </div>
                        </div>

                    </div>

                    @php
                        $chatMessages = \Modules\CircleXO\App\Models\AccountContact::query()
                            ->where('account_id', auth('accounts')->user()->id)
                            ->where('sender_id', $lastMessage->sender_id)
                            ->orWhere('account_id', $lastMessage->sender_id)
                            ->where('sender_id', auth('accounts')->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10, '*', 'messages');

                    @endphp

                    {{-- chats bubble --}}
                    <div class="w-full p-5  h-[calc(100vh-100px)] overflow-y-scroll" id="message_body">

                        <div class="py-10 text-center text-sm lg:pt-8">
                            <img src="{{ $lastMessage->sender?->getMedia('avatar')->first()?->getUrl() ?? asset('placeholder.webp') }}" class="w-24 h-24 border border-zinc-700 rounded-full mx-auto mb-3" alt="">
                            <div class="mt-8">
                                <div class="md:text-xl text-base font-medium text-white">{{ $lastMessage->sender?->name ?? __('Anonymous') }}</div>
                                <div class="text-white/80 text-sm">{{ $lastMessage->sender?->username }}</div>
                            </div>
                            <div class="mt-3.5">
                                <x-splade-link :href="$lastMessage->sender?->username ? url($lastMessage->sender?->username) : '#'" class="inline-block rounded-lg px-4 py-1.5 text-sm font-semibold bg-zinc-700">
                                    {{__('View profile')}}
                                </x-splade-link>
                            </div>
                        </div>


                        @if(!request()->has('messages') || (request()->has('messages') && request()->get('messages') != $chatMessages->lastPage()))
                            <x-splade-link preserve-scroll :href="url()->current().'?messages='. (request()->has('messages') ? (int)request()->get('messages')+1 : 2)">
                                <div class="w-full bg-zinc-700 p-2 my-4 text-center font-bold rounded-lg">
                                    {{__('Load Old Messages')}}
                                </div>
                            </x-splade-link>
                        @endif

                        <div class="text-sm font-medium space-y-6">


                            @if($chatMessages->count() < 1)
                                <div class="text-center text-white/70">
                                    {{ __('No Messages Here!') }}
                                </div>
                            @endif

                            @foreach($chatMessages->reverse() as $chatMessage)
                                @if($chatMessage->sender_id == auth('accounts')->user()->id)
                                    {{-- received --}}
                                    <div class="flex gap-3" style="white-space: pre-line !important;">
                                        <x-splade-link :href="$chatMessage->sender?->username ? url($chatMessage->sender?->username) : '#'">
                                            <img src="{{ $chatMessage->sender?->getMedia('avatar')->first()?->getUrl() ?? asset('placeholder.webp') }}" alt="" class="border border-zinc-700 w-9 h-9 rounded-full shadow">
                                        </x-splade-link>
                                        <pre class="px-4 py-2 rounded-[20px] max-w-sm bg-zinc-700  font-main" style="white-space: pre-line !important;">{{ $chatMessage->message }}</pre>
                                    </div>
                                @else
                                    {{-- sent --}}
                                    <div class="flex gap-2 flex-row-reverse items-end" style="white-space: pre-line !important;">
                                        <x-splade-link :href="$chatMessage->sender?->username ? url($chatMessage->sender?->username) : '#'">
                                            <img src="{{ $chatMessage->sender?->getMedia('avatar')->first()?->getUrl() ?? asset('placeholder.webp') }}" alt="" class="border border-zinc-700 w-5 h-5 rounded-full shadow">
                                        </x-splade-link>
                                        <pre class="px-4 py-2 rounded-[20px] max-w-sm bg-gradient-to-tr from-sky-500 to-blue-500 text-white shadow font-main" style="white-space: pre-line !important;">
                                            {{ $chatMessage->message }}
                                        </pre>
                                    </div>
                                @endif
                            @endforeach

                            @if(request()->has('messages') && request()->get('messages') != 1)
                                <x-splade-link preserve-scroll :href="url()->current().'?messages='. (int)request()->get('messages')-1" >
                                    <div class="w-full bg-zinc-700 p-2 my-4 text-center font-bold rounded-lg">
                                        {{__('Load New Messages')}}
                                    </div>
                                </x-splade-link>
                            @endif
                        </div>
                    </div>

                    @if($lastMessage->sender)
                    {{-- sending message area --}}
                    <x-splade-form preserve-scroll method="POST" :default="['anonymous_message' => false, 'name' =>$lastMessage->sender?->name, 'email' =>$lastMessage->sender?->email]" :action="route('home.contact.send', $lastMessage->sender?->username)">
                        <div class="flex items-center md:gap-4 gap-2 md:p-3 p-2 overflow-hidden">
                            <div  class="relative flex-1">
                                <textarea autosize id="message" placeholder="{{__('Write your message')}}" @keyup.enter="(event) => { event.shiftKey?null:form.submit() }" v-model="form.message" rows="1" class="w-full resize-none bg-zinc-700 rounded-full px-4 p-2" />
                                <button type="submit" class="text-white shrink-0 p-2 absolute right-0.5 top-0">
                                    <i class="bx bx-send text-xl flex"></i>
                                </button>
                            </div>
                        </div>
                    </x-splade-form>

                    @endif
                </div>
            </div>
        </div>
    </div>

</x-splade-data>
</x-circle-xo-profile-layout>
<x-splade-script>
    document.getElementById('message')?.focus();
    var objDiv = document.getElementById("message_body");
    objDiv.scrollTop = objDiv.scrollHeight;

</x-splade-script>
