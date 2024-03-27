<div class="w-full bg-zinc-800 border border-zinc-700 rounded-lg shadow-sm mt-4  overflow-hidden">
    <div class="flex justify-between w-full border-b border-zinc-700 p-4">
        <div class="w-full flex justify-between gap-2">
            <div  class="w-full flex justify-start gap-2">
                @include('circle-xo::components.parts.avatar')
                @include('circle-xo::components.parts.title')
            </div>
            <div>
                @include('circle-xo::components.parts.icons')
            </div>
        </div>
    </div>
    @if($item->description)
        @if($item->type !== 'skill' && $item->type !== 'review')
            @include('circle-xo::components.parts.image')
        @endif
        <div class="flex justify-center border-b border-zinc-700">
            @include('circle-xo::components.parts.description')
        </div>
    @else
        <div class="flex justify-center border-b border-zinc-700">
            @include('circle-xo::components.parts.image')
        </div>
    @endif
    <div class="flex justify-between w-full">
        <div class="flex flex-col justify-center items-center mx-4 my-3">
            <div>
                @if(!auth('accounts')->user()->hasLiked($item))
                    <x-tomato-admin-tooltip :text="__('Like')">
                        <x-splade-link :href="route('home.posts.like', ['username' => $item->account->username, 'post' => $item])" method="POST" class="w-full">
                            <div class="flex justify-start gap-2">
                                <div class="bg-zinc-700 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                    <i class="bx bxs-like text-lg"></i>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <div>
                                        <p>{{ $item->likers()->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </x-splade-link>
                    </x-tomato-admin-tooltip>
                @else
                    <x-tomato-admin-tooltip :text="__('Dislike')">
                        <x-splade-link :href="route('home.posts.unlike', ['username' => $item->account->username, 'post' => $item])" method="POST" class="w-full flex justify-start gap-2">
                            <div class="flex justify-start gap-2">
                                <div class=" bg-primary-600 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                    <i class="bx bxs-like text-lg"></i>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <p>{{ $item->likers()->count() }}</p>
                                </div>
                            </div>
                        </x-splade-link>
                    </x-tomato-admin-tooltip>
                @endif
            </div>
        </div>
        <div class="flex flex-col justify-center items-center mx-4">
            @if($item->type == 'product' || $item->type === 'service')
                <p class="text-xl font-bold">{{ number_format($item->price-$item->discount, 2) }}<small>{{ $item->currency }}</small> @if($item->discount)<del class="text-sm text-danger-500">{{ number_format($item->price, 2) }}<small>{{ $item->currency }}</small></del>@endif</p>
            @endif
        </div>
    </div>
</div>
