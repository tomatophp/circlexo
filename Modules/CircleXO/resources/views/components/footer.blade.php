<footer class="p-4 border-t-2 border-zinc-700 bg-zinc-800">
    <nav class="grid grid-cols-1 gap-2">
        <div class="text-white flex justify-center w-full ">
            <x-splade-link href="{{ route('home') }}">
                <x-circle-xo-logo class="h-6 md:h-10 w-auto my-2" />
            </x-splade-link>
        </div>
        <div class="w-full flex flex-col justify-center items-center">
            <div>
                <p class="text-white">©Copyrights reserved for <x-splade-link href="{{ route('home') }}" class="text-main-600 font-bold">CircleXO</x-splade-link> {{ date('Y') }}</p>
            </div>
        </div>
        @if(count(menu('footer')))
            <ul class="flex flex-wrap justify-center gap-4 ">
                @foreach(menu('footer') as $item)
                    <li>
                        <x-splade-link :href="$item->url" class="text-zinc-200 transition hover:text-zinc-300">
                            {{$item->name}}
                        </x-splade-link>
                    </li>
                @endforeach
            </ul>
        @endif

        @if(count(setting('site_social')))
            <ul class="flex justify-center gap-6 md:gap-8">
                @foreach(setting('site_social') as $item)
                    <li>
                        <a
                            href="{{$item['url']}}"
                            rel="noreferrer"
                            target="_blank"
                            class="text-gray-700 transition hover:text-gray-700/75"
                        >
                            <span class="sr-only">{{$item['network']}}</span>
                            <i class="bx bxl-{{$item['network']}} bx-sm"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </nav>
</footer>
