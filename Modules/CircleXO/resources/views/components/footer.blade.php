<footer class="p-4 border-t-2 border-gray-700 bg-gray-800">
    <nav class="grid grid-cols-1 lg:grid-cols-2">
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
    </nav>
</footer>
