<x-tomato-admin-container label="{{__('Import Accounts')}}">
    <x-splade-form :default="['type_id' => $types[0]->id]" confirm class="flex flex-col gap-4" action="{{route('admin.accounts.import.store')}}" method="post">
        <a class="text-primary-500 underline" href="https://docs.google.com/spreadsheets/d/1Q5MUuYL2lP3pBtuPBC9xt5JTp-hi8wh9478RgTD4jxE/edit?usp=sharing" target="_blank">
            {{__('Please Check This XLSX file before create new one')}}
        </a>
        <x-splade-file filepond name="file" label="{{__('Please add your XLSX file')}}" />

        <x-splade-select  label="{{__('Account Type')}}" placeholder="{{__('Account Type')}}" name="type" choices>
            @foreach($types as $type)
                <option value="{{$type->key}}">{{$type->name}}</option>
            @endforeach
        </x-splade-select>

        @if(config('tomato-crm.features.groups'))
            <x-splade-select choices multiple :options="$groups" option-value="id" option-label="name"  label="{{__('Groups')}}" name="groups" placeholder="{{__('Groups')}}" autosize />
        @endif


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button type="button" secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
