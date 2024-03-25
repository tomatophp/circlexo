<Link href="{{ url()->current() . '?type='.$filter }}" class="px-4 md:px-6 py-2 flex justify-center gap-2 {{ $color }} @if((request()->has('type') && request()->get('type') === $filter)) font-bold bg-gray-700 @endif">
    <x-tomato-admin-tooltip :text="$label">
        <i class="{{ $icon }}"></i>
    </x-tomato-admin-tooltip>
    <div class="hidden md:block">
        {{ $label }}
    </div>
</Link>
