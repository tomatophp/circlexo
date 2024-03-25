@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName('Register | '. setting('site_name'));
    SEO::openGraphTitle('Register | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage(setting('site_profile'));
    SEO::metaByProperty('og:description',setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle('Register | '. setting('site_name'));
    SEO::twitterDescription(setting('site_description'));
    SEO::twitterImage(setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle('Register | '. setting('site_name'))
@seoDescription(setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen  flex flex-col justify-center items-center mx-6 my-8 lg:my-16">
        <div class="w-full justify-between flex">
            <div class="flex flex-col justify-center items-center w-full">
                <x-circle-xo-card
                  class="w-full lg:w-1/2"
                  :title="__('Create New Profile')"
                  :description="__('please fill this form the create a new profile')"
                  icon="bxs-user-plus"
                >
                    <x-splade-form method="POST" :action="route('account.register.store')" class="flex flex-col gap-4 w-full">
                        <x-splade-input name="name" :label="__('Name')" />
                        <x-splade-input name="username" :label="__('Username')">
                            <x-slot:prepend>
                                <span>@</span>
                            </x-slot:prepend>
                        </x-splade-input>
                        <x-splade-input name="email" :label="__('Email')" />
                        <x-splade-input name="password" :label="__('Password')" type="password" />
                        <x-splade-input name="password_confirmation" :label="__('Confirm Password')" type="password" />
                        <x-splade-submit spinner :label="__('Register')" class="bg-main-600 border-main-400 text-gray-900" />
                        <div class="my-4 text-sm text-gray-300 sm:mt-0">
                            {{__('Already have an account?')}}
                            <x-splade-link href="{{route('account.login')}}" class="text-gray-400 underline">{{__('Log in')}}</x-splade-link>.
                        </div>
                    </x-splade-form>



                </x-circle-xo-card>
            </div>
        </div>

    </div>
</x-circle-xo-app-layout>
