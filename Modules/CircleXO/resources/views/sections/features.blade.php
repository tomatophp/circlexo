@php $section = $page->meta($section['uuid']); @endphp
<section class="bg-zinc-800 py-16">
    <div class="container max-w-screen-xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="text-center max-w-2xl mx-auto relative">
            <span class="uppercase text-main-600 text-base font-bold mb-5">{{ $section['subtitle'] ?? __('Features') }}</span>
            <h1 class="font-bold text-4xl leading-tight mb-2">{{ $section['title'] ?? __('Feature Highlights') }}</h1>
        </div>
        <div class="mt-14">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $features = \Modules\TomatoThemes\App\Models\Feature::whereIn('id', $section['features'] ?? [])->get(); @endphp
                @foreach($features as $feature)
                    {{-- Card --}}
                    <div class="border border-zinc-700 p-8 rounded-lg bg-zinc-900">
                        <div class="flex flex-col items-center gap-2">
                            <i class="{{ $feature->icon }} text-main-600 text-6xl"></i>
                            <div>
                                <h1 class="text-xl font-bold">{{ $feature->title }}</h1>
                            </div>
                        </div>
                        <p class="text-zinc-300 mt-4 text-center">{{ $feature->description }}</p>
                    </div>
                    {{-- End Card --}}
                @endforeach
            </div>
        </div>
    </div>
</section>
