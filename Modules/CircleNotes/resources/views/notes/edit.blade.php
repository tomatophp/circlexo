@extends('circle-xo::layouts.app')

@section('title', __('Edit Note') .' #' . $model->id )

@section('content')
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.notes.update', $model->id)}}" method="post" :default="$model">
        <x-splade-input :label="__('Title')" name="title" type="text" :placeholder="__('Title')" />
        <x-tomato-markdown-editor name="content" :label="__('Content')" />
        <x-splade-checkbox name="is_public" :label="__('Is Public')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('profile.notes.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('profile.notes.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
@endsection
