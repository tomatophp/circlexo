@php
    $section = $page->meta($section['uuid']);
@endphp
<div class="bg-white">
    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-8">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    {{ $page->title }}
                </h1>
            </div>

            <div class="my-4">
                {!! $page->body !!}
            </div>
        </main>
    </div>
</div>
