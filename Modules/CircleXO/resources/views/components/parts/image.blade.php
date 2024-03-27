@if($item->getMedia('image')->first())
    <div class="flex justify-center border-b border-zinc-700 w-full">
        <div style="background-image: url('{{$item->getMedia('image')->first()?->getUrl()}}')" class="w-full h-80 min-h-32 min-w-80 bg-cover bg-center ">

        </div>
    </div>
@elseif($item->icon)
    <div class="flex justify-center border-b border-zinc-700 w-full">
        <div style="color: {{ $item->color }} !important;" class="w-full h-32 min-h-32 min-w-32 bg-zinc-700 flex flex-col items-center justify-center">
            <div class="flex flex-col justify-center items-center gap-2">
                <i class="{{ $item->icon }} text-4xl"></i>
            </div>
        </div>
    </div>
@endif
