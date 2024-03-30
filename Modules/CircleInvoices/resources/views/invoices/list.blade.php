@if($table->resource->count() > 0)
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
        @if(!request()->has('page') || (request()->has('page') && request()->get('page') == 1))
            <div class=" flex flex-col gap-4 justify-center items-center h-full">
                <x-splade-link :href="route('profile.invoices.create')" class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full h-full">
                    <div class="my-4">
                        <i class="bx bxs-receipt text-7xl text-zinc-500"></i>
                        <h1>{{__('Add Invoice')}}</h1>
                    </div>
                </x-splade-link>
            </div>
        @endif

        @foreach($table->resource as $itemKey => $item)
            @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
            <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64">
                <div class="flex flex-col items-center justify-center">
                    <button class="my-4" @click.prevent="table.setSelectedItem(@js($itemPrimaryKey), table.itemIsSelected(@js($itemPrimaryKey)) ? false : true)">
                        @if($item->getMedia('logo')->first())
                            <div class="w-24 h-24 rounded-full bg-zinc-800 border " :class="{'border-success-500': table.itemIsSelected(@js($itemPrimaryKey)), 'border-zinc-700' : !table.itemIsSelected(@js($itemPrimaryKey))}">
                                <img src="{{$item->getMedia('logo')->first()->getUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                            </div>
                        @else
                            <div class="w-24 h-24 rounded-full bg-zinc-800 border " :class="{'border-success-500': table.itemIsSelected(@js($itemPrimaryKey)), 'border-zinc-700' : !table.itemIsSelected(@js($itemPrimaryKey))}">
                                <div class="flex flex-col justify-center items-center text-center h-full">
                                    <i class="bx bxs-receipt text-5xl text-zinc-500"></i>
                                </div>
                            </div>
                        @endif
                    </button>
                    <x-splade-link href="{{ route('profile.invoices.show', $item) }}" class="flex justify-center gap-2 font-bold w-full">
                        <h1 class="text-xl truncate">{{ $item->uuid }}</h1>
                        @if($item->status === 'pending')
                            <div class="flex flex-col justify-center items-center mt-1">
                                <x-tomato-admin-tooltip :text="__('Pending')">
                                    <div  class="text-warning-400">
                                        <i class="bx bx-pause-circle text-xl" ></i>
                                    </div>
                                </x-tomato-admin-tooltip>
                            </div>
                        @elseif($item->status === 'active')
                            <div class="flex flex-col justify-center items-center mt-1">
                                <x-tomato-admin-tooltip :text="__('Active')">
                                    <div  class="text-primary-600">
                                        <i class="bx bxs-rocket text-xl" ></i>
                                    </div>
                                </x-tomato-admin-tooltip>
                            </div>
                        @elseif($item->status === 'paid')
                            <div class="flex flex-col justify-center items-center mt-1">
                                <x-tomato-admin-tooltip :text="__('Paid')">
                                    <div  class="text-success-600">
                                        <i class="bx bxs-check-circle text-xl" ></i>
                                    </div>
                                </x-tomato-admin-tooltip>
                            </div>
                        @endif
                    </x-splade-link>
                    <h6 class="text-xl font-bold text-zinc-300 my-2">{{($item->total+$item->shipping)}}<small class="text-sm font-medium">{{ $item->currency }}</small></h6>
                    <div class="my-4 flex justify-center gap-2">
                        @if($item->is_public)
                            <x-tomato-admin-copy text="{{route('invoices.public.show', $item->uuid)}}">
                                <x-tomato-admin-tooltip :text="__('Copy Share Link')">
                                    <i class="bx bx-copy bx-sm text-indigo-500"></i>
                                </x-tomato-admin-tooltip>
                            </x-tomato-admin-copy>
                        @endif
                        <x-splade-link href="{{route('profile.invoices.print', $item)}}">
                            <x-tomato-admin-tooltip :text="__('Print')">
                                <i class="bx bx-printer bx-sm text-primary-400"></i>
                            </x-tomato-admin-tooltip>
                        </x-splade-link>
                        <x-splade-link href="{{route('profile.invoices.edit', $item)}}">
                            <x-tomato-admin-tooltip :text="__('Edit')">
                                <i class="bx bx-edit bx-sm text-warning-400"></i>
                            </x-tomato-admin-tooltip>
                        </x-splade-link>
                        <x-splade-link href="{{route('profile.invoices.destroy', $item)}}" method="DELETE" danger confirm-danger>
                            <x-tomato-admin-tooltip :text="__('Delete')" >
                                <i class="bx bx-trash bx-sm  text-danger-500"></i>
                            </x-tomato-admin-tooltip>
                        </x-splade-link>
                    </div>
                    <h6 class="my-2 text-sm text-zinc-300">
                        {{__('Created')}} {{ $item->created_at->diffForHumans() }}
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0 mt-6 mb-8 rounded-lg shadow-sm flex justify-center overflow-hidden">
        <div class="p-8 md:p-16 text-center">
            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
            <h1>{{__("You don't have any invoice please add one")}}</h1>
            <div class="my-4">
                <x-circle-xo-button :href="route('profile.invoices.create')" size="sm">
                    {{__('Create Invoice')}}
                </x-circle-xo-button>
            </div>
        </div>
    </div>
@endif
