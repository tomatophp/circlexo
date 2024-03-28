@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8"  style="background-color: {{$section['bg_color'] ?? '#fff'}}; color: {{$section['font_color'] ?? '#000'}}">
        <header class="text-center">
            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">
                {{ $section['title_'.app()->getLocale()] ?? "Product Collection" }}
            </h2>

            <p class="max-w-md mx-auto mt-4 text-gray-500">
                {{ $section['description_'.app()->getLocale()] ?? "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium cumque iure dicta incidunt est ipsam, officia dolor fugit natus?" }}
            </p>
        </header>
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="sr-only">{{ $section['title_'.app()->getLocale()] ?? "Product Collection" }}</h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @php $products = \Modules\TomatoProducts\App\Models\Product::whereIn('id', $section['products'] ?? [])->get() @endphp
                    @foreach($products as $product)
                        @include('tomato-sections::sections.shop.partials.product-card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
