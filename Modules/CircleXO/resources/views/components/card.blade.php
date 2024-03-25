@if($title)
<div class="mb-8 flex justify-start gap-4 bg-gray-900 rounded-lg border border-gray-700 h-28 w-full lg:w-1/2">
    @if($icon)
    <div class="flex flex-col justify-center items-center  rounded-l-lg border-main-600 p-2 bg-gray-800 w-28 ">
        <i class="bx {{$icon}} text-main-400 text-6xl"></i>
    </div>
    @endif
    <div class="flex flex-col justify-center p-3">
        <h1 class="text-xl lg:text-3xl font-bold text-gray-200">{{$title}}</h1>
        @if($description)
            <p class="text-gray-400 text-md lg:text-xl">{{$description}}</p>
        @endif
    </div>
</div>
@endif
<div {{ $attributes->class('bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-700 p-6') }}>
    {{ $slot }}
</div>
