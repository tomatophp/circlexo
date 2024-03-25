<x-splade-modal>
    <x-slot:title>
        {{__('Show Notification')}}
    </x-slot:title>

    <a href="{{$model->url}}" target="_blank">
        <div class="flex flex-col gap-4 rounded-lg @if(!$model->isRead()) bg-gray-200 dark:bg-gray-700 @else bg-gray-50 dark:bg-gray-900 @endif  px-4 py-4">
            <div
                class="filament-notifications-notification pointer-events-auto invisible flex gap-3 w-full transition duration-300"
                style="display: flex; visibility: visible;">

                @if($model->image)
                    <div class="flex flex-col items-center justify-center">
                        <div style="background-image: url('{{$model->image}}')" class="rounded-lg h-16 w-16 bg-center bg-cover">

                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center">
                        <x-heroicon-s-bell-alert class="w-8 h-8 text-primary-500" />
                    </div>
                @endif

                <div class="grid flex-1">
                    <div class="filament-notifications-title flex h-6 items-center text-sm font-medium text-gray-900 dark:text-gray-100">
                        <p>{{$model->title}}</p>
                    </div>

                    <p class="filament-notifications-date text-xs text-gray-500 dark:text-gray-300">
                        {{$model->created_at->diffForHumans()}}
                    </p>

                    <div class="filament-notifications-body mt-1 text-sm text-gray-500 dark:text-gray-300">
                        <p><strong>{{$model->description}}</strong></p>
                    </div>
                </div>

                <x-splade-link method="delete" :href="route('profile.notifications.destroy', $model->id)" confirm>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="filament-notifications-close-button h-4 w-4 cursor-pointer text-gray-400">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </x-splade-link>
            </div>
        </div>
    </a>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button secondary type="button" @click.prevent="modal.close" label="{{__('Cancel')}}"/>
    </div>
</x-splade-modal>
