<x-circle-xo-public-profile-layout :account="$account">
    <div class="my-8">
        <x-circle-xo-listing-filters link />

        <div class="mx-8 lg:mx-16  my-4">

            @if($docs->count() > 0)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach($docs as $itemKey => $item)
                        <div class="bg-zinc-800 rounded-lg overflow-hidden shadow-md border border-zinc-700 p-4 min-w-64">
                            <div class="flex flex-col items-center justify-center">
                                @if($item->getMedia('icon')->first())
                                    <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700">
                                        <img src="{{$item->getMedia('icon')->first()->getUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                                    </div>
                                @else
                                    <div class="w-24 h-24 rounded-full bg-zinc-800 border border-zinc-700" >
                                        <div class="flex flex-col justify-center items-center text-center h-full">
                                            <i class="bx bxs-file-doc text-5xl text-zinc-500"></i>
                                        </div>
                                    </div>
                                @endif
                                <x-splade-link href="{{ route('docs.show', ['username' => $account->username, 'slug' => $item->package]) }}" class="flex justify-center gap-2 font-bold w-full">
                                    <h1 class="text-xl truncate">{{ $item->name }}</h1>
                                </x-splade-link>
                                <h6 class="text-sm text-zinc-300 my-2 text-center">
                                    #{{ $item->package }}
                                </h6>
                                <h6 class="text-sm text-zinc-300 my-2 text-center">
                                    {{ $item->about }}
                                </h6>
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
                        <h1>{{__("Sorry this account don't have any docs")}}</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-circle-xo-public-profile-layout>
