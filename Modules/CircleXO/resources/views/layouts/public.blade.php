@seoTitle(isset(app()->view->getSections()['title']) ? app()->view->getSections()['title']  . ' | ' : ''. setting('site_name'))
@seoDescription(isset(app()->view->getSections()['description']) ? app()->view->getSections()['description']  . ' | ' : '' . setting('site_description'))
@seoKeywords(isset(app()->view->getSections()['keywords']) ? app()->view->getSections()['keywords']  . ' | ' : '' .setting('site_keywords'))

<x-circle-xo-public-profile-layout :account="$account">
    <div class="flex justify-center">
        <div class="my-8 mx-8 lg:mx-16 bg-zinc-800 rounded-lg border border-zinc-700 w-full overflow-hidden">
            <div class="border-b border-zinc-700 bg-zinc-700 p-4">
                @yield('title')
            </div>
            <div class="p-4">
                <x-splade-modal>
                    <x-slot:title>
                        @yield('title')
                    </x-slot>
                    @yield('content')
                </x-splade-modal>
            </div>
        </div>
    </div>
</x-circle-xo-public-profile-layout>
