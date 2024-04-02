@extends('circle-xo::layouts.app')

@section('title', __('New Note'))

@section('content')
    <x-splade-form :default="['is_public' => false]" class="flex flex-col space-y-4" action="{{ route('profile.notes.store') }}" method="post">
        <x-splade-input :label="__('Title')" name="title" type="text" :placeholder="__('Title')" />
        <x-tomato-markdown-editor name="content" :label="__('Content')" />
        <x-splade-checkbox name="is_public" :label="__('Is Public')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{ __('Save') }}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('profile.notes.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
@endsection
