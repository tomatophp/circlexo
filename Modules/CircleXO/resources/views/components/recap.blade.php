<Recap
    {{ $attributes->only(['v-if', 'v-show', 'class', 'v-model', 'v-bind:hasError'])->class(['hidden' => $isHidden()]) }}
    v-model="{{ $vueModel() }}"
    siteKey="6LfudzMnAAAAAPyF1Z1wXFBEve9KqZE8ykJEZNsR"
>
</Recap>
