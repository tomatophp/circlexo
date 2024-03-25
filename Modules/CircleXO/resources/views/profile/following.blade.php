<x-circle-xo-profile-layout>
    <div class="my-12 mx-8 lg:mx-16">
        @if(!auth('accounts')->user()->followings()->get()->count())
            <div class="bg-gray-800 border border-gray-700 mx-16 my-4 rounded-lg shadow-sm flex justify-center">
                <div class="p-8 md:p-16 text-center">
                    <i class="bx bx-x-circle bx-lg text-danger-500"></i>
                    <h1>{{__("You still don't follow any user!")}}</h1>
                </div>
            </div>
        @else
            @php
                $followers = auth('accounts')->user()->followings()->paginate(8);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mx-16 ">
                @foreach($followers as $follower)
                    <x-circle-xo-profile-card :account="$follower" />
                @endforeach
            </div>

            <div class="mx-16 my-4">
                {!! $followers->links('tomato-admin::components.pagination') !!}
            </div>

        @endif
    </div>
</x-circle-xo-profile-layout>
