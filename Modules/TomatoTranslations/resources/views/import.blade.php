<x-tomato-admin-container :label="__('Import Translations')">
    <x-splade-form class="flex flex-col gap-4" action="{{route('admin.translations.import')}}" method="post">

        <x-splade-file class="w-full" name="excel"  placeholder="{{__('Upload Or Drop your excel file here')}}"  filepond/>

        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit label="{{__('Import')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" type="button" :label="__('Cancel')"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
