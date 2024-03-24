<x-tomato-admin-container label="{{__('Assign Accounts To Group')}}">
    <x-splade-form :default="['ids'=>$ids, 'groups' => []]" class="flex flex-col space-y-4" action="{{route('admin.accounts.groups.store')}}" method="post">
        <x-splade-select choices multiple :options="$groups" option-value="id" option-label="name"  label="{{__('Groups')}}" name="groups" placeholder="{{__('Groups')}}" autosize />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.accounts.index')" label="{{__('Cancel')}}"/>
        </div>

    </x-splade-form>
</x-tomato-admin-container>
