@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Forget Password | '. setting('site_name'));
    SEO::openGraphTitle('Forget Password | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Forget Password | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Forget Password | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen  flex flex-col justify-center items-center mx-6 my-8 lg:my-16">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                    class="w-full lg:w-1/2"
                    :title="__('Forget Password')"
                    :description="__('please enter your email to reset your password')"
                    icon="bxs-lock-alt"
                >
                    <x-splade-form method="POST" :action="route('account.email')" class="flex flex-col gap-4 w-full">
                        <x-splade-input type="email" name="email" :label="__('Email')" />
                        <x-splade-submit spinner :label="__('Send Reset Email')" class="bg-main-600 border-main-400 text-gray-900" />
                    </x-splade-form>
                </x-circle-xo-card>
            </div>
        </div>
    </div>
</x-circle-xo-app-layout>
