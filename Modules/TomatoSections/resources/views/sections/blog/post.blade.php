@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div style="background-color: {{$section['bg_color'] ?? '#efefef'}}; color: {{$section['font_color'] ?? '#000'}}">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
                <h2 class="text-2xl font-bold text-gray-900">{{ $section['title_'. app()->getLocale()] ?? "Blog" }}</h2>

                <div class="grid grid-cols-1 gap-4 lg:gap-8 sm:grid-cols-1 lg:grid-cols-2 font-main my-4">
                    @php $posts = \Modules\TomatoCms\App\Models\Post::whereIn('id', $section['posts'] ?? [])->get() @endphp
                    @foreach($posts as $post)
                        @include('tomato-sections::sections.blog.parts.blog-card')
                    @endforeach
                </div>
                <div class="flex justify-start">
                    <x-splade-link class="block text-main transition hover:text-sec font-medium py-4 text-lg"  :href="$section['url'] ?? '/blog'">
                        {{__("Show More")}}
                        @if(app()->getLocale() == 'ar')
                            <span class="text-xl font-bold">←</span>
                        @else
                            <span class="text-xl font-bold">→</span>
                        @endif
                    </x-splade-link>
                </div>
            </div>
        </div>
    </div>

</section>
