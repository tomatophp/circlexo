@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Change Password | '. setting('site_name'));
    SEO::openGraphTitle('Change Password | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Change Password | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Change Password | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen  flex flex-col justify-center items-center mx-6 my-8 lg:my-16">
        <div class="justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                  class="w-full lg:w-1/2"
                  :title="__('Change Password')"
                  :description="__('please enter the new password to change it')"
                  icon="bxs-lock-alt"
                >
                    <x-splade-form method="POST" :action="route('account.password.update')" class="flex flex-col gap-4 w-full">

                        <x-splade-input name="otp_code" type="number" :label="__('OTP Code')" />
                        <x-splade-input name="password" :label="__('Password')" type="password" />
                        <x-splade-input name="password_confirmation" :label="__('Confirm Password')" type="password" />
                        <x-splade-submit spinner :label="__('Reset Password')" class="bg-main-600 border-main-400 text-gray-900" />
                        <p class="mt-4 text-sm text-gray-300 sm:mt-0">
                            {{__("Don't get the code?")}}
                            <x-splade-link method="POST" href="{{route('account.otp.resend')}}" class="text-gray-400 underline">{{__('Resend Email')}}</x-splade-link>.
                        </p>
                    </x-splade-form>



                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
