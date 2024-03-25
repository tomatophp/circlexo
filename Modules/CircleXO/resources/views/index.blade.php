@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName(setting('site_name'));
    SEO::openGraphTitle(setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description', setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle(setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle(setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))
<x-circle-xo-app-layout>
    <x-circle-xo-hero />
</x-circle-xo-app-layout>
