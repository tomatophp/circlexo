<x-tomato-admin-layout>
    @php
        $settings = \Modules\TomatoSettings\App\Facades\TomatoSettings::load()->groupBy('group');
    @endphp

    @foreach($settings as $settingGroup=>$setting)
        <div class="my-4">
            <h1 class="text-lg font-bold tracking-tight md:text-3xl filament-header-heading">{{ $settingGroup }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 my-4">
                @foreach($setting as $item)
                    <x-splade-link :href="$item->route ? route($item->route) : $item->url" class="relative rounded-lg shadow-sm p-4 border border-zinc-100 bg-white dark:bg-zinc-900 dark:border-zinc-800 flex flex-col items-center justify-center">
                        @if($item->badge)
                            <div class=" absolute top-4 left-4 z-10">
                                <div class="py-1 px-4 text-xs bg-primary-300 text-primary-600 font-medium border-primary-400 rounded-full">
                                    <span>{{$item->badge}}</span>
                                </div>
                            </div>
                        @endif
                        @if(\Illuminate\Support\Str::of($item->icon)->contains('http'))
                            <div class="my-2">
                                <div style="background-image: url('{{$item->icon}}')" alt="{{$item->label}}" class="w-12 h-12 bg-cover bg-center"></div>
                            </div>
                        @else
                            <div class="my-2">
                                <i class="{{$item->icon ?? 'bx bxs-cog'}} bx-lg text-primary-600" style="color: {{$item->color ?: '#000'}} !important;"></i>
                            </div>
                        @endif
                        <h1 class="font-bold text-lg">{{$item->label}}</h1>
                        <p class="text-sm text-zinc-400">{{$item->description}}</p>
                    </x-splade-link>
                @endforeach
            </div>
        </div>
    @endforeach

</x-tomato-admin-layout>
