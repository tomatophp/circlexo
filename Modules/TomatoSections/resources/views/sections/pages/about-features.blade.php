@php $section = $page->meta($section['uuid']); @endphp
<div class="font-main py-8 px-16"  style="background-color: {{$section['bg_color'] ?? '#fff'}}; color: {{$section['font_color'] ?? '#000'}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-y-8 lg:gap-x-16 lg:items-center">
        <div class="max-w-lg mx-auto  lg:mx-0">
            <h2 class="text-3xl font-bold sm:text-4xl text-main">
                {{$section['title_' . app()->getLocale()] ??  __("Summary about me")}}
            </h2>

            <p class="mt-4">
                {{$section['body_' . app()->getLocale()] ?? __("I'm Fady, Egyptian Graphics Designer, Marketer, Programmer with more than 13 years of experience in many fields like Graphics, Programming, Security Systems, Cyber Security and Content Writing")}}
            </p>

            <x-tomato-admin-button :href="$section['url'] ?? '/about'" class="my-4">
                     <span class="text-sm font-medium">
                        {{$section['button_' . app()->getLocale()] ?? __("About Me")}}
                    </span>
                @if(app()->getLocale() == 'ar')
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-4" />
                @else
                    <x-heroicon-o-arrow-right class="w-4 h-4 ml-4" />
                @endif
            </x-tomato-admin-button>
        </div>

        <div class="grid grid-cols-2 gap-4 text-center lg:grid-cols-3 sm:grid-cols-2">
            @php $features = \Modules\TomatoThemes\App\Models\Feature::whereIn('id', $section['features'] ?? [])->get(); @endphp
            @foreach($features as $feature)
                <div class="
                bg-white
                            block
                            p-4
                            border
                            border-gray-100
                            shadow-sm
                            rounded-xl
                            focus:outline-none
                            focus:ring
                            hover:border-gray-200
                            hover:ring-1
                            hover:ring-gray-200
                        ">

                        <span class="inline-block p-3 text-white rounded-lg bg-main w-12 h-12" style="background-color: {{$feature->icon_bg_color}}; color: {{$feature->icon_color}}">
                            <i class="{{$feature->icon}} bx-sm"></i>
                        </span>

                    <h6 class="mt-2 font-bold text-black">
                        {{$feature->title}}
                    </h6>

                    <p class="hidden sm:mt-1 sm:text-sm sm:text-gray-600 sm:block">
                        {{$feature->description}}
                    </p>
                </div>
            @endforeach

        </div>
    </div>
</div>
