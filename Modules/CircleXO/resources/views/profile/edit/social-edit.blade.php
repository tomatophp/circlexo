@extends('circle-xo::layouts.app')

@section('title', __('Update Social Network'))

@section('content')
    <x-splade-form :default="$network" class="flex flex-col gap-4" method="POST" action="{{route('profile.social.update', $network['name'])}}">
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <x-circle-xo-social-item network="facebook" :label="__('Facebook')" />
            <x-circle-xo-social-item network="twitter" :label="__('Twitter')" />
            <x-circle-xo-social-item network="instagram" :label="__('Instagram')" />
            <x-circle-xo-social-item network="tiktok" :label="__('Tiktok')" />
            <x-circle-xo-social-item network="youtube" :label="__('Youtube')" />
            <x-circle-xo-social-item network="behance" :label="__('Behance')" />
            <x-circle-xo-social-item network="medium" :label="__('Medium')" />
            <x-circle-xo-social-item network="reddit" :label="__('Reddit')" />
            <x-circle-xo-social-item network="pinterest" :label="__('Pinterest')" />
            <x-circle-xo-social-item network="snapchat" :label="__('Snapchat')" />
            <x-circle-xo-social-item network="blogger" :label="__('Blogger')" />
            <x-circle-xo-social-item network="patreon" :label="__('Patreon')" />
            <x-circle-xo-social-item network="quora" :label="__('Quora')" />
            <x-circle-xo-social-item network="dribbble" :label="__('Dribbble')" />
            <x-circle-xo-social-item network="github" :label="__('GitHub')" />
            <x-circle-xo-social-item network="linkedin" :label="__('LinkedIn')" />
            <x-circle-xo-social-item network="telegram" :label="__('Telegram')" />
            <x-circle-xo-social-item network="twitch" :label="__('Twitch')" />
            <x-circle-xo-social-item network="discord" :label="__('Discord')" />
            <x-circle-xo-social-item network="figma" :label="__('Figma')" />
            <x-circle-xo-social-item network="whatsapp" :label="__('Whatsapp')" />
            <button @click.prevent="form.name = 'website'" :class="{'bg-main-600 text-zinc-600': form.name === 'website', 'bg-zinc-900 text-white': form.name !== 'website'}" class="flex justify-center text-center border-zinc-700  p-4 rounded-lg border shadow-sm">
                <div class="flex flex-col justify-center gap-2">
                    <i class="bx bx-link text-3xl"></i>
                    <h1 class="font-bold">{{__('Link')}}</h1>
                </div>
            </button>

        </div>

        <x-splade-input type="text" name="label" :label="__('Label')" />
        <x-splade-input type="text" name="link" :label="__('Link')" />

        <div class="flex justify-start gap-4">
            <x-splade-submit spinner :label="__('Save')" class="bg-main-600 border-main-400 text-zinc-900" />
            <x-tomato-admin-button method="DELETE" confirm-danger danger href="{{ route('profile.social.destroy', $network['name']) }}" :label="__('Remove')" />
        </div>
    </x-splade-form>
@endsection
