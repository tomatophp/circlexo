@if($account->meta('social'))
    @foreach($account->meta('social') as $social)
        @if($edit)
            <x-splade-link modal :href="route('profile.social.edit', $social['name'])" target="_blank">
                <x-tomato-admin-tooltip :text="isset($social['label']) ? $social['label'] : $social['name'] ">
                    @if($social['name'] !== 'website')
                        <i class="bx bxl-{{ $social['name'] }} text-2xl text-zinc-200 hover:text-white"></i>
                    @else
                        <i class="bx bx-link text-2xl text-zinc-200 hover:text-white"></i>
                    @endif
                </x-tomato-admin-tooltip>
            </x-splade-link>
        @else
            <a href="{{ $social['link'] }}" target="_blank">
                <x-tomato-admin-tooltip :text="isset($social['label']) ? $social['label'] : $social['name'] ">
                    @if($social['name'] !== 'website')
                        <i class="bx bxl-{{ $social['name'] }} text-2xl text-zinc-200 hover:text-white"></i>
                    @else
                        <i class="bx bx-link text-2xl text-zinc-200 hover:text-white"></i>
                    @endif
                </x-tomato-admin-tooltip>
            </a>
        @endif
    @endforeach
@endif
