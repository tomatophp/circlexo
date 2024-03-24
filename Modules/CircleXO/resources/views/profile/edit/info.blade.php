<x-splade-modal>
    <x-slot:title>
        {{ __('Update Info') }}
    </x-slot>
    <x-splade-form :default="[
        'name' => auth('accounts')->user()->name,
        'email' => auth('accounts')->user()->email,
        'username' => str(auth('accounts')->user()->username)->replaceFirst('@', ''),
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.info.update')}}">
        <x-splade-input name="name" label="Name" />
        <x-splade-input name="email" label="email" />
        <x-splade-input name="username" label="username" />

        <x-splade-button label="Update" class="bg-main-600 border-main-400 text-gray-900" />
    </x-splade-form>
</x-splade-modal>
