<x-splade-modal>
    <x-slot:title>
        {{__('Message Details')}}
    </x-slot:title>

    <div class="my-4 text-white">
        {{ $message->message }}
    </div>
</x-splade-modal>
