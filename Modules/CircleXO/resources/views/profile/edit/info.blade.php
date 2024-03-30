@extends('circle-xo::layouts.app')

@section('title', __('Update Info'))

@section('content')
    <x-splade-form :default="[
        'name' => auth('accounts')->user()->name,
        'email' => auth('accounts')->user()->email,
        'bio' => auth('accounts')->user()->meta('bio'),
        'address' => auth('accounts')->user()->address,
        'username' => str(auth('accounts')->user()->username)->replaceFirst('@', ''),
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.info.update')}}">
        <x-splade-input name="name" label="Name" />
        <x-splade-input name="email" type="email" label="email" />
        <x-splade-input name="address" label="location" />
        <x-splade-input name="username" label="username" />
        <x-splade-textarea autosize name="bio" label="Bio" />

        <x-splade-submit spinner label="Update" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
@endsection
