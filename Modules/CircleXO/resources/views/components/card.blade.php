@if($title)
<div class="mb-8 flex justify-start gap-4 bg-zinc-900 rounded-lg border border-zinc-700 h-28 w-full lg:w-1/2">
    @if($icon)
    <div class="flex flex-col justify-center items-center  rounded-l-lg border-main-600 p-2 bg-zinc-800 w-28 ">
        <i class="bx {{$icon}} text-main-400 text-6xl"></i>
    </div>
    @endif
    <div class="flex flex-col justify-center p-3">
        <h1 class="text-xl lg:text-3xl font-bold text-zinc-200">{{$title}}</h1>
        @if($description)
            <p class="text-zinc-400 text-md lg:text-xl">{{$description}}</p>
        @endif
    </div>
</div>
@endif
<div {{ $attributes->class('bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-6') }}>
    {{ $slot }}
</div>
