<div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64 min-h-56 flex flex-col gap-3">
    <div class="flex justify-start gap-4">
        <div style="background-image: url('{{$item->getMedia('logo')->first()?->getUrl()}}')" class="bg-cover bg-center w-16 h-16 rounded-lg">

        </div>
        <x-splade-link :href="route('apps.show', $item)" class="flex justify-center flex-col items-center">
            <div>
                <h1 class="font-bold">{{$item->name}}</h1>
                @if($item->account)
                    <x-splade-link class="text-zinc-400" href="{{url($item->account->username)}}">{{$item->account->name}}</x-splade-link>
                @endif
            </div>
        </x-splade-link>
    </div>
    <div>
        @if($item->is_free)
            <p>{{__('Free')}}</p>
        @else
            <p>{{__('Start From')}} <span class="font-bold">{{number_format($item->price-$item->discount, 2)}}</span><small>{{setting('local_currency')}}</small></p>
        @endif
    </div>
    <div>
        <p class="truncate ... text-zinc-300">{{ $item->description }}</p>
    </div>
    <div>
        @foreach($item->categories as $category)
            <x-splade-link :href="route('apps.index').'?category='.$category->id" class="bg-zinc-700 text-zinc-400 rounded-full px-2 py-1 text-xs">{{$category->name}}</x-splade-link>
        @endforeach
    </div>
</div>
