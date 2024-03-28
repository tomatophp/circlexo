@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('App Store | '. setting('site_name'));
    SEO::openGraphTitle('App Store | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('App Store | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('App Store | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen bg-zinc-900 text-white">
        <div class="bg-zinc-800 border-b border-zinc-700">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-baseline justify-between p-4">
                <x-splade-link :href="route('apps.index')" class="text-4xl font-bold tracking-tight text-zinc-200">
                    {{__('App Store')}}
                </x-splade-link>

                <div class="flex justify-center items-center flex-col">
                    <x-splade-form method="GET" action="{{url()->current()}}" :default="['search' => request()->get('search') ?? '']">
                        <x-splade-input type="search" name="search" placeholder="{{__('Search ...')}}" />
                    </x-splade-form>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-center w-full">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                @if(!$apps->count())
                    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0  mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
                        <div class="p-8 md:p-16 text-center">
                            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                            <h1>{{__('Sorry There is not app, please change search')}}</h1>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="grid grid-cols-1 gap-4 mx-8 md:mx-0 my-4">
                            @foreach($apps as $item)
                                <x-circle-apps-app-card :item="$item" />
                            @endforeach
                        </div>

                        <div class="mx-8 lg:mx-0 my-4">
                            {!! $apps->links('tomato-admin::components.pagination') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-circle-xo-app-layout>
