<SpladeInput
    {{ $attributes->only(['v-if', 'v-show', 'v-for', 'class'])->class(['hidden' => $isHidden()]) }}
    :flatpickr="@js($flatpickrOptions())"
    :js-flatpickr-options="{!! $jsFlatpickrOptions !!}"
    v-model="{{ $vueModel() }}"
    #default="inputScope"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <div class="flex rounded-lg border border-zinc-200 dark:border-zinc-700 shadow-sm dark:text-white ">
            @if($prepend)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnablePrepend) }" class="inline-flex items-center px-3 ltr:rounded-l-md rtl:rounded-r-md border-t-0 border-b-0 border-l-0 border-zinc-300 bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-200 text-zinc-50 dark:text-white">
                    {!! $prepend !!}
                </span>
            @endif

            <input {{ $attributes->except(['v-if', 'v-show', 'v-for', 'class'])->class([
                'fi-input block w-full border-none bg-white dark:bg-zinc-800 py-1.5 text-base text-zinc-950 outline-none transition duration-75' => true,
                'placeholder:text-zinc-400  disabled:text-zinc-500 disabled:[-webkit-text-fill-color:theme(colors.zinc.500)]',
                'disabled:placeholder:[-webkit-text-fill-color:theme(colors.zinc.400)] dark:text-white dark:placeholder:text-zinc-500',
                'dark:disabled:text-zinc-400 dark:disabled:[-webkit-text-fill-color:theme(colors.zinc.400)]',
                'dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.zinc.500)] sm:text-sm sm:leading-6 ps-3 pe-3',
                'focus:ring-2 ring-primary-500 focus:ring-2 focus:ring-primary-500',
                'rounded-lg' => !$append && !$prepend,
                'min-w-0 flex-1 rounded-none' => $append || $prepend,
                'ltr:rounded-l-lg rtl:rounded-r-lg' => $append && !$prepend,
                'ltr:rounded-r-lg rtl:rounded-l-lg' => !$append && $prepend,
            ])->merge([
                'name' => $name,
                'type' => $type,
                'v-model' => $flatpickrOptions() ? null : $vueModel(),
                'data-validation-key' => $validationKey(),
            ])  }}
            />

            @if($append)
                <span :class="{ 'opacity-50': inputScope.disabled && @json(!$alwaysEnableAppend) }" class="inline-flex items-center px-3 ltr:rounded-r-md rtl:rounded-l-md border-t-0 border-b-0 border-r-0 border-zinc-300 bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-200 text-zinc-500 dark:text-white">
                    {!! $append !!}
                </span>
            @endif
        </div>
    </label>

    @include('splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeInput>
