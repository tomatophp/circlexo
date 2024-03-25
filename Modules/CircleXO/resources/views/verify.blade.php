@if($item->type !== 'verified')
    <x-tomato-admin-button :href="route('account.verify', $item)" confirm method="POST" type="icon" success :title="__('Verify Account')">
        <x-heroicon-s-check-circle class="w-6 h-6" />
    </x-tomato-admin-button>
@else
    <x-tomato-admin-button :href="route('account.verify', $item)" confirm method="POST" type="icon" danger :title="__('Verify Account')">
        <x-heroicon-s-x-circle class="w-6 h-6" />
    </x-tomato-admin-button>
@endif
