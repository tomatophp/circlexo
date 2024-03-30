@if($table->resource->count() > 0)
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
        @if(!request()->has('page') || (request()->has('page') && request()->get('page') == 1))
            <div class=" flex flex-col gap-4 justify-center items-center h-full">
                <x-splade-link :href="route('profile.contacts.create')" modal class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full h-full">
                    <div class="my-4">
                        <i class="bx bxs-user text-7xl text-zinc-500"></i>
                        <h1>{{__('Add Contact')}}</h1>
                    </div>
                </x-splade-link>
                @if(request()->has('group_id'))
                    <div class="flex justify-between gap-4 w-full">
                        <x-splade-link :href="route('profile.groups.create')" modal class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full h-full">
                            <div class="my-4">
                                <i class="bx bxs-group text-7xl text-zinc-500"></i>
                                <h1>{{__('Add Group')}}</h1>
                            </div>
                        </x-splade-link>
                        <div class="h-full flex flex-col gap-4 w-full">
                            <x-splade-link :href="route('profile.groups.edit', request()->get('group_id'))" modal class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full ">
                                <div class="my-4">
                                    <i class="bx bxs-edit text-5xl text-warning-500"></i>
                                    <h1>{{__('Edit Group')}}</h1>
                                </div>
                            </x-splade-link>
                            <x-splade-link :href="route('profile.groups.destroy', request()->get('group_id'))" confirm-danger method="DELETE" class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full">
                                <div class="my-4">
                                    <i class="bx bxs-trash text-5xl text-danger-500"></i>
                                    <h1>{{__('Delete Group')}}</h1>
                                </div>
                            </x-splade-link>
                        </div>
                    </div>
                @else
                    <x-splade-link :href="route('profile.groups.create')" modal class="flex flex-col justify-center items-center text-center border border-zinc-700 rounded-lg w-full h-full">
                        <div class="my-4">
                            <i class="bx bxs-group text-7xl text-zinc-500"></i>
                            <h1>{{__('Add Group')}}</h1>
                        </div>
                    </x-splade-link>
                @endif
            </div>
        @endif

        @foreach($table->resource as $itemKey => $item)
            @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
                <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64">
                    <div class="flex flex-col items-center justify-center">
                        <button class="my-4" @click.prevent="table.setSelectedItem(@js($itemPrimaryKey), table.itemIsSelected(@js($itemPrimaryKey)) ? false : true)">
                            @if($item->getMedia('avatar')->first())
                                <div class="w-24 h-24 rounded-full bg-zinc-800 border " :class="{'border-success-500': table.itemIsSelected(@js($itemPrimaryKey)), 'border-zinc-700' : !table.itemIsSelected(@js($itemPrimaryKey))}">
                                    <img src="{{ $item->getMedia('avatar')->first()->getUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-full bg-zinc-800 border " :class="{'border-success-500': table.itemIsSelected(@js($itemPrimaryKey)), 'border-zinc-700' : !table.itemIsSelected(@js($itemPrimaryKey))}">
                                    <div class="flex flex-col justify-center items-center text-center h-full">
                                        <i class="bx bxs-user text-5xl text-zinc-500"></i>
                                    </div>
                                </div>
                            @endif
                        </button>
                        <x-splade-link href="{{ route('profile.contacts.show', $item) }}" class="flex justify-center gap-2 font-bold w-full">
                            <h1 class="text-xl truncate">{{ $item->name }}</h1>
                            @if($item->groups)
                                @foreach($item->groups as $group)
                                    <div class="flex flex-col justify-center items-center mt-1">
                                        <x-tomato-admin-tooltip :text="__($group->name)">
                                            <div  style="color: {{$item->color}} !important;">
                                                <i class="{{$group->icon ?: 'bx bxs-group'}} text-xl" ></i>
                                            </div>
                                        </x-tomato-admin-tooltip>
                                    </div>
                                @endforeach
                            @endif
                        </x-splade-link>
                        <h6 class="text-sm font-medium text-zinc-300">{{$item->phone}}</h6>
                        @if($item->address)
                            <p class="text-xs text-center my-2 w-full truncate">
                                {{$item->address}}
                            </p>
                        @endif
                        <div class="my-4 flex justify-center gap-2">
                            <x-splade-link modal href="{{route('profile.contacts.edit', $item)}}">
                                <x-tomato-admin-tooltip :text="__('Edit')">
                                    <i class="bx bx-edit bx-sm text-warning-400"></i>
                                </x-tomato-admin-tooltip>
                            </x-splade-link>
                            <x-splade-link href="{{route('profile.contacts.destroy', $item)}}" method="DELETE" danger confirm-danger>
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
    <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0 mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
        <div class="p-8 md:p-16 text-center">
            <i class="bx bx-x-circle bx-lg text-danger-500"></i>
            <h1>{{__("You don't have any contact please add one")}}</h1>
            <div class="my-4">
                <x-circle-xo-button :href="route('profile.contacts.create')" modal size="sm">
                    {{__('Create Contact')}}
                </x-circle-xo-button>
            </div>
        </div>
    </div>
@endif
