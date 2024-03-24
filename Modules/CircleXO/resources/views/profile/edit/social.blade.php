<x-splade-modal>
    <x-slot:title>
        {{ __('Update Info') }}
    </x-slot>
    <x-splade-form :default="[
        'social' => auth('accounts')->user()->meta('social') ?: [],
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.meta.update')}}">
        <x-tomato-admin-repeater name="social" label="Links" :options="['name', 'link']">
            <div class="flex flex-col gap-4">
                <x-splade-input type="text" v-model="repeater.main[key].name" label="Name" />
                <x-splade-input type="text" v-model="repeater.main[key].link" label="Link" />
            </div>
        </x-tomato-admin-repeater>

        <x-splade-button label="Update" class="bg-main-600 border-main-400 text-gray-900" />
    </x-splade-form>
</x-splade-modal>
