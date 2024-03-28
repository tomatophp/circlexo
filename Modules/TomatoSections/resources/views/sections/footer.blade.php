@php $section = $page->meta($section['uuid']); @endphp
<footer class="bg-gray-100 w-full">
    <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex justify-center text-teal-600">
            @if(setting('site_logo'))
            <img src="{{setting('site_logo')}}" class="h-16" />
            @else
                <x-tomato-application-logo class="h-16"/>
            @endif
        </div>

        <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
            {{ setting('site_description') }}
        </p>

        <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-12">
            @foreach(menu($section['menu_id'] ?? 'footer') as $item)
                <li>
                    <x-splade-link :href="$item->url" class="text-gray-700 transition hover:text-gray-700/75">
                        {{$item->name}}
                    </x-splade-link>
                </li>
            @endforeach
        </ul>

        <ul class="mt-12 flex justify-center gap-6 md:gap-8">
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
    </div>
</footer>
