@php
    $section = $page->meta($section['uuid']);
@endphp
<div class="min-h-screen">
    <div class="bg-zinc-800 border-b border-zinc-700">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-baseline justify-between p-4">
            <div class="text-4xl font-bold tracking-tight text-zinc-200">
                {{ $page->title }}
            </div>
        </div>
    </div>
    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-tomato-markdown-viewer :content="$page->body" />
    </main>
</div>
