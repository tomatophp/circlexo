<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Comment')}} #{{$model->id}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.comments.update', $model->id)}}" method="post" :default="$model">
        <x-splade-checkbox label="{{__('Activated')}}" name="activated" label="{{__('Activated')}}" />

        <x-tomato-admin-submit-buttons table="comments" :model="$model" save />

    </x-splade-form>
</x-tomato-admin-container>

