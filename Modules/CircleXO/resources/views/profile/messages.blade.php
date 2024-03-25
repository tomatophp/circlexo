<x-circle-xo-profile-layout>
    <div class="my-4 mx-8 lg:mx-16">
        <x-splade-table :for="$table" striped>
            <x-splade-cell anonymous_message>
                <x-tomato-admin-row table :value="$item->anonymous_message" type="bool" />
            </x-splade-cell>
        </x-splade-table>
    </div>
</x-circle-xo-profile-layout>
