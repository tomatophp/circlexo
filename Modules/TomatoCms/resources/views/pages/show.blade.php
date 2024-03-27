<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('pages')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">


          <x-tomato-admin-row :label="__('Title')" :value="$model->title" type="text" />


          <x-tomato-admin-row :label="__('Slug')" :value="$model->slug" type="string" />

          <x-tomato-admin-row :label="__('Is active')" :value="$model->is_active" type="bool" />

          <x-tomato-admin-row :label="__('Has view')" :value="$model->has_view" type="bool" />

          <x-tomato-admin-row :label="__('Views')" :value="$model->view" type="string" />

        <x-tomato-admin-row :label="__('Color')" :value="$model->color" type="color" />



    </div>
    <div class="flex justify-start gap-2 pt-3">
        <a  class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent" target="_blank" href="{{url($model->slug)}}">
            {{__('HTML')}}
        </a>
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.pages.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.pages.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.pages.index')" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
