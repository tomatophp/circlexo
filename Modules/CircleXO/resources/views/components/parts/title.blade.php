@if($edit)
    <x-splade-link  modal :href="route('profile.listing.edit', $item)" class="flex flex-col justify-center">
        <div class="flex justify-start gap-2">
            <div class="flex flex-col justify-center items-center">
                <i class="bx bx-edit text-main-600"></i>
            </div>
            <div>
                <h1 class="font-bold text-md">
                    {{ $item->title }}
                </h1>
            </div>
        </div>
    </x-splade-link>
@else
    @if($item->type === 'post')
        <x-splade-link href="{{ route('home.posts', ['username'=>$item->account->username, 'post' => $item]) }}" class="flex flex-col justify-center">
            <h1 class="font-bold text-md">{{ $item->title }}</h1>
        </x-splade-link>
    @elseif($item->url)
        <a href="{{ $item->url }}" target="_blank" class="flex flex-col justify-center">
            <div class="flex justify-start gap-2">
                <div>
                    <h1 class="font-bold text-md">{{ $item->title }}</h1>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <i class="bx bx-link-external text-main-600"></i>
                </div>
            </div>
        </a>
    @else
        <div class="flex flex-col justify-center">
            <h1 class="font-bold text-md">{{ $item->title }}</h1>
        </div>
    @endif
@endif
