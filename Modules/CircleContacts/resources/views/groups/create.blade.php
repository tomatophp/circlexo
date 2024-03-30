<x-splade-modal>
    <x-slot:title>
        {{__('New Group')}}
    </x-slot:title>
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.groups.store')}}" method="post">

        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-textarea :label="__('Description')" name="description" :placeholder="__('Description')" autosize />
        <div class="flex justify-between gap-4">
            <x-tomato-admin-icon class="w-full" :label="__('Icon')" :placeholder="__('Icon')" name="icon" />
            <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" name="color" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-splade-modal>


