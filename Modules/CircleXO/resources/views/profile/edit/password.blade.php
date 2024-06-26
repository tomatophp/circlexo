@extends('circle-xo::layouts.app')

@section('title', __('Update Password'))

@section('content')
    <x-splade-form class="flex flex-col gap-4" method="POST" action="{{route('profile.password.update')}}">
        <x-splade-input name="current_password" type="password" label="Current Password" />
        <x-splade-input name="password"  type="password" label="Password" />
        <x-splade-input name="password_confirmation" type="password" label="Password Confirmation" />

        <x-splade-submit spinner label="Update" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
@endsection
