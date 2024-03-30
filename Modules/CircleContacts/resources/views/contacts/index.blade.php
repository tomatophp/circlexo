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
