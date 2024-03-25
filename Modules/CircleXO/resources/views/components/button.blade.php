<div >
    @if($type === 'button')
        <button {{ $attributes }} :class="@js($styleClass)">
            @if($label)
                {{ $label }}
            @else
                {{ $slot }}
            @endif
        </button>
    @elseif($type === 'link')
        <Link {{ $attributes }} href="{{$href}}" v-bind:modal="{{ $modal }}" method="{{ $method }}" :class="@js($styleClass)">
            @if($label)
                {{ $label }}
            @else
                {{ $slot }}
            @endif
        </Link>
    @endif
</div>
