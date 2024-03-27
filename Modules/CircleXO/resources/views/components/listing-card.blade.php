@if($edit)
<x-splade-link modal :href="route('profile.listing.edit', $item)" class="w-full bg-zinc-800 border border-zinc-700 overflow-hidden rounded-lg shadow-sm">
    <div class=" flex justify-center border-b border-zinc-700">
        @if($item->type === 'review')
            <div class="w-full h-64 bg-zinc-800" style="background-color: {{ $item->color }}">
                <i class="bx bxs-quote-single-left text-6xl text-zinc-700 mt-4"></i>
                <div class="p-4 font-bold text-center flex flex-col items-center justify-center ">
                    {{ $item->description }}
                </div>
            </div>
        @elseif($item->getMedia('image')->first())
            <div style="background-image: url('{{$item->getMedia('image')->first()?->getUrl()}}')" class="w-full h-64 bg-zinc-800 bg-cover bg-center ">

            </div>
        @else
            <div style="background-color: {{ $item->color }}" class="w-full h-64 bg-zinc-800 flex flex-col items-center justify-center ">
                <i class="{{ $item->icon }} text-6xl"></i>
            </div>
        @endif
    </div>
    <div class="px-4 py-2 h-16 flex justify-start gap-2">
        <div class="flex flex-col justify-center items-center">
            @if($item->type === 'link')
                <i class="bx bx-link text-4xl" style="color: #FF3D64"></i>
            @elseif($item->type === 'post')
                <i class="bx bx-news text-4xl" style="color: #00E0B2"></i>
            @elseif($item->type === 'service')
                <i class="bx bxs-briefcase-alt-2 text-4xl" style="color: #F8CF00"></i>
            @elseif($item->type === 'product')
                <i class="bx bxs-cart text-4xl"  style="color: green"></i>
            @elseif($item->type === 'skill')
                <i class="bx bxs-face-mask text-4xl" style="color: red"></i>
            @elseif($item->type === 'game')
                <i class="bx bxs-game text-4xl" style="color: #008469"></i>
            @elseif($item->type === 'video')
                <i class="bx bxs-video text-4xl" style="color: #8A7407"></i>
            @elseif($item->type === 'music')
                <i class="bx bxs-music text-4xl" style="color: #FF3D64"></i>
            @elseif($item->type === 'portfolio')
                <i class="bx bx-image text-4xl" style="color: blue"></i>
            @elseif($item->type === 'review')
                @if($item->getMedia('image')->first())
                    <img src="{{$item->getMedia('image')->first()?->getUrl()}}" class="w-12 h-12 bg-cover bg-center rounded-full">
                @else
                    <i class="bx bxs-star text-4xl" style="color: orange"></i>
                @endif
            @endif
        </div>
        <div class="flex flex-col justify-center">
            <h1 class="font-bold text-xl truncate ... w-full">{{ $item->title }}</h1>
            @if($item->description && $item->type !== 'review' && $item->type !== 'product' && $item->type !== 'service')
                <p class="text-zinc-400 text-sm truncate ... w-80">{{ $item->description }}</p>
            @elseif($item->type == 'product' || $item->type === 'service')
                <p class="text-zinc-400 text-sm truncate ... w-80">{{ number_format($item->price-$item->discount, 2) }}<small>{{ $item->currency }}</small> @if($item->discount)<del class="text-sm text-danger-500">{{ number_format($item->price, 2) }}<small>{{ $item->currency }}</small></del>@endif</p>
            @endif
        </div>
    </div>
