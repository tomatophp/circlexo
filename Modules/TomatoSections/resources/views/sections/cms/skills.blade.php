@php $section = $page->meta($section['uuid']); @endphp
<section>
    <div class="px-4 py-16 sm:px-6 lg:px-32 font-main"  style="background-color: {{$section['bg_color'] ?? '#efefef'}}; color: {{$section['font_color'] ?? '#000'}}">
        <h2 class="text-4xl font-bold tracking-tight text-center sm:text-3xl text-main">
            {{$section['title_'.app()->getLocale()] ?? __("My Skills")}}
        </h2>
        <p class="mx-auto mt-4 max-w-[80ch]">
            {{$section['description_'.app()->getLocale()] ?? __("Working for 13 years in one field makes you learn a lot and a lot, so I have a lot of different skills in the fields of information security, marketing, software and graphic design")}}
        </p>
        <div class="grid grid-cols-2 gap-4 my-10 text-center lg:grid-cols-4">
            @php
                if($section['is_random'] ?? false){
                    $skills = \Modules\TomatoCms\App\Models\Skill::inRandomOrder()->get();
                }
                else {
                    $skills = \Modules\TomatoCms\App\Models\Skill::whereIn('id', $section['skills'] ?? [])->get();
                }
            @endphp
            @foreach ($skills as $skill)
                <a class="block p-4 bg-white border shadow-sm rounded-xl focus:outline-none focus:ring hover:border-gray-200 hover:ring-1 hover:ring-gray-200"
                   href="{{$skill->url}}" target="_blank">
                <span class="inline-block p-3 w-12 h-12 text-white rounded-lg bg-primary-500">
                    @if($skill->getMedia('image')->first())
                        <img src="{{ $skill->getMedia('image')->first()->getUrl() }}" alt="{{ $skill->name }}" class="w-full h-full" />
                    @else
                        <i class="{{ $skill->icon }} bx-sm"></i>
                    @endif
                </span>

                    <h6 class="mt-2 font-bold text-black">{{ $skill->name }}</h6>

                    <p class="hidden sm:mt-1 sm:text-sm sm:text-gray-500 sm:block">
                        {{ $skill->description }}
                    </p>

                    <div class="relative pt-1">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold text-white uppercase rounded-full bg-sec">
                                {{__("Level")}}
                            </span>
                            </div>
                            <div class="text-right">
                            <span class="inline-block text-xs font-semibold text-black ">
                                {{ $skill->exp }}%
                            </span>
                            </div>
                        </div>
                        <div class="flex h-2 mb-4 overflow-hidden text-xs rounded bg-success-500">
                            <div style="width: {{ $skill->exp }}%"
                                 class="flex flex-col justify-center text-center text-white shadow-none bg-main whitespace-nowrap">
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
