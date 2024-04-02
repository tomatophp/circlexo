@extends('circle-xo::layouts.app')

@section('title', __('New Doc'))

@section('content')
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.docs.store')}}" method="post">

        <x-splade-file filepond preview :label="__('Icon')" name="icon" />
        <x-splade-file filepond preview :label="__('Cover')" name="cover" />
        <x-splade-input :label="__('Name')" name="name" type="text"  :placeholder="__('Name')" />
        <x-splade-input :label="__('Package')" name="package" type="text"  :placeholder="__('Package')" />
        <x-splade-textarea :label="__('About')" name="about" :placeholder="__('About')" autosize />
        <x-splade-input :label="__('Repository')" name="repository" type="text"  :placeholder="__('Repository')" />
        <x-splade-input :label="__('Branch')" name="branch" type="text"  :placeholder="__('Branch')" />
        <x-tomato-markdown-editor :label="__('README')" name="readme" :placeholder="__('README')" />
        <x-splade-checkbox :label="__('Is public')" name="is_public" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('profile.docs.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
@endsection
