@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('OTP | '. setting('site_name'));
    SEO::openGraphTitle('OTP | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('OTP | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('OTP | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen  flex flex-col justify-center items-center mx-6 my-8 lg:my-16">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                    class="w-full lg:w-1/2"
                    :title="__('Verify Your Account')"
                    :description="__('please input the code sent to your email')"
                    icon="bxs-check-circle"
                >
                    <x-splade-form method="POST" :action="route('account.otp.check')" class="flex flex-col gap-4 w-full">
                        <x-splade-input type="number" name="otp_code" :label="__('OTP Code')" />
                        <x-splade-submit spinner :label="__('Verify')" class="bg-main-600 border-main-400 text-zinc-900" />
                        <p class="mt-4 text-sm text-zinc-300 sm:mt-0">
                            {{__("Don't get the code?")}}
                            <x-splade-link method="POST" href="{{route('account.otp.resend')}}" class="text-zinc-400 underline">{{__('Resend Email')}}</x-splade-link>.
                        </p>
                    </x-splade-form>
                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
