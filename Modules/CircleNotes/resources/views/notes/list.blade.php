@if($table->resource->count() > 0)
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
        @if(!request()->has('page') || (request()->has('page') && request()->get('page') == 1))
            <div class="flex flex-col gap-4 justify-center items-center h-32">
                <x-splade-link modal :href="route('profile.notes.create')" class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full h-full">
                    <div class="my-4">
                        <i class="bx bxs-note text-7xl text-zinc-500"></i>
                        <h1>{{__('Add Note')}}</h1>
                    </div>
                </x-splade-link>
            </div>
        @endif
        @foreach($table->resource as $itemKey => $item)
            @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
            <div class="w-full h-32 flex flex-col justify-between bg-zinc-800 rounded-lg border border-zinc-700 mb-6 py-5 px-4 transition-all">
                <div>
                    <h4 class="text-zinc-100 font-bold text-2xl">{{ $item->title }}</h4>
                </div>
                <div>
                    <div class="flex items-center justify-between text-zinc-100">
                        <p class="text-sm">{{ $item->updated_at->diffForHumans() }}</p>
                        <div class="flex gap-3">
                            <x-splade-link href="{{route('profile.notes.show', $item)}}" class="w-8 h-8 rounded-full bg-zinc-700 hover:bg-zinc-600 text-zinc-100 flex items-center justify-center" aria-label="edit note" role="button">
                                <i class="bx bxs-show"></i>
                            </x-splade-link>
                            <x-splade-link modal href="{{route('profile.notes.edit', $item)}}" class="w-8 h-8 rounded-full bg-zinc-700 hover:bg-zinc-600 text-zinc-100 flex items-center justify-center" aria-label="edit note" role="button">
                                <i class="bx bx-edit-alt"></i>
                            </x-splade-link>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0 mt-6 mb-8 rounded-lg shadow-sm flex justify-center overflow-hidden">
        <div class="p-8 md:p-16 text-center">
            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
            <h1>{{__("You don't have any note please add one")}}</h1>
            <div class="my-4">
                <x-circle-xo-button modal :href="route('profile.notes.create')" size="sm">
                    {{__('Create Note')}}
                </x-circle-xo-button>
            </div>
        </div>
    </div>
@endif
