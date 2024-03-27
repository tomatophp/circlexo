<x-tomato-admin-container :label="__('Show Form').' #'. $model->id">
    <x-slot:buttons>
        <x-tomato-admin-button type="link" href="{{route('admin.forms.build', $model->id)}}">
            <x-heroicon-s-home-modern class="h-4 w-4"/>
            {{__('Build')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button type="link" href="{{route('admin.forms.index')}}">
            <x-heroicon-s-arrow-left class="w-4 h-4" />
            {{__('Back')}}
        </x-tomato-admin-button>
    </x-slot:buttons>
    <div class="mb-4">
        <h1 class="text-lg font-bold">{{$model->title}}</h1>
        <p class="text-sm text-gray-600">{{$model->description}}</p>
    </div>
    <x-tomato-form :form="$model" :default="['form_id'=>$model->id]" :action="route('admin.form-requests.store')"></x-tomato-form>
</x-tomato-admin-container>
