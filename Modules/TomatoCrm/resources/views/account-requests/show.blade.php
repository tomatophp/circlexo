<x-tomato-admin-container label="{{ trans('tomato-admin::global.crud.view') }} {{ __('Account Request') }} #{{ $model->id }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <x-tomato-admin-row :label="__('Account')" :value="$model->account?->name" type="text" />

        <x-tomato-admin-row :label="__('User')" :value="$model->user?->name" type="text" />

        <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="string" />

        <x-tomato-admin-row :label="__('Status')" :value="$model->status" type="string" />

        <x-tomato-admin-row :label="__('Is approved')" :value="$model->is_approved" type="bool" />

        <hr class="col-span-2 my-4" />

        <h1 class="col-span-2 font-bold text-lg">{{ __('Account Request Body') }}</h1>

        @foreach ($model->accountRequestMetas as $meta)
            <x-splade-data :default="['is_rejected' => $meta->is_rejected]">
                <div class="col-span-2 flex justify-between">
                    <div>
                        @if ($meta->model_id)
                            <x-tomato-admin-row :label="str($meta->key)
                                ->replace('_', ' ')
                                ->title()" :value="$meta->model_type::find($meta->model_id)?->name" type="text" />
                        @elseif($meta->value === 'image')
                            <x-tomato-admin-row :label="str($meta->key)
                                ->replace('_', ' ')
                                ->title()" :value="$meta->getMedia('image')->first()?->getUrl()" type="image" />
                        @else
                            <x-tomato-admin-row :label="str($meta->key)
                                ->replace('_', ' ')
                                ->title()" :value="$meta->value" type="string" />
                        @endif
                    </div>
                    <div>
                        @if (!$meta->is_approved)
                            <div class="flex justifiy-end gap-2">
                                <x-splade-link confirm method="POST" :href="route('admin.account-requests.approve', $meta->id)">
                                    <x-tomato-admin-tooltip text="{{ __('Approve Item') }}">
                                        <i class="bx bxs-check-circle text-zinc-400 bx-sm"></i>
                                    </x-tomato-admin-tooltip>
                                </x-splade-link>
                                <button @click.prevent="data.is_rejected = !data.is_rejected">
                                    <x-tomato-admin-tooltip text="{{ __('Reject Item') }}">
                                        <i class="bx bxs-x-circle text-danger-500 bx-sm"></i>
                                    </x-tomato-admin-tooltip>
                                </button>
                            </div>
                        @else
                            <x-tomato-admin-tooltip text="{{ __('Item Approved') }}">
                                <i class="bx bxs-check-circle text-green-500 bx-sm"></i>
                            </x-tomato-admin-tooltip>
                        @endif
                    </div>
                </div>
                <div v-if="data.is_rejected" class="col-span-2 w-full">
                    <x-splade-form :default="$meta" method="POST" class="flex flex-col gap-4"
                        action="{{ route('admin.account-requests.reject', $meta->id) }}">
                        <x-splade-textarea class="w-full" label="{{ __('Rejected Reason') }}" name="rejected_reason" />
                        <x-tomato-admin-submit spinner label="{{ __('Reject') }}" />
                    </x-splade-form>
                </div>
            </x-splade-data>
        @endforeach
    </div>
    <div class="flex justify-start gap-2 pt-3">

        @if (!$model->is_approved)
            <x-tomato-admin-button confirm success method="POST" :href="route('admin.account-requests.approve.all', $model->id)" label="{{ __('Approve All') }}" />
            <x-tomato-admin-button danger :href="route('admin.account-requests.destroy', $model->id)"
                confirm="{{ trans('tomato-admin::global.crud.delete-confirm') }}"
                confirm-text="{{ trans('tomato-admin::global.crud.delete-confirm-text') }}"
                confirm-button="{{ trans('tomato-admin::global.crud.delete-confirm-button') }}"
                cancel-button="{{ trans('tomato-admin::global.crud.delete-confirm-cancel-button') }}" method="delete"
                label="{{ __('Delete') }}" />
        @endif
        <x-tomato-admin-button secondary :href="route('admin.account-requests.index')" label="{{ __('Cancel') }}" />
    </div>
</x-tomato-admin-container>
