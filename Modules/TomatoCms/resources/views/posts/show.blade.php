<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{ __('Post') }} #{{$model->id}}">
    <div class="grid grid-cols-2 gap-4">
        <x-tomato-admin-row type="text" :label="__('Title')" :value="$model->title" />
        <x-tomato-admin-row type="text" :label="__('Slug')" :value="$model->slug" />
        <div class="col-span-2">
            <x-tomato-markdown-viewer :content="$model->body" />
        </div>
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Short Description')" :value="$model->short_description" />
        </div>
        <div class="col-span-2">
            <x-tomato-admin-row type="text" :label="__('Keywords')" :value="$model->keywords" />
        </div>
        <x-tomato-admin-row type="text" :label="__('Author')" :value="$model->author->name" />
        <x-tomato-admin-row type="text" :label="__('Type')" :value="$model->type" />
        <x-tomato-admin-row type="bool" :label="__('Activated')" :value="$model->activated" />
        <x-tomato-admin-row type="bool" :label="__('Trend')" :value="$model->trend" />
        <x-tomato-admin-row type="number" :label="__('Likes')" :value="$model->likes" />
        <x-tomato-admin-row type="number" :label="__('Views')" :value="$model->views" />
    </div>

    <x-tomato-admin-submit-buttons table="posts" :model="$model" edit delete cancel />

    @if (config("tomato-cms.features.comments"))
        <x-tomato-admin-relations-group :relations="['comments' => __('Comments')]">
            <x-tomato-admin-relations
                :table="\Modules\TomatoCms\App\Tables\CommentTable::class"
                :model="$model"
                name="comments"
                view="tomato-cms::comments.index"
            />
        </x-tomato-admin-relations-group>
    @endif

</x-tomato-admin-container>
