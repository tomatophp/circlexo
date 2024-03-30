<x-splade-modal>
    <x-slot:title>
        {{__('Add More Details')}}
    </x-slot:title>
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.contacts.meta.store', $account)}}" method="post">
        <x-splade-input :label="__('Name')" name="key" type="text"  :placeholder="__('Name')" />
        <x-splade-textarea :label="__('Value')" name="value" :placeholder="__('Value')" autosize />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-splade-modal>
