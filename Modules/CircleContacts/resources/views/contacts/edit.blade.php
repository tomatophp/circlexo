<x-splade-modal>
    <x-slot:title>
        {{__('Edit Contact')}} #{{$model->id}}
    </x-slot:title>
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.contacts.update', $model->id)}}" method="post" :default="$model">
        @php $groups = \Modules\CircleContacts\App\Models\CircleXoContactsGroup::all() @endphp
        <x-splade-select choices="{allowHTML: true}" multiple :label="__('Groups')" name="groups" option-label="name" option-value="id" :placeholder="__('Groups')">
            @foreach($groups as $group)
                <option value="{{$group->id}}" >
                    <i class="{{$group->icon}} text-sm"></i>
                    {{$group->name}}
                </option>
            @endforeach
        </x-splade-select>
        <x-splade-file preview filepond name="avatar" :label="__('Avatar')" />

        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Email')" name="email" type="email"  :placeholder="__('Email')" />
        <x-splade-input :label="__('Phone')" name="phone" type="tel"  :placeholder="__('Phone')" />
        <x-splade-textarea :label="__('Address')" name="address" :placeholder="__('Address')" autosize />
        <x-splade-input :label="__('Company')" name="company" type="text"  :placeholder="__('Company')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('profile.contacts.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-splade-modal>
