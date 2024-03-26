<SpladeTextarea
    {{ $attributes->only(['v-if', 'v-show', 'class']) }}
    :autosize="@js($attributes->has('autosize') ? (bool) $attributes->get('autosize') : $defaultAutosizeValue)"
    v-model="{{ $vueModel() }}"
>
    <label class="block">
        @includeWhen($label, 'splade::form.label', ['label' => $label])

        <div class="flex rounded-lg border border-zinc-200 dark:border-zinc-700 shadow-sm dark:text-white" >
            <textarea {{ $attributes->except(['v-if', 'v-show', 'class', 'autosize'])->class([
                'fi-input block w-full border-none bg-transparent py-1.5 text-base text-zinc-950 outline-none transition duration-75' => true,
                'fi-input block w-full border-none bg-transparent py-1.5 text-base text-zinc-950 outline-none transition duration-75' => true,
                'placeholder:text-zinc-400  disabled:text-zinc-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)]',
                'disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-zinc-500',
                'dark:disabled:text-zinc-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)]',
                'dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3',
                'focus:ring-2 ring-primary-500 focus:ring-2 focus:ring-primary-500 rounded-lg',
             ])->merge([
            'name' => $name,
            'v-model' => $vueModel(),
            'data-validation-key' => $validationKey(),
        ]) }}
        ></textarea>
        </div>
    </label>

    @includeWhen($help, 'splade::form.help', ['help' => $help])
    @includeWhen($showErrors, 'splade::form.error', ['name' => $validationKey()])
</SpladeTextarea>
