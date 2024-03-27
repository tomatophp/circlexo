@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($post->title . ' | '. setting('site_name'));
    SEO::openGraphTitle($post->title . ' | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($post->getMedia('image')->first()?->getUrl() ?: setting('site_profile'));
    SEO::metaByProperty('og:description',$post->description ?: setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($post->title . ' | '. setting('site_name'));
    SEO::twitterDescription($post->description ?: setting('site_description'));
    SEO::twitterImage($post->getMedia('image')->first()?->getUrl() ?: setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($post->title . ' | '. setting('site_name'))
@seoDescription($post->description ?: setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-public-profile-layout :account="$account">
    <div class="flex items-center justify-center w-full">
        <div class="w-full lg:w-1/2">
            <div>
                <div class="mt-4 mx-8 lg:mx-16 flex justify-start gap-4 bg-zinc-900 rounded-lg border border-zinc-700">
                    @if($post->icon)
                        <div class="flex flex-col justify-center items-center rounded-l-lg border-main-600 p-6 bg-zinc-800">
                            <i class="bx {{$post->icon}} text-main-400 text-6xl"></i>
                        </div>
                    @endif
                    <div class="flex flex-col justify-center p-4">
                        <h1 class="text-xl lg:text-2xl font-bold text-zinc-200">{{$post->title}}</h1>
                        @if($post->description)
                            <p class="text-zinc-400 text-sm">{{$post->description}}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-8 mx-8 lg:mx-16">
                    <x-tomato-markdown-viewer style="background-color: rgb(39 39 42 / var(--tw-bg-opacity)) !important;" :content="$post->body" />
                </div>
                @if(auth('accounts')->user())
                    <div class="flex justify-between mx-8 lg:mx-16 border border-zinc-700 bg-zinc-900 shadow-sm rounded-lg my-4 px-6 py-4">
                        <div class="flex flex-col justify-center items-center">
                            @if(!auth('accounts')->user()->hasLiked($post))
                                <x-tomato-admin-tooltip :text="__('Like')">
                                    <x-splade-link :href="route('home.posts.like', ['username' => $account->username, 'post' => $post])" method="POST" class="w-full">
                                        <div class="flex justify-start gap-2">
                                            <div class="bg-zinc-700 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <div>
                                                    <p>{{ $post->likers()->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @else
                                <x-tomato-admin-tooltip :text="__('Dislike')">
                                    <x-splade-link :href="route('home.posts.unlike', ['username' => $account->username, 'post' => $post])" method="POST" class="w-full flex justify-start gap-2">
                                        <div class="flex justify-start gap-2">
                                            <div class=" bg-primary-600 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <p>{{ $post->likers()->count() }}</p>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @endif
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <x-circle-xo-share :title="$post->title" :description="$post->description" >
                                <x-tomato-admin-tooltip :text="__('Share')">
                        <span class="bg-success-600 flex flex-col justify-center items-center text-white rounded-md shadow-md font-bold text-sm p-3">
                            <i class="bx bxs-share text-lg text-white"></i>
                        </span>
                                </x-tomato-admin-tooltip>
                            </x-circle-xo-share>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-circle-xo-public-profile-layout>
