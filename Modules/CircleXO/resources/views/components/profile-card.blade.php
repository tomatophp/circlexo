<div class="bg-gray-800 rounded-lg overflow-hidden shadow-md border border-gray-700 p-4 min-w-64 max-w-80">
    <div class="flex flex-col items-center justify-center">
        <div class="w-32 h-32 bg-cover bg-gray-900 rounded-full my-4">

        </div>
        <x-splade-link href="{{ route('profile', $account->username) }}" class="flex justify-center gap-2  font-bold">
            <h1 class="text-2xl">{{ $account->name }}</h1>
            <div class="flex flex-col justify-center items-center mt-1">
                <i class="bx bxs-check-circle text-green-500 text-lg"></i>
            </div>
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
