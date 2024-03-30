@extends('circle-contacts::layout.contact')

@section('content')


    <div class="my-4 flex flex-col justify-start gap-4 bg-zinc-900 rounded-lg border border-zinc-700 w-full overflow-hidden">
        <div class="bg-zinc-800 w-full p-4 border-b border-zinc-700">
            <h1>
                {{__('Show Contact')}} #{{$model->id}}
            </h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12">
            <div class="col-span-3 w-full h-full border-b lg:border-b-0 lg:border-r border-zinc-700 mb-4">
                <div class="flex flex-col justify-center items-center py-4">
                    <div class="my-4">
                        @if($model->getMedia('avatar')->first())
                            <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700">
                                <img src="{{ $model->getMedia('avatar')->first()->getUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                            </div>
                        @else
                            <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700" >
                                <div class="flex flex-col justify-center items-center text-center h-full">
                                    <i class="bx bxs-user text-5xl text-zinc-500"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <x-splade-link href="{{ route('profile.contacts.show', $model) }}" class="flex justify-center gap-2 font-bold w-full">
                        <h1 class="text-xl truncate">{{ $model->name }}</h1>
                        @if($model->groups)
                            @foreach($model->groups as $group)
                                <div class="flex flex-col justify-center items-center mt-1">
                                    <x-tomato-admin-tooltip :text="__($group->name)">
                                        <div  style="color: {{$model->color}} !important;">
                                            <i class="{{$group->icon ?: 'bx bxs-group'}} text-xl" ></i>
                                        </div>
                                    </x-tomato-admin-tooltip>
                                </div>
                            @endforeach
                        @endif
                    </x-splade-link>
                    <h6 class="text-sm font-medium text-zinc-300">{{$model->phone}}</h6>
                    @if($model->address)
                        <p class="text-xs text-center my-2 w-full truncate">
                            {{$model->address}}
                        </p>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4 col-span-1 lg:col-span-9">
                <div>
                    <h1 class="text-md font-bold text-zinc-300">{{__('Email')}}</h1>
                    <p class="text-sm text-zinc-300">
                        {{ $model->email }}
                    </p>
                </div>
                <div>
                    <h1 class="text-md font-bold text-zinc-300">{{__('Company')}}</h1>
                    <p class="text-sm text-zinc-300">
                        {{ $model->company }}
                    </p>
                </div>
                @foreach($model->contactMeta as $meta)
                    <div>
                        <div class="flex justify-start gap-2">
                            <h1 class="text-md font-bold text-zinc-300">{{str($meta->key)->title()}}</h1>
                            <x-splade-link modal :href="route('profile.contacts.meta.edit',[$model, $meta])">
                                <i class="bx bx-edit text-warning-400"></i>
                            </x-splade-link>
                            <x-splade-link confirm-danger method="DELETE" :href="route('profile.contacts.meta.destroy', [$model, $meta])">
                                <i class="bx bx-trash text-danger-500"></i>
                            </x-splade-link>
                        </div>
                        <p class="text-sm text-zinc-300">
                            {{ $meta->value }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-start gap-2  p-4 border-t border-zinc-700">
            <x-tomato-admin-button modal :href="route('profile.contacts.meta.create', $model)" :label="__('Add More Details')" />
            <x-tomato-admin-button danger :href="route('profile.contacts.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
        </div>
    </div>
@endsection
