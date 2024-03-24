<div {{ $attributes }}>
    @if($type === 'button')
    @elseif($type === 'link')
        <Link href="{{$href}}" v-bind:modal="{{ $modal }}" method="{{ $method }}" :class="@js($styleClass)">
            @if($label)
                {{ $label }}
            @else
                {{ $slot }}
            @endif
        </Link>
    @endif
</div>
