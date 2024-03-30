@extends('circle-xo::layouts.app')

@section('title', __('Submit a new Circle App'))
@section('content')
    <x-splade-form :default="['is_free' => true]" class="grid grid-cols-2 gap-4" action="{{route('apps.store')}}" method="post">
        <x-splade-file class="col-span-2" filepond preview :label="__('Module Zip File')" name="module" />
        <x-splade-select class="col-span-2" :label="__('Categories')" :placeholder="__('Categories')" name="categories" multiple choices>
            @php $categories = \Modules\TomatoCategory\App\Models\Category::where('for', 'apps')->get(); @endphp
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </x-splade-select>
        <x-splade-file class="col-span-2" filepond preview  :label="__('Logo')" name="logo" />
        <x-splade-file class="col-span-2" filepond preview  :label="__('Cover')" name="cover" />
        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Description')" name="description" type="text"  :placeholder="__('Description')" />
        <x-splade-input :label="__('Key')" name="key" type="text"  :placeholder="__('Key')" />
        <div class="col-span-2">
            <x-tomato-markdown-editor :label="__('Readme')" name="readme" :placeholder="__('Readme')" />
        </div>

        <x-splade-input :label="__('Homepage')" name="homepage" type="text"  :placeholder="__('Homepage')" />
        <x-splade-input :label="__('Email')" name="email" type="email"  :placeholder="__('Email')" />
        <x-splade-input :label="__('Docs')" name="docs" type="text"  :placeholder="__('Docs')" />
        <x-splade-input :label="__('Github')" name="github" type="text"  :placeholder="__('Github')" />
        <x-splade-input :label="__('Privacy')" name="privacy" type="text"  :placeholder="__('Privacy')" />
        <x-splade-input :label="__('Faq')" name="faq" type="text"  :placeholder="__('Faq')" />
        <x-splade-select class="col-span-2" :label="__('App Required Other Apps?')" :placeholder="__('App Required Other Apps?')" name="required" multiple choices>
            @php $apps = \Modules\CircleApps\App\Models\App::where('is_active', true)->get(); @endphp
            @foreach($apps as $app)
                <option value="{{$app->id}}">{{$app->name}}</option>
            @endforeach
        </x-splade-select>

        <div class="flex justify-start gap-2 pt-3 col-span-2">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.apps.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
@endsection
