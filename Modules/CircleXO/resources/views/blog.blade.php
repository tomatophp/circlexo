@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Blog | '. setting('site_name'));
    SEO::openGraphTitle('Blog | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Blog | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Blog | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))


<x-circle-xo-app-layout>
    <div class="min-h-screen bg-zinc-900 text-white">
        <div class="bg-zinc-800 border-b border-zinc-700">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-baseline justify-between p-4">
                <x-splade-link :href="route('home.blog')" class="text-4xl font-bold tracking-tight text-zinc-200">
                    {{__('Blog')}}
                </x-splade-link>

                <div class="flex justify-center items-center flex-col">
                    <x-splade-form method="GET" action="{{url()->current()}}" :default="['search' => request()->get('search') ?? '']">
                        <x-splade-input type="search" name="search" placeholder="{{__('Search ...')}}" />
                    </x-splade-form>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center w-full">
            <div class="w-full lg:w-1/2 xl:w-1/3">

                @if(!$posts->count())
                    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0  mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
                        <div class="p-8 md:p-16 text-center">
                            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                            <h1>{{__('Sorry There is not posts, please change search')}}</h1>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4 mx-8 md:mx-0 my-4">
                        @foreach($posts as $item)
                            <x-circle-xo-listing-card :item="$item" :link="url($item->account->username .'/posts/'.$item->id)"/>
                        @endforeach
                    </div>

                    <div class="mx-8 lg:mx-0 my-4">
                        {!! $posts->links('tomato-admin::components.pagination') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-circle-xo-app-layout>
