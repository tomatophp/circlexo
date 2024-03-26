<SpladeToast v-bind:auto-dismiss="@json($autoDismiss)" #default="toast">
    <x-splade-component is="transition" appear show="toast.show">
        <x-splade-component is="transition" child after-leave="toast.emitDismiss">
            <div @class([
                'px-4 py-3 pointer-events-auto shadow-md min-w-[340px] border rounded-md shadow-sm bg-white dark:bg-zinc-900 dark:border-zinc-800 border-zinc-200'
                 ])>
                <div class="flex items-center justify-between gap-8">
                    <div class="flex items-center gap-2">
                        <div class="relative flex-shrink-0">
                            @if($isSuccess)
                                <x-heroicon-s-check-circle class="h-5 w-5 text-green-500" />
                            @elseif($isWarning)
                                <x-heroicon-s-information-circle class="h-5 w-5 text-warning-500" />
                            @elseif($isDanger)
                                <x-heroicon-s-x-circle class="h-5 w-5 text-danger-500" />
                            @elseif($isInfo)
                                <x-heroicon-s-information-circle class="h-5 w-5 text-primary-500" />
                            @endif
                        </div>
                        <div class="break-words flex flex-col gap-[6px] items-start">
                            <h3 @class([
                                'text-sm font-medium text-zinc-950 dark:text-white',
                            ])>
                                {!! nl2br(e($title ?: $message)) !!}
                            </h3>
                            @if($title && $message)
                                <div @class([
                                    'text-color_f6fff2b3 text-sm',
                                ])>
                                    <p>{!! nl2br(e($message)) !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="px-2">
                        <button type="button" @click.prevent="toast.setShow(false)"   class="flex flex-col justify-center items-center">
                            <span class="sr-only">Dismiss Toast</span>
                            <x-heroicon-s-x-mark class="w-5 h-5"/>
                        </button>
                    </div>
                </div>
            </div>
        </x-splade-component>
    </x-splade-component>
</SpladeToast>
