@extends('circle-xo::layouts.app')

@section('title', __('Notification'))

@section('content')
    @if(count($notifications))
        <div class="flex flex-col gap-2">
            <div class="filament-modal-content">
                <div class="flex flex-col gap-4">
                    @foreach($notifications as $notification)
                        <div>
                            <div class="flex flex-col gap-4 rounded-lg @if(!$notification->isRead()) bg-zinc-200 dark:bg-zinc-700 @else bg-zinc-50 dark:bg-zinc-900 @endif  px-4 py-4">
                                <div
                                    class="filament-notifications-notification pointer-events-auto invisible flex gap-3 w-full transition duration-300"
                                    style="display: flex; visibility: visible;">

                                    @if($notification->image)
                                        <div class="flex flex-col items-center justify-center">
                                            <div style="background-image: url('{{$notification->image}}')" class="rounded-lg h-16 w-16 bg-center bg-cover">

                                            </div>
                                        </div>
                                    @else
                                        <x-heroicon-s-bell class="filament-notifications-icon h-6 w-6 text-zinc-400"/>
                                    @endif

                                    <x-splade-link modal href="{{route('profile.notifications.show', $notification->id)}}" class="grid flex-1">
                                        <div class="filament-notifications-title flex h-6 items-center text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                            <p>{{$notification->title}}</p>
                                        </div>

                                        <p class="filament-notifications-date text-xs text-zinc-500 dark:text-zinc-300">
                                            {{$notification->created_at->diffForHumans()}}
                                        </p>

                                        <div class="filament-notifications-body mt-1 text-sm text-zinc-500 dark:text-zinc-300">
                                            <p><strong>{{str()->limit($notification->description, 50, '...')}}</strong></p>
                                        </div>
                                    </x-splade-link>

                                    <x-splade-link method="delete" :href="route('profile.notifications.destroy', $notification->id)" confirm>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="filament-notifications-close-button h-4 w-4 cursor-pointer text-zinc-400">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </x-splade-link>
                                    @if(!$notification->isRead())
                                        <x-splade-link method="post" :href="route('profile.notifications.read.selected', $notification->id)" confirm>
                                            <x-heroicon-s-check-circle class="filament-notifications-close-button h-4 w-4 cursor-pointer text-success-500"/>
                                        </x-splade-link>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="my-4">
                    {!! $notifications->links('tomato-admin::components.pagination') !!}
                </div>
                <div class="my-4 border border-zinc-200 dark:border-zinc-700"></div>
                <div class="flex justify-start gap-2">
                    <x-tomato-admin-button
                        danger
                        confirm
                        method="delete"
                        :href="route('profile.notifications.clear')"
                        type="link">

                        <div class="text-md flex justify-start gap-2">
                            <div class="flex flex-col items-center justify-center">
                                <i class="bx bx-trash"></i>
                            </div>
                            <div>
                                {{__('Clear Notifications')}}
                            </div>
                        </div>
                    </x-tomato-admin-button>

                    <x-tomato-admin-button
                        warning
                        confirm
                        method="post"
                        :href="route('profile.notifications.read')"
                        type="link">

                        <div class="text-md flex justify-start gap-2">
                            <div class="flex flex-col items-center justify-center">
                                <i class="bx bx-show"></i>
                            </div>
                            <div>
                                {{__('Make All As Read')}}
                            </div>
                        </div>
                    </x-tomato-admin-button>
                </div>
            </div>

        </div>
    @else
        <div class="space-y-2" >
            <div class="filament-modal-content space-y-2">

                <div class="px-4 py-2 space-y-4">
                    <div class="flex flex-col items-center justify-center mx-auto my-6 space-y-4 text-center bg-white dark:bg-zinc-800">
                        <div class="flex items-center justify-center w-12 h-12 text-primary-500 rounded-full bg-primary-50 dark:bg-zinc-700">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>    </div>

                        <div class="max-w-md space-y-1">
                            <h2 class="text-lg font-bold tracking-tight dark:text-white">
                                {{__('No notifications here')}}
                            </h2>

                            <p class="whitespace-normal text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                {{__('Please check again later')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
