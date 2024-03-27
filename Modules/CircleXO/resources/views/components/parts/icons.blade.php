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
            <img src="{{$item->getMedia('image')->first()?->getUrl()}}" class="w-8 h-8 bg-cover bg-center rounded-full">
        @else
            <i class="bx bxs-star text-4xl" style="color: orange"></i>
        @endif
    @endif
</div>
