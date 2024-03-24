<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Group') }} #{{$model->id}}">
    <div class="grid grid-cols-1 gap-4">

        <div>
            <div class="px-2 py-1 mb-2 font-normal bg-table_head dark:bg-dark_hover dark:text-white">
                {{__('Name')}}:
            </div>
            <div class="text-base font-semibold text-slate-900 dark:text-white capitalize px-2">
                {{ $model->name}}
            </div>
        </div>

    </div>
</x-tomato-admin-container>
