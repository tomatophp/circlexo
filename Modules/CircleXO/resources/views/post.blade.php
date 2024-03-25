<x-circle-xo-public-profile-layout :account="$account">
    <div class="mx-8 text-center lg:mx-16">
        <h1 class="text-4xl">{{ $post->title }}</h1>
    </div>
    <div class="mt-8">
        <x-tomato-markdown-viewer :content="$post->body" />
    </div>
</x-circle-xo-public-profile-layout>
