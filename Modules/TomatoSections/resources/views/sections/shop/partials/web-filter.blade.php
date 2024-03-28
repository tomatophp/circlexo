@php
    $loadKeys = [];
    $loadForm = [];
    foreach($options as $option){
        $loadKeys[$option->key] = false;
        if(request()->has($option->key)){
            $loadForm[$option->key] = request()->{$option->key};
        }
        else {
            $loadForm[$option->key] = [];
        }
    }

    $loadForm['categories'] = request()->categories ?? [];
@endphp

<x-splade-form  method="GET" :default="$loadForm" action="{{url()->current()}}" submit-on-change class="hidden lg:block">
    <h3 class="sr-only">{{__('Categories')}}</h3>
    <div role="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
        @foreach($categories as $category)
            <div class="flex items-center">
                <x-splade-checkbox name="categories[]" value="{{$category->id}}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="filter-color-0" class="ml-3 text-sm text-gray-600">{{$category->name}}</label>
            </div>
        @endforeach
    </div>

    <x-splade-data :default="$loadKeys" remember="filters" local-storage>
    @foreach($options as $option)
        <div class="border-b border-gray-200 py-6">
                <h3 class="-my-3 flow-root">
                    <!-- Expand/collapse section button -->
                    <button @click.prevent="data.{{$option->key}} = !data.{{$option->key}}" type="button" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500" aria-controls="filter-section-0" aria-expanded="false">
                        <span class="font-medium text-gray-900">{{$option->name}}</span>
                        <span class="ml-6 flex items-center">
                    <svg v-show="!data.{{$option->key}}" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    <svg v-show="data.{{$option->key}}" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" />
                    </svg>
                  </span>
                    </button>
                </h3>
                <!-- Filter section, show/hide based on section state. -->
                <div  v-show="data.{{$option->key}}" class="pt-6" id="filter-section-0">
                    @php $subOptions = \Modules\TomatoCategory\App\Models\Type::where('for', 'product-options')->where('type', $option->key)->get(); @endphp
                    <div class="space-y-4">
                        @foreach($subOptions as $item)
                            <div class="flex items-center">
                                <x-splade-checkbox name="{{$option->key}}[]" value="{{$item->key}}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                <label for="filter-color-0" class="ml-3 text-sm text-gray-600">{{$item->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    @endforeach

    </x-splade-data>
</x-splade-form>
