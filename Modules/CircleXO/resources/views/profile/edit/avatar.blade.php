<x-splade-modal>
    <x-slot:title>
        {{ __('Update Avatar') }}
    </x-slot>
    <x-splade-form :default="['avatar' => auth('accounts')->user()->avatar]" class="flex flex-col gap-4" method="POST" action="{{route('profile.media.update')}}">
        <x-splade-file preview filepond name="avatar" label="Avatar" />
        <x-splade-button label="Update" class="bg-main-600 border-main-400 text-gray-900" />
    </x-splade-form>
</x-splade-modal>
