<x-circle-xo-profile-layout>
    <div class="w-full py-4 px-8 mt-4 border-b border-zinc-700">
        <div class="flex justify-between">
            <div class="w-full">
                <div class=" flex justify-start gap-4">
                    <div class="flex flex-col justify-center items-center  hidden lg:block">
                        @yield('icon')
                    </div>
                    <div class="lg:hidden flex flex-col justify-center items-center">
                        <Link href="#doc-menu" class="mt-1">
                        <i class="bx bx-menu text-2xl"></i>
                        </Link>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">@yield('title')</h1>
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
                <x-splade-link preserve-scroll :href="route('profile.docs-pages.create') . '?doc_id='.$model->id" class="rounded-lg bg-main-600 text-zinc-700 p-3 w-full my-4">
                    <div class=" flex justify-start gap-4">
                        <div class="flex flex-col justify-center items-center">
                            <i class="bx bx-plus-circle text-md"></i>
                        </div>
                        <div>
                            <h1 class="text-md font-bold">{{ __('Add Page') }}</h1>
                        </div>
                    </div>
                </x-splade-link>
                <x-splade-link  preserve-scroll :href="route('profile.docs.show', $model->id)" class="rounded-lg  hover:bg-zinc-800 p-3 w-full">
                    <div class=" flex justify-start gap-4 @if(url()->current() === route('profile.docs.show', $model->id)) text-main-600 @endif" >
                        <div class="flex flex-col justify-center items-center">
                            <i class="bx bxs-home text-md"></i>
                        </div>
                        <div>
                            <h1 class="text-md font-bold">{{ __('Overview') }}</h1>
                        </div>
                    </div>
                </x-splade-link>

                @php
                    $groups = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('doc_id', $model->id)->groupBy('group')->get();
                @endphp

                @foreach($groups as $group)
                    @php
                        $menu = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('group', $group->group);
                        if(request()->get('search')){
                            $menu = $menu->where('title', 'like', '%'.request()->get('search').'%');
                        }

                        $menu->where('doc_id', $model->id);
                        $menu = $menu->get();
                    @endphp
                    @if($group->group && !request()->has('search'))
                        <div class="flex justify-start w-full mt-6 mb-2 px-3">
                            <h1 class="text-sm font-bold uppercase">{{ $group->group }}</h1>
                        </div>
                    @endif
                    @foreach($menu as $page)
                            <x-splade-link preserve-scroll :href="route('profile.docs-pages.show', $page->id)" class="rounded-lg hover:bg-zinc-800 p-3 w-full">
                                <div class=" flex justify-start gap-4 @if(url()->current() === route('profile.docs-pages.show', $page->id)) text-main-600 @endif" >
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
            @yield('content')
        </div>
    </div>
    <x-splade-modal name="doc-menu" position="left" max-width="sm" slideover>
        <div class="mt-6">
            <div class="overflow-auto h-screen scrollbar text-white">
                <div class="flex flex-col justify-center items-center w-full gap-1">
                    <x-splade-link preserve-scroll :href="route('profile.docs-pages.create') . '?doc_id='.$model->id" class="rounded-lg bg-main-600 text-zinc-700 p-3 w-full my-4">
                        <div class=" flex justify-start gap-4">
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bx-plus-circle text-md"></i>
                            </div>
                            <div>
                                <h1 class="text-md font-bold">{{ __('Add Page') }}</h1>
                            </div>
                        </div>
                    </x-splade-link>
                    <x-splade-link  preserve-scroll :href="route('profile.docs.show', $model->id)" class="rounded-lg  hover:bg-zinc-800 p-3 w-full">
                        <div class=" flex justify-start gap-4 @if(url()->current() === route('profile.docs.show', $model->id)) text-main-600 @endif" >
                            <div class="flex flex-col justify-center items-center">
                                <i class="bx bxs-home text-md"></i>
                            </div>
                            <div>
                                <h1 class="text-md font-bold">{{ __('Overview') }}</h1>
                            </div>
                        </div>
                    </x-splade-link>

                    @php
                        $groups = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('doc_id', $model->id)->groupBy('group')->get();
                    @endphp

                    @foreach($groups as $group)
                        @php
                            $menu = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query()->where('group', $group->group);
                            $menu->where('doc_id', $model->id);
                            $menu = $menu->get();
                        @endphp
                        @if($group->group && !request()->has('search'))
                            <div class="flex justify-start w-full mt-6 mb-2 px-3">
                                <h1 class="text-sm font-bold uppercase">{{ $group->group }}</h1>
                            </div>
                        @endif
                        @foreach($menu as $page)
                            <x-splade-link preserve-scroll :href="route('profile.docs-pages.show', $page->id)" class="rounded-lg hover:bg-zinc-800 p-3 w-full">
                                <div class=" flex justify-start gap-4 @if(url()->current() === route('profile.docs-pages.show', $page->id)) text-main-600 @endif" >
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
        <SearchDocs url="{{ url('/') }}" id="{{$model->id}}" username="{{$model->account->username}}" package="{{$model->package}}" placeholder="{{__('Search By Any Thing On Docs')}}" />
    </x-splade-modal>
</x-circle-xo-profile-layout>
