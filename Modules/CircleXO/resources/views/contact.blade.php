<x-splade-modal>
    <x-slot:title>
        {{ __('Send Message To') . " " . $account->username }}
    </x-slot>
    <x-splade-form :default="[
        'anonymous_message' => false,
        'name' => auth('accounts')->user() ? auth('accounts')->user()->name : null,
        'email' => auth('accounts')->user() ? auth('accounts')->user()->email :null,
    ]" class="flex flex-col gap-4" method="POST" action="{{route('home.contact.send', $account->username)}}">
        <x-splade-checkbox name="anonymous_message" label="Anonymous Message" />
        @if(!auth('accounts')->user())
            <x-splade-input v-if="!form.anonymous_message" name="name" label="Name" />
            <x-splade-input v-if="!form.anonymous_message" name="email" type="email" label="Email" />
        @endif
        <x-splade-textarea name="message" label="Message" />

        <x-splade-submit spinner label="Send" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
</x-splade-modal>
