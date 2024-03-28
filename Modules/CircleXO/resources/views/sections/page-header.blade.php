@php $section = $page->meta($section['uuid']); @endphp
<section class="relative overflow-hidden text-white font-main" style="background-color: {{$section['bg_color'] ?? '#efefef'}}; color: {{$section['font_color'] ?? '#000'}}">
    <div class="max-w-screen-xl px-8 py-32 mx-auto lg:items-center lg:flex">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="py-2 text-3xl font-extrabold sm:text-5xl">
                {{$section['title'] ?? __('Page Title')}}
            </h1>
            @if(isset($section['description']))
                <p class="my-1 text-lg text-white">
                    {{$section['description'] }}
                </p>
            @endif
        </div>
    </div>
</section>
