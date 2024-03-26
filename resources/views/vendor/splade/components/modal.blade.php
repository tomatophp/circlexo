<x-splade-component is="modal-wrapper" :base-attributes="$attributes->except('class')" :key="$modalKey" :close-button="$closeButton" :close-explicitly="$closeExplicitly" :name="$name">
    <!-- Full-screen scrollable container -->
    <div class="fixed inset-0 z-40 overflow-y-auto p-4">
        <!-- Container to center the panel -->
        <div class="flex min-h-full justify-center" v-bind:class="{
            'items-start': modal.position === 'top',
            'items-center': !modal.position || modal.position === 'center',
            'items-end': modal.position === 'bottom'
        }">
            <!-- The actual dialog panel -->
            <x-splade-component is="transition" child animation="fade" after-leave="modal.emitClose" v-bind:class="{
                'transition w-full': true,
                'blur-sm': !modal.onTopOfStack,
                'sm:max-w-sm': modal.maxWidth == 'sm',
                'sm:max-w-md': modal.maxWidth == 'md',
                'sm:max-w-md md:max-w-lg': modal.maxWidth == 'lg',
                'sm:max-w-md md:max-w-xl': modal.maxWidth == 'xl',
                'sm:max-w-md md:max-w-xl lg:max-w-2xl': modal.maxWidth == '2xl',
                'sm:max-w-md md:max-w-xl lg:max-w-3xl': modal.maxWidth == '3xl',
                'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-4xl': modal.maxWidth == '4xl',
                'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl': modal.maxWidth == '5xl',
                'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-6xl': modal.maxWidth == '6xl',
                'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-7xl': modal.maxWidth == '7xl'
            }">
                <x-splade-component is="dialog" panel dusk="modal-dialog">
                    <div {{ $attributes->class('bg-white dark:bg-zinc-800 rounded-xl relative') }}>
                        <div class="flex justify-between border-b border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 py-4 px-6 rounded-t-xl">
                            <div class="flex flex-col items-center justifiy-center fi-modal-heading text-base font-semibold leading-6 text-zinc-950 dark:text-white">
                                {{$title??null}}
                            </div>
                            <div v-if="modal.closeButton" class="flex flex-col items-center justifiy-center">
                                <button dusk="close-modal-button" @click="modal.close" type="button" class="text-zinc-400 hover:text-zinc-500">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </x-splade-component>
            </x-splade-component>
        </div>
    </div>
</x-splade-component>
