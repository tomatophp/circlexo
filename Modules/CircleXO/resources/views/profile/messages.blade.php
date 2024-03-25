<x-circle-xo-profile-layout>
    <div class="my-12 mx-8 lg:mx-16">
        <x-splade-table :for="$table" striped>
            <x-splade-cell name>
                <x-tomato-admin-row table :value="$item->name" type="text" />
            </x-splade-cell>
            <x-splade-cell email>
                <x-tomato-admin-row table :value="$item->email" type="email" />
            </x-splade-cell>
            <x-splade-cell anonymous_message>
                <x-tomato-admin-row table :value="$item->anonymous_message" type="bool" />
            </x-splade-cell>
        </x-splade-table>
    </div>
</x-circle-xo-profile-layout>
