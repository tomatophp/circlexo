@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($post->title . ' | '. setting('site_name'));
    SEO::openGraphTitle($post->title . ' | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($post->getMedia('image')->first()?->getUrl() ?: setting('site_profile'));
    SEO::metaByProperty('og:description',$post->descriotion ?: setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($post->title . ' | '. setting('site_name'));
    SEO::twitterDescription($post->descriotion ?: setting('site_description'));
    SEO::twitterImage($post->getMedia('image')->first()?->getUrl() ?: setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($post->title . ' | '. setting('site_name'))
@seoDescription($post->descriotion ?: setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-public-profile-layout :account="$account">
    <div class="mx-8 text-center lg:mx-16">
        <h1 class="text-4xl">{{ $post->title }}</h1>
    </div>
    <div class="mt-8">
        <x-tomato-markdown-viewer :content="$post->body" />
    </div>
</x-circle-xo-public-profile-layout>
