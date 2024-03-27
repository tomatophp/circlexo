@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Sponsoring '. $account->username .' | '. setting('site_name'));
    SEO::openGraphTitle('Sponsoring '. $account->username .' | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($account->avatar ?? setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Sponsoring '. $account->username .' | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage($account->avatar ?? setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Sponsoring '. $account->username .' | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-public-profile-layout :account="$account">
    <div class="flex items-center justify-center w-full">
        <div class="w-full lg:w-1/2">
            <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-16  my-4 rounded-lg shadow-sm">
                <div class="flex flex-col gap-4">
                    <div class="mx-4">
                        <x-tomato-markdown-viewer style="background-color: rgb(39 39 42 / var(--tw-bg-opacity)) !important;" :content="$account->meta('sponsoring_message')" />
                    </div>
                    <a class="mx-8 mb-6 bg-danger-600 hover:bg-danger-400 text-white border border-zinc-700 rounded-md shadow-md font-bold text-sm px-4 py-2" href="{{$account->meta('sponsoring_link')}}" target="_blank" >
                        <div class="flex justify-center gap-2">
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bxs-heart"></i>
                            </div>
                            <div>
                                {{ __('Buy me a Coffee') }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-circle-xo-public-profile-layout>
