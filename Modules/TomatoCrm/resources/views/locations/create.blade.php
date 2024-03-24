<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Location')}}">
    <x-splade-form  action="{{route('admin.locations.store')}}" method="post" :default="[
        'account_id' => $account_id,
    ]">
        <div class="flex flex-col gap-4 mb-4">
            <div class="grid grid-cols-3 gap-4">
                <x-splade-input label="{{__('Home number')}}" type='number' name="home_number" placeholder="{{__('Home number')}}" />
                <x-splade-input label="{{__('Flat number')}}" type='number' name="flat_number" placeholder="{{__('Flat number')}}" />
                <x-splade-input label="{{__('Floor number')}}" type='number' name="floor_number" placeholder="{{__('Floor number')}}" />
            </div>
            <x-splade-input label="{{__('Street')}}" name="street" type="text"  placeholder="Street" />
            <x-tomato-location />
            <x-splade-input label="{{__('Zip')}}" name="zip" type="text"  placeholder="{{__('Zip')}}" />
            <x-splade-input label="{{__('Mark')}}" name="mark" type="text"  placeholder="{{__('Mark')}}" />
            <x-splade-textarea label="{{__('Map url')}}" name="map_url" placeholder="{{__('Map url')}}" autosize />
            <x-splade-input label="{{__('Note')}}" name="note" type="text"  placeholder="{{__('Note')}}" />
            <x-splade-checkbox label="{{__('Is Main')}}" name="is_main" />
        </div>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit :label="__('Save')" :spinner="true" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>

</x-tomato-admin-container>
