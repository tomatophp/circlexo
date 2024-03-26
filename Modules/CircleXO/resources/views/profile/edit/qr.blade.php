<x-splade-modal>
    <x-slot:title>
        {{ __('Profile QR') }}
    </x-slot>

    <x-splade-form :default="[
        'background' => auth('accounts')->user()->meta('qr.background') ?: '#F8CF00',
        'color' => auth('accounts')->user()->meta('qr.color') ?: '#000000',
        'style' => auth('accounts')->user()->meta('qr.style') ?: 'square',
        'eye' => auth('accounts')->user()->meta('qr.eye') ?: 'square',
        'size' => auth('accounts')->user()->meta('qr.size') ?: 300,
        'margin' => auth('accounts')->user()->meta('qr.margin') ?: 3,
    ]" method="POST" class="grid grid-cols-2 gap-4" :action="route('profile.qr.update')">
        <x-tomato-admin-color name="background" label="Background" />
        <x-tomato-admin-color name="color" label="Color" />
        <x-splade-select choices name="style" label="Style">
            <option value="square">Square</option>
            <option value="dot">Dot</option>
            <option value="round">Round</option>
        </x-splade-select>
        <x-splade-select choices name="eye" label="Eye">
            <option value="square">Square</option>
            <option value="circle">Circle</option>
        </x-splade-select>
        <x-splade-input type="number" name="size" label="Size" />
        <x-splade-input type="number" name="margin" label="Margin" />
        <div class="col-span-2">
            <x-splade-submit spinner :label="__('Update')" class="bg-main-600 border-main-400 text-zinc-900" />
        </div>
    </x-splade-form>
</x-splade-modal>
