@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div style="background-color: {{$section['bg_color'] ?? '#efefef'}}; color: {{$section['font_color'] ?? '#000'}}">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
                <h2 class="text-2xl font-bold text-gray-900">{{ $section['title_'. app()->getLocale()] ?? "Categories" }}</h2>

                <div class="mt-6 gap-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-4">
                    @php $categories = \Modules\TomatoCategory\App\Models\Category::whereIn('id', $section['categories'] ?? [])->get() @endphp
                    @foreach($categories as $category)
                        <x-splade-link href="{{url('/shop?categories[]=' . $category->id)}}" class="group relative">
                            <div class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                                <img src="{{$category->getMedia('image')->first()?->getUrl() ?? url('placeholder.webp')}}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="h-full w-full object-cover object-center">
                            </div>
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    {{ $category->description }}
                                </a>
                            </h3>
                            <p class="text-base font-semibold text-gray-900">{{$category->name}}</p>
                        </x-splade-link>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</section>
