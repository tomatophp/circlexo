@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($account->username . ' | '. setting('site_name'));
    SEO::openGraphTitle($account->username . ' | '.  setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($account->avatar ?: setting('site_profile'));
    SEO::metaByProperty('og:description',$account->bio ?: setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($account->username . ' | '. setting('site_name'));
    SEO::twitterDescription($account->bio ?: setting('site_description'));
    SEO::twitterImage($account->avatar ?: setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($account->username . ' | '. setting('site_name'))
@seoDescription($account->bio ?: setting('site_description'))
@seoKeywords(setting('site_keywords'))
<x-circle-xo-public-profile-layout :account="$account">
    <div class="my-4">
        <x-circle-xo-listing-filters link />
        @if(!$listing->count())
            <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-16  mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
                <div class="p-8 md:p-16 text-center">
                    <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                    <h1>{{__('This Profile is empty!')}}</h1>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-8 md:mx-16 my-4">
                @foreach($listing as $item)
                    @if($item->type === 'post')
                        <x-circle-xo-listing-card :item="$item" :link="url($account->username .'/posts/'.$item->id)"/>
                    @else
                        <x-circle-xo-listing-card :item="$item" />
                    @endif
                @endforeach
            </div>

            <div class="mx-16 my-4">
                {!! $listing->links('tomato-admin::components.pagination') !!}
            </div>
        @endif
    </div>
</x-circle-xo-public-profile-layout>
