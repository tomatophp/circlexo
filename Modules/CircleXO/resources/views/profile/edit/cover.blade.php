@extends('circle-xo::layouts.app')

@section('title', __('Update Cover'))

@section('content')
    <x-splade-form :default="['cover' => auth('accounts')->user()->cover]" class="flex flex-col gap-4" method="POST" action="{{route('profile.media.update')}}">
        <x-splade-file preview filepond name="cover" label="Cover Image" />
        <x-splade-button label="Update" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
@endsection
