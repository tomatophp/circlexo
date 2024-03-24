<x-tomato-admin-container :label="isset($item) ? __('Update') . ' ' . $label  : __('Add') . ' ' . $label ">
<x-splade-form class="grid grid-cols-2 gap-4" method="POST" action="{{route('admin.types.'.$for.'.'.$type.'.store')}}" :default="$item ?? []">
    <div class="col-span-2">
        <x-tomato-translation  label="{{__('Name')}}" placeholder="{{__('Name')}}" name="name" />
    </div>
    <x-splade-input class="col-span-2" label="{{__('Key')}}" placeholder="{{__('Key')}}" name="key" />
    <div class="flex justify-between gap-4 col-span-2">
        <x-tomato-admin-icon class="w-full" label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
        <x-tomato-admin-color  label="{{__('Color')}}" placeholder="{{__('Color')}}" name="color" />
    </div>

    <div class="flex justify-start gap-4">
        <x-tomato-admin-submit spinner :label="__('Save')" />
        <x-tomato-admin-button secondary @click.prevent="modal.close" :label="__('Cancel')" />
    </div>
    </x-splade-form>
</x-tomato-admin-container>
