<x-splade-modal>
    <x-slot:title>
        {{ __('Update Listing') . "#" . $listing->id }}
    </x-slot>
    <x-splade-form :default="$listing->toArray()" class="flex flex-col gap-4"  method="POST" action="{{route('profile.listing.update', $listing)}}">
        <h1 class="font-bold text-lg text-center text-white">{{__('Select Listing Type')}}</h1>
        <div class="grid grid-cols-3 lg:grid-cols-5 gap-4">
            <x-circle-xo-listing-filter-item
                filter="link"
                icon="bx bx-link"
                label="{{__('Link')}}"
                color="#FF3D64"
            />
            <x-circle-xo-listing-filter-item
                filter="post"
                icon="bx bx-news"
                label="{{__('Posts')}}"
                color="#00E0B2"
            />
            <x-circle-xo-listing-filter-item
                filter="skill"
                icon="bx bxs-face-mask"
                label="{{__('Skills')}}"
                color="red"
            />
            <x-circle-xo-listing-filter-item
                filter="portfolio"
                icon="bx bx-image"
                label="{{__('Portfolios')}}"
                color="blue"
            />
            <x-circle-xo-listing-filter-item
                filter="review"
                icon="bx bxs-star"
                label="{{__('Reviews')}}"
                color="orange"
            />
            <x-circle-xo-listing-filter-item
                filter="service"
                icon="bx bxs-briefcase-alt-2"
                label="{{__('Services')}}"
                color="#F8CF00"
            />
            <x-circle-xo-listing-filter-item
                filter="product"
                icon="bx bxs-cart"
                label="{{__('Products')}}"
                color="green"
            />
            <x-circle-xo-listing-filter-item
                filter="game"
                icon="bx bxs-game"
                label="{{__('Game')}}"
                color="#008469"
            />
            <x-circle-xo-listing-filter-item
                filter="music"
                icon="bx bxs-music"
                label="{{__('Music')}}"
                color="#FF3D64"
            />
            <x-circle-xo-listing-filter-item
                filter="video"
                icon="bx bxs-video"
                label="{{__('Video')}}"
                color="#8A7407"
            />
        </div>
        <x-splade-file filepond preview name="image" :label="__('Image')"/>
        <x-splade-input name="title" :label="__('Title')" required/>
        <x-splade-textarea name="description" :label="__('Description')" />
        <div v-if="form.type === 'product' || form.type === 'service'" class="flex justify-between gap-2">
            <x-splade-input type="number" name="price" :label="__('Price')" class="w-full" required/>
            <x-splade-input type="number" name="discount" :label="__('Discount')" class="w-full" required/>
            <x-splade-select choices name="currency" :label="__('Currency')" class="w-full" >
                @foreach(\Modules\TomatoLocations\App\Models\Currency::all() as $currency)
                    <option value="{{$currency->symbol}}">{{$currency->name}}</option>
                @endforeach
            </x-splade-select>
        </div>
        <div v-if="form.type === 'post'">
            <x-tomato-markdown-editor name="body" :label="__('Body')" />
        </div>
        <div v-if="form.type === 'game' || form.type === 'music' || form.type === 'video' ||  form.type === 'link' || form.type === 'portfolio' || form.type === 'product' || form.type === 'service'">
            <x-splade-input name="url" :label="__('URL')" />
        </div>

        <div class="flex justify-between gap-2">
            <div class="w-full">
                <x-tomato-admin-icon name="icon" :label="__('Icon')" />
            </div>
            <div>
                <x-tomato-admin-color name="color" :label="__('Color')" />
            </div>
        </div>

        <x-splade-checkbox name="is_active" label="Active" />


        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit spinner :label="__('Update')" class="bg-main-600 border-main-400 text-zinc-900" />
            <x-tomato-admin-button danger confirm-danger method="DELETE" :href="route('profile.listing.destroy', $listing)" :label="__('Delete Listing')" />
        </div>
    </x-splade-form>
</x-splade-modal>
