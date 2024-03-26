<x-splade-modal>
    <x-slot:title>
        {{ __('Update Listing') . "#" . $listing->id }}
    </x-slot>
    <x-splade-form :default="$listing" class="flex flex-col gap-4"  method="POST" action="{{route('profile.listing.update', $listing)}}">
        <x-splade-select choices name="type" label="Type" required>
            <option value="link">{{__('Link')}}</option>
            <option value="skill">{{__('Skill')}}</option>
            <option value="review">{{__('Review')}}</option>
            <option value="portfolio">{{__('Portfolio')}}</option>
            <option value="post">{{__('Post')}}</option>
            <option value="product">{{__('Product')}}</option>
            <option value="service">{{__('Service')}}</option>
        </x-splade-select>
        <x-splade-file filepond preview name="image" label="Image"/>
        <x-splade-input name="title" label="Title" required/>
        <x-splade-textarea name="description" label="Description" />
        <div v-if="form.type === 'product' || form.type === 'service'" class="flex justify-between gap-2">
            <x-splade-input type="number" name="price" label="Price" class="w-full" required/>
            <x-splade-input type="number" name="discount" label="Discount" class="w-full" required/>
            <x-splade-select choices name="currency" :label="__('Currency')" class="w-full" >
                @foreach(\Modules\TomatoLocations\App\Models\Currency::all() as $currency)
                    <option value="{{$currency->symbol}}">{{$currency->name}}</option>
                @endforeach
            </x-splade-select>
        </div>
        <div v-if="form.type === 'post'">
            <x-tomato-markdown-editor name="body" label="Body" />
        </div>
        <div v-else-if="form.type === 'link' || form.type === 'portfolio' || form.type === 'product' || form.type === 'service'">
            <x-splade-input name="url" label="URL" />
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
