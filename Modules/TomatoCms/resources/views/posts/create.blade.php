<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('Post')}}">


    <x-splade-form :default="['type'=> 'post', 'categories' => [], 'body' => ['ar' => '', 'en'=> '']]" action="{{route('admin.posts.store')}}" method="post" class="flex flex-col gap-4">

        <x-splade-file filepond preview name="feature" label="{{__('Featured Image')}}" />
        @if (config("tomato-category.features.category"))
            <x-splade-select label="{{__('Category')}}" multiple placeholder="Category" relation name="categories[]" :remote-url="route('admin.categories.api').'?for=content'" remote-root="data" option-label="name[{{\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')}}]" option-value="id" choices/>
        @endif

        @if (config("tomato-category.features.types"))
            <x-splade-select label="{{__('Type')}}" placeholder="Type" name="type" :remote-url="route('admin.types.api').'?for=content'" remote-root="data" option-label="name[{{\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')}}]" option-value="key" choices/>
        @endif

        <x-tomato-translation  label="{{__('Title')}}" @input="form.slug = form.title.en.replaceAll(' ', '-')" name="title" :placeholder="__('Title')" />

        <x-splade-input label="{{__('Slug')}}" name="slug" type="text"  placeholder="{{__('Slug')}}" />

        <x-tomato-translation type="markdown" label="{{__('Body')}}" name="body" :placeholder="__('Body')" />
        <x-tomato-translation textarea label="{{__('Short Description')}}" :placeholder="__('Short Description')"  name="short_description"/>
        <x-tomato-translation textarea  label="{{__('Keywords')}}" :placeholder="__('Keywords')"  name="keywords"/>

        <x-splade-checkbox label="{{__('Activated')}}" name="activated" />
        <x-splade-checkbox label="{{__('Trend')}}" name="trend"  />

        <div v-if="form.type === 'open-source'" class="flex flex-col space-y-4 mb-4">
            <x-splade-input label="{{__('GitHub Repo URL')}}" name="meta_url" type="text"  placeholder="Meta URL" />
            <x-splade-input label="{{__('On Click Redirect To')}}" name="meta_redirect" type="text"  placeholder="Meta Redirect" />
        </div>

        <div v-if="form.type === 'videos'" class="flex flex-col space-y-4 mb-4">
            <x-splade-input label="{{__('Youtube Video URL')}}" name="meta_url" type="text"  placeholder="Meta URL" />
            <x-splade-input label="{{__('On Click Redirect To')}}" name="meta_redirect" type="text"  placeholder="Meta Redirect" />
        </div>


        <x-tomato-admin-submit-buttons table="posts" save cancel />
    </x-splade-form>

</x-tomato-admin-container>
