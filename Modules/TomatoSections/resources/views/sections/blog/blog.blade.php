@php
    $section = $page->meta($section['uuid']);
    if(!isset($posts)){
        $posts = \Modules\TomatoCms\App\Models\Post::query()->where('activated', 1)->paginate(10);
    }

@endphp
<div class="bg-white">
    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-8">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    {{$section['title_'.app()->getLocale()] ?? __('Blog')}}
                </h1>

                <div>
                    <x-splade-form method="GET" action="{{url()->current()}}" :default="['search' => request()->get('search') ?? '']">
                        <x-splade-input type="search" name="search" placeholder="{{__('Search ...')}}">
                            <x-slot:prepend>
                                <div class="flex flex-col justify-center items-center text-black">
                                    <i class="bx bx-search"></i>
                                </div>
                            </x-slot:prepend>
                        </x-splade-input>
                    </x-splade-form>
                </div>
            </div>

            <div class="my-4">
                @if(!count($posts))
                    <div class="flex flex-col justify-center items-center text-center border rounded-lg shadow-sm font-main">
                        <div class="my-4">
                            <x-heroicon-m-magnifying-glass class="w-16 h-16 mx-auto my-4 text-center" />
                            <h2 class="text-2xl font-medium">
                                {{__("Sorry, There is not result for this search")}}
                            </h2>

                            <p class="mt-4 text-sm text-gray-500">
                                {{__("Please try another word or contact us to add an article")}}
                            </p>

                            <x-tomato-admin-button class="my-4" href="{{ url('/')  }}">
                                {{__("Back to Home")}}
                            </x-tomato-admin-button>
                        </div>
                    </div>
                @endif
                <!-- component -->
                <div class="grid grid-cols-1 gap-4 lg:gap-8 sm:grid-cols-1 lg:grid-cols-2 font-main">
                    @foreach ($posts as $post)
                        @include('tomato-sections::sections.blog.parts.blog-card')
                    @endforeach
                </div>
                <div class="px-8 py-8 lg:gap-8 font-main">
                    <div class="px-4 py-4 mx-auto">
                        {{ $posts->links('tomato-sections::sections.pagination') }}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
