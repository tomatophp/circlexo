<card class="grid grid-cols-12 gap-4 bg-white border border-gray-300 rounded-lg overflow-hidden hover:border-gray-200 lg:h-60 ">
    <div class="col-span-12 lg:col-span-5 bg-center bg-cover w-full h-60 lg:h-full border-b lg:rtl:border-l lg:ltr:border-r" style="background-image: url('{{ $post->getFirstMediaUrl('feature') }}')">

    </div>
    <content class="col-span-12 lg:col-span-7 flex flex-col justify-between p-4">
        <div>
            <x-splade-link href="{{ url('blog/' . $post->slug) }}" class="text-lg font-bold w-full">{{ $post->title }}</x-splade-link>
            <div class="mt-2">
                <div class="text-sm">
                    <p class="text-gray-400">{{ \Str::limit($post->short_description, 150, $end='...') }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-between">
                <div class="text-xs text-gray-400">
                    {{ $post->created_at->diffForHumans() }}
                </div>
                @if(count($post->categories))
                    <div class="inline-flex items-center justify-center space-x-1 text-primary-700 bg-primary-500/10 min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-normal">
                        <x-splade-link
                            href="{{ url('blog?category_id=' . $post->categories[0]->id) }}">{{ $post->categories[0]->name }}</x-splade-link>
                    </div>
                @endif
            </div>
        </div>
    </content>
</card>