</x-splade-link>
@elseif($item->type === 'post' && $link)
    <x-splade-link href="{{ $link }}" modal class="w-full bg-zinc-800 border border-zinc-700 overflow-hidden rounded-lg shadow-sm">
        <div class=" flex justify-center border-b border-zinc-700">
            @if($item->type === 'review')
                <div class="w-full h-64 bg-zinc-800" style="background-color: {{ $item->color }}">
                    <i class="bx bxs-quote-single-left text-6xl text-zinc-700 mt-4"></i>
                    <div class="p-4 font-bold text-center flex flex-col items-center justify-center ">
                        {{ $item->description }}
                    </div>
                    <div class="flex justify-end mb-4">
                        <i class="bx bxs-quote-single-right text-6xl text-zinc-700"></i>
                    </div>
                </div>
            @elseif($item->getMedia('image')->first())
                <div style="background-image: url('{{$item->getMedia('image')->first()?->getUrl()}}')" class="w-full h-64 bg-zinc-800 bg-cover bg-center ">

                </div>
            @else
                <div style="background-color: {{ $item->color }}" class="w-full h-64 bg-zinc-800 flex flex-col items-center justify-center ">
                    <i class="{{ $item->icon }} text-6xl"></i>
                </div>
            @endif
        </div>
        <div class="px-4 py-2 h-16 flex justify-start gap-2">
            <div class="flex flex-col justify-center items-center">
                @if($item->type === 'link')
                    <i class="bx bx-link text-4xl text-amber-500"></i>
                @elseif($item->type === 'post')
                    <i class="bx bx-news text-4xl text-purple-500"></i>
                @elseif($item->type === 'service')
                    <i class="bx bxs-briefcase-alt-2 text-4xl text-pink-500"></i>
                @elseif($item->type === 'product')
                    <i class="bx bxs-cart text-4xl text-green-500"></i>
                @elseif($item->type === 'skill')
                    <i class="bx bxs-face-mask text-4xl text-red-500"></i>
                @elseif($item->type === 'portfolio')
                    <i class="bx bx-image text-4xl text-blue-400"></i>
                @elseif($item->type === 'review')
                    @if($item->getMedia('image')->first())
                        <img src="{{$item->getMedia('image')->first()?->getUrl()}}" class="w-12 h-12 bg-cover bg-center rounded-full">
                    @else
                        <i class="bx bxs-star text-4xl text-orange-400"></i>
                    @endif
                @endif
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="font-bold text-xl truncate ... w-full">{{ $item->title }}</h1>
                @if($item->description && $item->type !== 'review' && $item->type !== 'product' && $item->type !== 'service')
                    <p class="text-zinc-400 text-sm truncate ... w-80">{{ $item->description }}</p>
                @elseif($item->type == 'product' || $item->type === 'service')
                    <p class="text-zinc-400 text-sm truncate ... w-80">{{ number_format($item->price-$item->discount, 2) }}<small>{{ $item->currency }}</small> @if($item->discount)<del class="text-sm text-danger-500">{{ number_format($item->price, 2) }}<small>{{ $item->currency }}</small></del>@endif</p>
                @endif
            </div>
        </div>
    </x-splade-link>
@else
<a href="{{ $item->url ?? '#' }}" @if($item->url) target="_blank" @endif class="w-full bg-zinc-800 border border-zinc-700 overflow-hidden rounded-lg shadow-sm">
    <div class=" flex justify-center border-b border-zinc-700">
        @if($item->type === 'review')
            <div class="w-full h-64 bg-zinc-800" style="background-color: {{ $item->color }}">
                <div>
                    <i class="bx bxs-quote-single-left text-6xl text-zinc-700"></i>
                </div>
                <div class="p-4 font-bold text-center flex flex-col items-center justify-center">
                    {{ $item->description }}
                </div>
            </div>
        @elseif($item->getMedia('image')->first())
            <div style="background-image: url('{{$item->getMedia('image')->first()?->getUrl()}}')" class="w-full h-64 bg-zinc-800 bg-cover bg-center ">

            </div>
        @else
            <div style="background-color: {{ $item->color }}" class="w-full h-64 bg-zinc-800 flex flex-col items-center justify-center ">
                <i class="{{ $item->icon }} text-6xl"></i>
            </div>
        @endif
    </div>
    <div class="px-4 py-2 h-16 flex justify-start gap-2">
        <div class="flex flex-col justify-center items-center">
            @if($item->type === 'link')
                <i class="bx bx-link text-4xl" style="color: #FF3D64"></i>
            @elseif($item->type === 'post')
                <i class="bx bx-news text-4xl" style="color: #00E0B2"></i>
            @elseif($item->type === 'service')
                <i class="bx bxs-briefcase-alt-2 text-4xl" style="color: #F8CF00"></i>
            @elseif($item->type === 'product')
                <i class="bx bxs-cart text-4xl"  style="color: green"></i>
            @elseif($item->type === 'skill')
                <i class="bx bxs-face-mask text-4xl" style="color: red"></i>
            @elseif($item->type === 'game')
                <i class="bx bxs-game text-4xl" style="color: #008469"></i>
            @elseif($item->type === 'video')
                <i class="bx bxs-video text-4xl" style="color: #8A7407"></i>
            @elseif($item->type === 'music')
                <i class="bx bxs-music text-4xl" style="color: #FF3D64"></i>
            @elseif($item->type === 'portfolio')
                <i class="bx bx-image text-4xl" style="color: blue"></i>
            @elseif($item->type === 'review')
                @if($item->getMedia('image')->first())
                    <img src="{{$item->getMedia('image')->first()?->getUrl()}}" class="w-12 h-12 bg-cover bg-center rounded-full">
                @else
                    <i class="bx bxs-star text-4xl" style="color: orange"></i>
                @endif
            @endif
        </div>
        <div class="flex flex-col justify-center">
            <h1 class="font-bold text-xl truncate ... w-full">{{ $item->title }}</h1>
            @if($item->description && $item->type !== 'review' && $item->type !== 'product' && $item->type !== 'service')
                <p class="text-zinc-400 text-sm truncate ... w-80">{{ $item->description }}</p>
            @elseif($item->type == 'product' || $item->type === 'service')
                <p class="text-zinc-400 text-sm truncate ... w-80">{{ number_format($item->price-$item->discount, 2) }}<small>{{ $item->currency }}</small> @if($item->discount)<del class="text-sm text-danger-500">{{ number_format($item->price, 2) }}<small>{{ $item->currency }}</small></del>@endif</p>
            @endif
        </div>
    </div>
</a>
@endif
