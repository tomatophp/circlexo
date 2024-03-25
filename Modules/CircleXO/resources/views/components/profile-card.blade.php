<div class="bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-700 p-4 min-w-64 max-w-80">
    <div class="flex flex-col items-center justify-center">
        <div class="my-4">
            @if($account->avatar)
                <div  class="w-24 h-24 rounded-full bg-gray-800 border border-gray-700">
                    <img src="{{ $account->avatar }}" class="w-24 h-24 rounded-full object-cover" alt="avatar">
                </div>
            @else
                <div  class="w-24 h-24 rounded-full bg-gray-800 flex justify-center border border-gray-700">
                    <div class="flex flex-col justify-center items-center text-center h-full">
                        <i class="bx bxs-user text-5xl text-gray-500"></i>
                    </div>
                </div>
            @endif
        </div>
        <x-splade-link href="{{ route('profile', $account->username) }}" class="flex justify-center gap-2  font-bold">
            <h1 class="text-2xl">{{ $account->name }}</h1>
            @if($account->type === 'verified')
                <div class="flex flex-col justify-center items-center mt-1">
                    <i class="bx bxs-badge-check text-blue-400 text-2xl"></i>
                </div>
            @endif
        </x-splade-link>
        <h6 class="text-sm font-medium text-gray-300">{{$account->username}}</h6>
        @if($account->bio)
        <p class="text-xs text-center my-2">
            {{$account->bio}}
        </p>
        @endif
        <h6 class="my-2 text-sm text-gray-300">Joined {{ $account->created_at->diffForHumans() }}</h6>
    </div>
</div>
