<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Page')}}">
    <x-splade-form class="flex flex-col gap-4" action="{{route('admin.pages.store')}}" method="post" :default="[
            'galary' => [],
            'title' => [
                'ar' => '',
                'en' => ''
            ],
            'short_description' => [
                'ar' => '',
                'en' => ''
            ],
            'keywords' => [
                'ar' => '',
                'en' => ''
            ],
            'body' => [
                'ar' => '',
                'en' => ''
            ]
        ]">
        <x-splade-file filepond preview name="cover" :label="__('Cover Image')" />
        <x-splade-file filepond preview multiple name="gallery" :label="__('Gallery Images')" />

        <x-tomato-translation :label="__('Title')" name="title" :placeholder="__('Title')" />
        <x-splade-input :label="__('Slug')" name="slug" type="text"  :placeholder="__('Slug')" />

        <x-tomato-translation type="markdown" :label="__('Body')" name="body" :placeholder="__('Body')" />

        <x-tomato-translation textarea :label="__('Short Description')" name="short_description" :placeholder="__('Short Description')" />

        <x-tomato-translation textarea :label="__('Keywords')" name="keywords" :placeholder="__('Keywords')" />

        <x-splade-checkbox :label="__('Is active')" name="is_active" />
        <x-splade-checkbox :label="__('Has view')" name="has_view" />
        <x-splade-input v-if="form.has_view" :label="__('View')" name="view" type="text"  :placeholder="__('View')" />
        <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" type='number' name="color" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.pages.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
