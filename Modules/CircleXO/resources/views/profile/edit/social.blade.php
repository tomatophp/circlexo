<x-splade-modal>
    <x-slot:title>
        {{ __('Update Info') }}
    </x-slot>
    <x-splade-form :default="[
        'social' => auth('accounts')->user()->meta('social') ?: [],
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.meta.update')}}">
        <x-tomato-admin-repeater name="social" label="Links" :options="['name', 'link', 'label']">
            <div class="flex flex-col gap-4">
                <x-splade-select choices type="text" v-model="repeater.main[key].name" label="Name">
                    <option value="facebook">{{ __('Facebook') }}</option>
                    <option value="twitter">{{ __('Twitter') }}</option>
                    <option value="youtube">{{ __('Youtube') }}</option>
                    <option value="instagram">{{ __('Instagram') }}</option>
                    <option value="tiktok">{{ __('Tiktok') }}</option>
                    <option value="github">{{ __('GitHub') }}</option>
                    <option value="behance">{{ __('Behance') }}</option>
                    <option value="website">{{ __('Website') }}</option>
                </x-splade-select>
                <x-splade-input type="text" v-model="repeater.main[key].label" label="Label" />
                <x-splade-input type="text" v-model="repeater.main[key].link" label="Link" />
            </div>
        </x-tomato-admin-repeater>

        <x-splade-button label="Update" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
</x-splade-modal>
