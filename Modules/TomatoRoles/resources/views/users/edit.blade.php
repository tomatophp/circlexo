<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{ trans('tomato-roles::global.users.single') }} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.users.update', $model->id)}}" method="post" :default="$model">

        <x-splade-input name="name" type="text" :label="trans('tomato-roles::global.users.name')"  :placeholder="trans('tomato-roles::global.users.name')" />
        <x-splade-input name="email" type="email" :label="trans('tomato-roles::global.users.email')"  :placeholder="trans('tomato-roles::global.users.email')" />
        <div class="flex justifiy-between gap-4">
            <x-splade-input class="w-full" name="password" type="password" :label="trans('tomato-roles::global.users.password')"  :placeholder="trans('tomato-roles::global.users.password')" />
            <x-splade-input class="w-full" name="password_confirmation" :label="trans('tomato-roles::global.users.password_confirmation')" type="password"  :placeholder="trans('tomato-roles::global.users.password_confirmation')" />
        </div>
        <x-splade-select :placeholder="trans('tomato-roles::global.users.roles')" :label="trans('tomato-roles::global.users.roles')" name="roles[]" :options="$roles" option-label="name" option-value="id" choices relation multiple/>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.users.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.users.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
