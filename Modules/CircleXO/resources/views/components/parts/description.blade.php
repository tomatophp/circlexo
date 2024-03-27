<div class="flex flex-col justify-center w-full p-4" style="background-color: {{$item->color}}">
    <div class="text-white font-bold text-center text-sm">
        @if(str($item->description)->contains('%') && $item->type === 'skill')
            <div class="flex justify-center gap-2">
                <div class="flex flex-col justify-center text-lg">
                    <div class="flex justify-center items-center flex-col">
                        @if($item->getMedia('image')->first())
                            <img src="{{$item->getMedia('image')->first()?->getUrl()}}" alt="{{$item->name}}" class="w-32">
                        @else
                            <i class="{{ $item->icon }} text-5xl"></i>
                        @endif
                    </div>
                    <div class=" rounded-full h-2.5 bg-zinc-800  my-4 w-80 ">
                        <div class="bg-success-600 h-2.5 rounded-full" style="width: {{$item->description}}"></div>
                    </div>
                    <div class="flex justify-center items-center flex-col">
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        @elseif($item->type === 'game')
            <div class="flex justify-center gap-2">
                <div class="flex flex-col justify-center text-lg">
                    <div class="flex justify-center items-center flex-col my-2">
                        @if($item->getMedia('image')->first())
                            <img src="{{$item->getMedia('image')->first()?->getUrl()}}" alt="{{$item->name}}" class="w-32">
                        @else
                            <i class="{{ $item->icon }} text-5xl"></i>
                        @endif
                    </div>
                    <div class="flex justify-center items-center flex-col">
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        @elseif(str($item->description)->contains('#'))
            @php
                $tags = preg_match_all('/#(\w+)/', $item->description, $matches);
                $lastDescription = $item->description;
                foreach ($matches[0] as $match){
                    $lastDescription = str($lastDescription)->replace($match, "<Link class='text-main-600' href='".url($item->account->username . '?hashtag='.$match)."'>".$match."</Link>");
                }
            @endphp
            <p>{!! $lastDescription !!}</p>
        @else
            <p>{{ $item->description }}</p>
        @endif
    </div>
</div>

