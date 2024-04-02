@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Docs | '. setting('site_name'));
    SEO::openGraphTitle('Docs | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Docs | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Docs | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))


<x-circle-xo-app-layout>
    <div class="min-h-screen bg-zinc-900 text-white">
        <div class="bg-zinc-800 border-b border-zinc-700">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-baseline justify-between p-4">
                <x-splade-link :href="route('home.blog')" class="text-4xl font-bold tracking-tight text-zinc-200">
                    {{__('Docs')}}
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

                @if(!$docs->count())
                    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0  mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
                        <div class="p-8 md:p-16 text-center">
                            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                            <h1>{{__('Sorry There is not app, please change search')}}</h1>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
                        @foreach($docs as $item)
                            <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64">
                                <div class="flex flex-col items-center justify-center">
                                    @if($item->getMedia('icon')->first())
                                        <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700">
                                            <img src="{{$item->getMedia('icon')->first()->getUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                                        </div>
                                    @else
                                        <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700" >
                                            <div class="flex flex-col justify-center items-center text-center h-full">
                                                <i class="bx bxs-file-doc text-5xl text-zinc-500"></i>
                                            </div>
                                        </div>
                                    @endif
                                    <x-splade-link href="{{ route('docs.show', ['username' => $item->account->username, 'slug' => $item->package]) }}" class="flex justify-center gap-2 font-bold w-full">
                                        <h1 class="text-xl truncate">{{ $item->name }}</h1>
                                    </x-splade-link>
                                    <h6 class="text-sm text-zinc-300 my-2 text-center">
                                        #{{ $item->package }}
                                    </h6>
                                    <h6 class="text-sm text-zinc-300 my-2 text-center">
                                        {{ $item->about }}
                                    </h6>
                                    <h6 class="my-2 text-sm text-zinc-300">
                                        {{__('Created')}} {{ $item->created_at->diffForHumans() }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mx-8 lg:mx-0 my-4">
                        {!! $docs->links('tomato-admin::components.pagination') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-circle-xo-app-layout>
