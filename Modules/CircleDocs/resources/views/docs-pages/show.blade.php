@extends('circle-docs::layouts.doc', ['model' => $model->doc])

@section('title', $model->doc->name)
@section('icon')
    @if($model->doc->getMedia('icon')->first())
        <img src="{{$model->doc->getMedia('icon')->first()->getUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
    @else
        <i class="bx bxs-file-doc"></i>
    @endif
@endsection

@section('content')
    @if($model->getMedia('cover')->first())
    <div>
        <img src="{{$model->getMedia('cover')->first()->getUrl() }}" class="w-full h-80 object-cover object-center border-b border-zinc-700" alt="cover">
    </div>
    @endif
    <x-tomato-markdown-viewer :content="$model->body" />

    <div class="flex justify-start gap-2 pt-3 mx-4 my-4">
        <x-tomato-admin-button warning :href="route('profile.docs-pages.edit', $model->id)" label="{{__('Edit')}}" />
        <x-tomato-admin-button danger :href="route('profile.docs-pages.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
    </div>
@endsection
