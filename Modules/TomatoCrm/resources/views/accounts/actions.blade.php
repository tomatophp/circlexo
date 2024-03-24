<div class="flex justify-center">
    <x-tomato-admin-button
        success
        type="link"
        icon="bx bxs-show"
        label="{{trans('tomato-admin::global.crud.view')}}"
        :href="route('admin.accounts.show', $item->id)"
    ></x-tomato-admin-button>
    <x-tomato-admin-button
        warning
        modal
        type="link"
        icon="bx bxs-edit"
        label="{{trans('tomato-admin::global.crud.edit')}}"
        :href="route('admin.accounts.edit', $item->id)"
    ></x-tomato-admin-button>
    <x-tomato-admin-button
        danger
        type="link"
        icon="bx bxs-lock-alt"
        modal
        label="{{__('Change Password')}}"
        :href="route('admin.accounts.password', $item->id)"
    ></x-tomato-admin-button>
    @if(class_exists(\Bavix\Wallet\Models\Wallet::class))
        <x-tomato-admin-button
            success
            type="link"
            icon="bx bxs-wallet"
            modal
            label="{{__('Charge Balance')}}"
            :href="route('admin.wallets.balance', $item->id)"
        ></x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.features.notifications'))
        <x-tomato-admin-button
            type="link"
            icon="bx bxs-bell"
            modal
            label="{{__('Send Notification')}}"
            :href="route('admin.accounts.notifications', $item->id)"
        ></x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.features.locations'))
        <x-tomato-admin-button
            warning
            type="link"
            icon="bx bxs-map"
            modal
            label="{{__('Add Address')}}"
            :href="route('admin.locations.create',['account_id' =>  $item->id])"
        ></x-tomato-admin-button>
    @endif
    @if(config('tomato-crm.views.accounts.actions', null))
        @include(config('tomato-crm.views.accounts.actions'))
    @endif
    <x-tomato-admin-button
        danger
        method="DELETE"
        type="link"
        icon="bx bxs-trash"
        label="{{trans('tomato-admin::global.crud.delete')}}"
        :href="route('admin.accounts.destroy', $item->id)"
        confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
        confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
        confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
        cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
    ></x-tomato-admin-button>
</div>
