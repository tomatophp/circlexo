<x-splade-modal>
    <x-slot:title>
        {{ __('Sponsoring Link') }}
    </x-slot>
    <x-splade-form :default="[
        'sponsoring_link' => auth('accounts')->user()->meta('sponsoring_link'),
        'sponsoring_message' => auth('accounts')->user()->meta('sponsoring_message'),
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.meta.update')}}">
        <x-splade-input name="sponsoring_link" :label="__('Sponsoring Link')" />
        <x-tomato-markdown-editor name="sponsoring_message" :label="__('Sponsoring Message')" />

        <x-splade-submit spinner :label="__('Save')" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
</x-splade-modal>
