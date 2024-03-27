@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($page->title . ' | ' . setting('site_name'));
    SEO::openGraphTitle($page->title . ' | ' . setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($page->getFirstMediaUrl('cover') ?: setting('site_profile'));
    SEO::metaByProperty('og:description', $page->short_description ?: setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($page->title . ' | ' . setting('site_name'));
    SEO::twitterDescription($page->short_description ?: setting('site_description'));
    SEO::twitterImage($page->getFirstMediaUrl('cover') ?: setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($page->title . ' | ' . setting('site_name'))
@seoDescription($page->short_description ?: setting('site_description'))
@seoKeywords($page->keywords ?: setting('site_keywords'))
<x-circle-xo-app-layout>
    <section class="py-16">
        <div class="container max-w-screen-xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="text-center max-w-2xl mx-auto relative">
                <span class="uppercase text-main-600 text-base font-bold mb-5">Page</span>
                <h1 class="font-bold text-4xl leading-tight mb-2">{{ $page->title }}</h1>
            </div>
            <div class="relative overflow-hidden rounded-md bg-zinc-800 shadow shadow-zinc-800 mt-6">
                @if ($page->getFirstMediaUrl('cover'))
                    <img src="{{ $page->getFirstMediaUrl('cover') }}" alt="{{ $page->title }}" loading="lazy">
                @endif
                <div>
                    <x-tomato-markdown-viewer :content="$page->body" />
                </div>
            </div>
        </div>
    </section>
</x-circle-xo-app-layout>
