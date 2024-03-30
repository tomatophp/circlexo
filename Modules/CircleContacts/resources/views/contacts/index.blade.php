@extends('circle-contacts::layout.contact')

@section('content')
    @if(\Modules\CircleContacts\App\Models\CircleXoContactsGroup::query()->count() < 0)
        <div class="bg-zinc-800 border border-zinc-700 mx-8 md:mx-0 mt-6 mb-8 rounded-lg shadow-sm flex justify-center">
            <div class="p-8 md:p-16 text-center">
                <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                <h1>{{__("You don't have any groups please add a group to add one")}}</h1>
                <div class="my-4">
                    <x-circle-xo-button :href="route('profile.groups.create')" modal size="sm">
                        {{__('Create Group')}}
                    </x-circle-xo-button>
                </div>
            </div>
        </div>
    @else
        <div class="mx-8 md:mx-0 mt-6 mb-8">
            <x-splade-table :for="$table" custom-body custom-body-view="circle-contacts::contacts.list">

            </x-splade-table>
        </div>
    @endif
@endsection

{{--<x-circle-xo-profile-layout>--}}
{{--    {{ __('CircleXoContact') }}--}}

{{--    <x-tomato-admin-button :modal="true" :href="route('profile.contacts.create')" type="link">--}}
{{--        {{trans('tomato-admin::global.crud.create-new')}} {{__('CircleXoContact')}}--}}
{{--    </x-tomato-admin-button>--}}

{{--    <div class="pb-12">--}}
{{--        <div class="mx-auto">--}}
{{--            <x-splade-table :for="$table" striped>--}}
{{--                <x-splade-cell email>--}}
{{--                    <x-tomato-admin-row table type="email" :value="$item->email" />--}}
{{--                </x-splade-cell>--}}
{{--                <x-splade-cell phone>--}}
{{--                    <x-tomato-admin-row table type="tel" :value="$item->phone" />--}}
{{--                </x-splade-cell>--}}
{{--                <x-splade-cell account_id>--}}
{{--                    <x-tomato-admin-row table type="number" :value="$item->account_id" />--}}
{{--                </x-splade-cell>--}}

{{--                <x-splade-cell actions>--}}
{{--                    <div class="flex justify-start">--}}
{{--                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('profile.contacts.show', $item->id)">--}}
{{--                            <x-heroicon-s-eye class="h-6 w-6"/>--}}
{{--                        </x-tomato-admin-button>--}}
{{--                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('profile.contacts.edit', $item->id)">--}}
{{--                            <x-heroicon-s-pencil class="h-6 w-6"/>--}}
{{--                        </x-tomato-admin-button>--}}
{{--                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('profile.contacts.destroy', $item->id)"--}}
{{--                                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"--}}
{{--                                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"--}}
{{--                                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"--}}
{{--                                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"--}}
{{--                                               method="delete"--}}
{{--                        >--}}
{{--                            <x-heroicon-s-trash class="h-6 w-6"/>--}}
{{--                        </x-tomato-admin-button>--}}
{{--                    </div>--}}
{{--                </x-splade-cell>--}}
{{--            </x-splade-table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-circle-xo-profile-layout>--}}
