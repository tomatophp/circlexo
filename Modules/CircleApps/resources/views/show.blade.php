@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName($app->name . ' | '. setting('site_name'));
    SEO::openGraphTitle($app->name . ' | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage($app->getMedia('logo')->first()?->getUrl() ?? setting('site_profile'));
    SEO::metaByProperty('og:description',$app->description ?? setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle($app->name . ' | '. setting('site_name'));
    SEO::twitterDescription($app->description ?? setting('site_description'));
    SEO::twitterImage($app->getMedia('logo')->first()?->getUrl() ??  setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle($app->name . ' | '. setting('site_name'))
@seoDescription($app->description ?? setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-app-layout>
    <div class="min-h-screen bg-zinc-900 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 my-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 rounded-lg overflow-hidden shadow-md min-w-64  w-full">
                <div class="col-span-12 lg:col-span-9">
                    <div class="flex justify-start gap-4">
                        <div style="background-image: url('{{$app->getMedia('logo')->first()?->getUrl()}}')" class="bg-cover border border-zinc-700  bg-center w-24 h-24 rounded-lg">

                        </div>
                        <div class="flex justify-center flex-col items-center">
                            <div>
                                <h1 class="font-bold text-2xl">{{$app->name}}</h1>
                                @if($app->account)
                                    <x-splade-link class="text-zinc-400 text-xl" href="{{url($app->account->username)}}">{{$app->account->name}}</x-splade-link>
                                @endif
                                <div class="my-2">
                                    @foreach($app->categories as $category)
                                        <x-splade-link :href="route('apps.index').'?category='.$category->id" class="bg-zinc-700 text-zinc-400 rounded-full px-2 py-1 text-xs">{{$category->name}}</x-splade-link>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center lg:justify-end col-span-12 lg:col-span-3">
                    <div class="flex flex-col justify-center items-center gap-4">
                        @if(auth('accounts')->user())
                            @if(!has_app($app->key))
                                <x-splade-link href="{{ route('apps.install', $app) }}"  method="POST" class="w-72 text-center bg-main-600 hover:bg-main-400 text-zinc-700 border border-zinc-700 rounded-md shadow-md font-bold text-md px-6 py-4">
                                    {{__('Install App')}}
                                </x-splade-link>
                            @else
                                <x-splade-link href="{{ route('apps.uninstall', $app) }}" confirm-danger method="POST" class="w-72 text-center bg-danger-600 hover:bg-danger-400 text-white border border-zinc-700 rounded-md shadow-md font-bold text-md px-6 py-4">
                                    {{__('Uninstall App')}}
                                </x-splade-link>
                            @endif
                        @else
                            <x-splade-link href="{{ route('account.register') }}" class="w-72 text-center bg-main-600 hover:bg-main-400 text-zinc-700 border border-zinc-700 rounded-md shadow-md font-bold text-md px-6 py-4">
                                {{__('Install App')}}
                            </x-splade-link>
                       @endif
                        <div>
                            @if($app->is_free)
                                <p>{{__('Free')}}</p>
                            @else
                                <p>{{__('Start From')}} <span class="font-bold">{{number_format($app->price-$app->discount, 2)}}</span><small>{{setting('local_currency')}}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-4 my-4">
                <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 col-span-1 lg:col-span-9">
                    <div style="background-image: url('{{$app->getMedia('cover')->first()?->getUrl()}}')" class="bg-cover bg-center w-full h-80 rounded-lg">

                    </div>

                    @if($app->readme)
                        <x-tomato-markdown-viewer :content="$app->readme" />
                    @endif
                </div>
                <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-6 col-span-1 lg:col-span-3 flex flex-col gap-2 justify-start">
                    @if($app->homepage)
                       <div>
                           <h1>{{__('Website')}}</h1>
                           <div class="flex flex-col gap-4 my-4">
                               <div>
                                   <div class="flex justify-start gap-2">
                                       <div class="flex flex-col justify-center items-center">
                                           <i class="bx bxs-home"></i>
                                       </div>
                                       <div>
                                           <a href="{{ $app->homepage }}" target="_blank" class="text-zinc-400 underline">{{__('Homepage')}}</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    @endif
                    <div>
                        <h1>{{__('Links')}}</h1>
                        <div class="flex flex-col gap-2 my-4">
                            @if($app->github)
                                <div>
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col justify-center items-center">
                                            <i class="bx bxl-github"></i>
                                        </div>
                                        <div>
                                            <a href="{{ $app->github }}" target="_blank" class="text-zinc-400 underline">{{__('GitHub')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($app->email)
                                <div>
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col justify-center items-center">
                                            <i class="bx bxs-envelope"></i>
                                        </div>
                                        <div>
                                            <a href="mailto:{{ $app->email }}" target="_blank" class="text-zinc-400 underline">{{$app->email}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($app->docs)
                                <div>
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col justify-center items-center">
                                            <i class="bx bx-spreadsheet"></i>
                                        </div>
                                        <div>
                                            <a href="{{ $app->docs }}" target="_blank" class="text-zinc-400 underline">{{__('Documentation')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($app->privacy)
                                <div>
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col justify-center items-center">
                                            <i class="bx bxs-lock-alt"></i>
                                        </div>
                                        <div>
                                            <a href="{{ $app->privacy }}" target="_blank" class="text-zinc-400 underline">{{__('Privacy')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($app->faq)
                                <div>
                                    <div class="flex justify-start gap-2">
                                        <div class="flex flex-col justify-center items-center">
                                            <i class="bx bx-question-mark"></i>
                                        </div>
                                        <div>
                                            <a href="{{ $app->faq }}" target="_blank" class="text-zinc-400 underline">{{__('FAQ')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-circle-xo-app-layout>
