<div class="flex flex-col gap-4">
    <x-splade-input class="w-full" label="{{__('Title')}}" name="title" placeholder="{{__('Title')}}" />
    <x-splade-textarea label="{{__('Subtitle')}}" name="subtitle" placeholder="{{__('Subtitle')}}" />
    <x-tomato-admin-color label="{{__('Background Color')}}" name="bg_color" placeholder="{{__('Background Color')}}" />
    <x-tomato-admin-color label="{{__('Font Color')}}" name="font_color" placeholder="{{__('Font Color')}}" />
    <x-splade-select
        choices
        label="{{__('Features')}}"
        name="features"
        :options="\Modules\TomatoThemes\App\Models\Feature::all()"
        option-label="title"
        option-value="id"
        multiple
    />
</div>
