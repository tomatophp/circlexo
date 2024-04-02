
@extends('circle-xo::layouts.app')

@section('title', $model->title)

@section('content')
    <x-tomato-markdown-viewer style="background-color: rgb(39 39 42 / var(--tw-bg-opacity)) !important;" :content="$model->content" />

    <div class="flex justify-start gap-3 border-t border-zinc-700 pt-4">
        <x-tomato-admin-button danger :href="route('profile.notes.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button warning :href="route('profile.notes.edit', $model)" label="{{__('Edit')}}"/>
        <x-tomato-admin-button secondary :href="route('profile.notes.index')" label="{{__('Cancel')}}"/>

        @if($model->is_public)
            <button class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent">
                <x-tomato-admin-copy :text="route('profile.note.share', ['username' => auth('accounts')->user()->username, 'slug' => $model->slug])" class="text-zinc-100">
                    <i class="bx bx-copy"></i>
                    {{ __('Share Public URL') }}
                </x-tomato-admin-copy>
            </button>
        @endif

        @php
            $oneTimeLinks = Modules\CircleNotes\App\Models\CircleXoNoteLink::where('note_id', $model->id)->get();
        @endphp
        @foreach ($oneTimeLinks as $link)
            <button class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent">
                <x-tomato-admin-copy :text="route('profile.note.share-one-time-link', ['username' => auth('accounts')->user()->username, 'token' => $link->token])" class="text-zinc-100">
                    <i class="bx bx-copy"></i>
                    {{__('Share One Time Link')}}
                </x-tomato-admin-copy>
            </button>
        @endforeach

        <x-splade-form preserve-scroll class="flex flex-col space-y-4" action="{{ route('profile.notes.generate-one-time-link', $model) }}" method="post">
            <x-tomato-admin-submit label="{{ __('Generate one time link') }}" :spinner="true" />
        </x-splade-form>
    </div>
@endsection
