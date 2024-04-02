@php
    SEO::openGraphType('WebPage');
    SEO::openGraphSiteName(setting('site_name'));
    SEO::openGraphTitle((isset($currentPage) ? $doc->name . ' | ' . $currentPage->title : $doc->name) .' | '. setting('site_name'));
    SEO::openGraphUrl(url()->current());
    SEO::openGraphImage((isset($currentPage) ? $currentPage->getMedia('cover')->first()?->getUrl() : $doc->getMedia('cover')->first()?->getUrl()) ?: setting('site_profile'));
    SEO::metaByProperty('og:description',(isset($currentPage) ? $currentPage->description : $doc->description) ?: setting('site_description'));

    SEO::twitterCard('summary_large_image');
    SEO::twitterTitle((isset($currentPage) ? $doc->name . ' | ' . $currentPage->title : $doc->name) .' | '. setting('site_name'));
    SEO::twitterDescription((isset($currentPage) ? $currentPage->description : $doc->description) ?: setting('site_description'));
    SEO::twitterImage((isset($currentPage) ? $currentPage->getMedia('cover')->first()?->getUrl() : $doc->getMedia('cover')->first()?->getUrl()) ?: setting('site_profile'));

    SEO::canonical(url()->current());
@endphp
@seoTitle((isset($currentPage) ? $doc->name . ' | ' . $currentPage->title : $doc->name) .' | '. setting('site_name'))
@seoDescription((isset($currentPage) ? $currentPage->description : $doc->description) ?: setting('site_description'))
@seoKeywords(setting('site_keywords'))

