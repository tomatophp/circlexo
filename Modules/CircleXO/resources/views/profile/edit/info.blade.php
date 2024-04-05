@extends('circle-xo::layouts.app')

@section('title', __('Update Info'))

@section('content')
    <x-splade-form :default="[
        'name' => auth('accounts')->user()->name,
//        'lang' => auth('accounts')->user()->meta('lang') ?? app()->getLocale(),
        'email' => auth('accounts')->user()->email,
        'bio' => auth('accounts')->user()->meta('bio'),
        'address' => auth('accounts')->user()->address,
        'username' => str(auth('accounts')->user()->username)->replaceFirst('@', ''),
    ]" class="flex flex-col gap-4" method="POST" action="{{route('profile.info.update')}}">
        <x-splade-input name="name" :label="__('Name')" />
        <x-splade-input name="email" type="email" :label="__('Email')" />
        <x-splade-input name="address" :label="__('Location')" />
        <x-splade-input name="username" :label="__('Username')" />
{{--        <x-splade-select choices name="lang" :label="__('Language')" >--}}
{{--            @foreach(config('tomato-admin.langs') as $locale)--}}
{{--                <option value="{{$locale['key']}}" @if(auth('accounts')->user()->meta('lang') == $locale['key']) selected @endif>--}}
{{--                    {{$locale['label'][app()->getLocale()]}}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </x-splade-select>--}}
        <x-splade-textarea autosize name="bio" :label="__('Bio')" />

        <x-splade-submit spinner label="Update" class="bg-main-600 border-main-400 text-zinc-900" />
    </x-splade-form>
@endsection
