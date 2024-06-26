<section class="py-16">
    <div class="container max-w-screen-xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="text-center max-w-2xl mx-auto relative">
            <span class="uppercase text-main-600 text-base font-bold mb-5">Listing</span>
            <h1 class="font-bold text-4xl leading-tight mb-2">Feature Highlights</h1>
        </div>

        <div class="flex items-center justify-center w-full">
            <div class="w-full lg:w-1/2">
                @php
                    $listing = \Modules\CircleXO\App\Models\AccountListing::where('is_active', true)->inRandomOrder()->take(3)->get();
                @endphp
                @foreach($listing as $item)
                    @if($item->type === 'post')
                        <x-circle-xo-listing-card :item="$item" :link="url($item->account->username .'/posts/'.$item->id)"/>
                    @else
                        <x-circle-xo-listing-card :item="$item" />
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</section>