<x-circle-xo-public-profile-layout :account="$account">
    <div class="w-full py-4 px-8 mt-4 border-b border-zinc-700">
        <div class="flex justify-between">
            <div class="w-full">
                <div class=" flex justify-start gap-4">
                    <div class="flex flex-col justify-center items-center  hidden lg:block">
                        @if($doc->getMedia('icon')->first())
                            <img src="{{$doc->getMedia('icon')->first()->getUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
                        @else
                            <i class="bx bxs-file-doc"></i>
                        @endif
                    </div>
                    <div class="lg:hidden flex flex-col justify-center items-center">
                        <Link href="#doc-menu" class="mt-1">
                            <i class="bx bx-menu text-2xl"></i>
                        </Link>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{$doc->name}}</h1>
                    </div>
                </div>
            </div>
            <div class="justify-end w-full flex">
                <div class="flex justify-center items-center flex-col">
                    <Link href="#search-docs" class="py-2 px-4 bg-zinc-800 rounded-lg">
                        <div class="flex justify-start gap-2">
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bx-search"></i>
                            </div>
                            <div>
                                {{__('Search On Docs')}}
                            </div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12">
        <div class="hidden lg:block lg:col-span-3 overflow-auto h-screen border-r border-zinc-700 p-4 scrollbar">
            <div class="flex flex-col justify-center items-center w-full gap-1">
                <x-splade-link  preserve-scroll :href="route('docs.show', ['username' => $account->username, 'slug'=>$doc->package])" class="rounded-lg  hover:bg-zinc-800 p-3 w-full">
                    <div class=" flex justify-start gap-4 @if(url()->current() === route('docs.show', ['username' => $account->username, 'slug'=>$doc->package])) text-main-600 @endif" >
                        <div class="flex flex-col justify-center items-center">
                            <i class="bx bxs-home text-md"></i>
                        </div>
                        <div>
                            <h1 class="text-md font-bold">{{ __('Overview') }}</h1>
                        </div>
                    </div>
                </x-splade-link>

                @php
                    $groups = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('doc_id', $doc->id)->groupBy('group')->get();
                @endphp

                @foreach($groups as $group)
                    @php
                        $menu = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('group', $group->group);
                        if(request()->get('search')){
                            $menu = $menu->where('title', 'like', '%'.request()->get('search').'%');
                        }

                        $menu->where('doc_id', $doc->id);
                        $menu = $menu->get();
                    @endphp
                    @if($group->group && !request()->has('search'))
                        <div class="flex justify-start w-full mt-6 mb-2 px-3">
                            <h1 class="text-sm font-bold uppercase">{{ $group->group }}</h1>
                        </div>
                    @endif
                    @foreach($menu as $page)
                        <x-splade-link preserve-scroll :href="route('docs.page', ['username' => $account->username, 'slug'=>$doc->package, 'page'=> $page->slug])" class="rounded-lg hover:bg-zinc-800 p-3 w-full">
                            <div class=" flex justify-start gap-4 @if(url()->current() === route('docs.page', ['username' => $account->username, 'slug'=>$doc->package, 'page'=> $page->slug])) text-main-600 @endif" >
                                <div class="flex flex-col justify-center items-center">
                                    <i class="{{$page->icon ?? 'bx bxs-file-doc'}} text-md"></i>
                                </div>
                                <div>
                                    <h1 class="text-md font-bold">{{ $page->title }}</h1>
                                </div>
                            </div>
                        </x-splade-link>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="col-span-12 lg:col-span-9 bg-zinc-800">
            @if(isset($currentPage))
                @if($currentPage->getMedia('cover')->first())
                    <div>
                        <img src="{{$currentPage->getMedia('cover')->first()->getUrl() }}" class="w-full h-80 object-cover object-center border-b border-zinc-700" alt="cover">
                    </div>
                @endif
                <x-tomato-markdown-viewer :content="$currentPage->body" />
            @else
                <x-tomato-markdown-viewer :content="$doc->readme" />
            @endif

            @if(auth('accounts')->user())
                <div class="flex justify-between mx-4  border border-zinc-700 bg-zinc-900 shadow-sm rounded-lg my-4 px-6 py-4">
                    <div class="flex flex-col justify-center items-center">
                        @if(isset($currentPage))
                            @if(!auth('accounts')->user()->hasLiked($currentPage))
                                <x-tomato-admin-tooltip  :text="__('Like')">
                                    <x-splade-link preserve-scroll :href="route('profile.docs.like')" :data="['id' => $currentPage->id, 'type'=>'page']" method="POST" class="w-full">
                                        <div class="flex justify-start gap-2">
                                            <div class="bg-zinc-700 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <div>
                                                    <p>{{ $currentPage->likers()->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @else
                                <x-tomato-admin-tooltip :text="__('Dislike')">
                                    <x-splade-link preserve-scroll :href="route('profile.docs.like')" :data="['id' => $currentPage->id, 'type'=>'page']" method="POST" class="w-full flex justify-start gap-2">
                                        <div class="flex justify-start gap-2">
                                            <div class=" bg-primary-600 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <p>{{ $currentPage->likers()->count() }}</p>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @endif
                        @else
                            @if(!auth('accounts')->user()->hasLiked($doc))
                                <x-tomato-admin-tooltip :text="__('Like')">
                                    <x-splade-link preserve-scroll :href="route('profile.docs.like')" :data="['id' => $doc->id, 'type'=>'doc']" method="POST" class="w-full">
                                        <div class="flex justify-start gap-2">
                                            <div class="bg-zinc-700 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <div>
                                                    <p>{{ $doc->likers()->count() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @else
                                <x-tomato-admin-tooltip :text="__('Dislike')">
                                    <x-splade-link preserve-scroll :href="route('profile.docs.like')" :data="['id' => $doc->id, 'type'=>'doc']" method="POST" class="w-full flex justify-start gap-2">
                                        <div class="flex justify-start gap-2">
                                            <div class=" bg-primary-600 p-3 rounded-lg text-white flex flex-col justify-center items-center">
                                                <i class="bx bxs-like text-lg"></i>
                                            </div>
                                            <div class="flex flex-col justify-center items-center">
                                                <p>{{ $doc->likers()->count() }}</p>
                                            </div>
                                        </div>
                                    </x-splade-link>
                                </x-tomato-admin-tooltip>
                            @endif

                        @endif
                    </div>

                    @if(isset($currentPage))
                    <div class="flex flex-col justify-center items-center">
                        <x-circle-xo-share :title="$currentPage->title" :description="$currentPage->description" >
                            <x-tomato-admin-tooltip :text="__('Share')">
                                        <span class="bg-success-600 flex flex-col justify-center items-center text-white rounded-md shadow-md font-bold text-sm p-3">
                                            <i class="bx bxs-share text-lg text-white"></i>
                                        </span>
                            </x-tomato-admin-tooltip>
                        </x-circle-xo-share>
                    </div>
                    @else
                    <div class="flex flex-col justify-center items-center">
                        <x-circle-xo-share :title="$doc->name" :description="$doc->description" >
                            <x-tomato-admin-tooltip :text="__('Share')">
                                        <span class="bg-success-600 flex flex-col justify-center items-center text-white rounded-md shadow-md font-bold text-sm p-3">
                                            <i class="bx bxs-share text-lg text-white"></i>
                                        </span>
                            </x-tomato-admin-tooltip>
                        </x-circle-xo-share>
                    </div>
                        @endif
                </div>
            @endif

        </div>
    </div>
    <x-splade-modal name="doc-menu" position="left" max-width="sm" slideover>
        <div class="mt-6">
            <div class="overflow-auto h-screen scrollbar text-white">
                <div class="flex flex-col justify-center items-center w-full gap-1">
                    <x-splade-link  preserve-scroll :href="route('docs.show', ['username' => $account->username, 'slug'=>$doc->package])" class="rounded-lg  hover:bg-zinc-800 p-3 w-full">
                        <div class=" flex justify-start gap-4 @if(url()->current() === route('docs.show', ['username' => $account->username, 'slug'=>$doc->package])) text-main-600 @endif" >
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bxs-home text-md"></i>
                            </div>
                            <div>
                                <h1 class="text-md font-bold">{{ __('Overview') }}</h1>
                            </div>
                        </div>
                    </x-splade-link>

                    @php
                        $groups = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('doc_id', $doc->id)->groupBy('group')->get();
                    @endphp

                    @foreach($groups as $group)
                        @php
                            $menu = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('group', $group->group);
                            $menu->where('doc_id', $doc->id);
                            $menu = $menu->get();
                        @endphp
                        @if($group->group && !request()->has('search'))
                            <div class="flex justify-start w-full mt-6 mb-2 px-3">
                                <h1 class="text-sm font-bold uppercase">{{ $group->group }}</h1>
                            </div>
                        @endif
                        @foreach($menu as $page)
                            <x-splade-link preserve-scroll :href="route('docs.page', ['username' => $account->username, 'slug'=>$doc->package, 'page'=> $page->slug])" class="rounded-lg hover:bg-zinc-800 p-3 w-full">
                                <div class=" flex justify-start gap-4 @if(url()->current() === route('docs.page', ['username' => $account->username, 'slug'=>$doc->package, 'page'=> $page->slug])) text-main-600 @endif" >
                                    <div class="flex flex-col justify-center items-center">
                                        <i class="{{$page->icon ?? 'bx bxs-file-doc'}} text-md"></i>
                                    </div>
                                    <div>
                                        <h1 class="text-md font-bold">{{ $page->title }}</h1>
                                    </div>
                                </div>
                            </x-splade-link>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </x-splade-modal>

    <x-splade-modal name="search-docs">
        <x-slot:title>
            {{__('Docs Search')}}
        </x-slot:title>
        <SearchDocs url="{{ url('/') }}" id="{{$doc->id}}" placeholder="{{__('Search By Any Thing On Docs')}}" />
    </x-splade-modal>
</x-circle-xo-public-profile-layout>


