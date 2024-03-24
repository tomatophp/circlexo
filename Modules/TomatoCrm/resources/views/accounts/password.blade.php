<x-tomato-admin-container label="{{__('Change Password For')}} # {{$model->name}}">
    <x-splade-form confirm class="grid grid-cols-2 gap-4" action="{{route('admin.accounts.password.update', $model->id)}}" method="post">
        <x-splade-input label="{{__('Password')}}" name="password" type="password" placeholder="{{__('Password')}}"/>
        <x-splade-input label="{{__('Password Confirmation')}}" name="password_confirmation" type="password" placeholder="{{__('Password Confirmation')}}"/>

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" type="button" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
