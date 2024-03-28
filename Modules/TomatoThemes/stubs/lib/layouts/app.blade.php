<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @include('themes::layouts.includes.header')
    @include('themes::layouts.includes.nav')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @yield('body')
        @include('themes::layouts.includes.footer')
    </div>
</div>

<x-splade-script>
    {!! theme_setting('js') !!}
</x-splade-script>
