@extends('circle-docs::layouts.doc')

@section('title', $model->name)
@section('icon')
    @if($model->getMedia('icon')->first())
        <img src="{{$model->getMedia('icon')->first()->getUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
    @else
        <i class="bx bxs-file-doc"></i>
    @endif
@endsection

@section('content')
    <x-tomato-markdown-viewer :content="$model->readme" />
@endsection
