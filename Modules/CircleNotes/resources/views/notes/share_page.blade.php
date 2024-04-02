
<x-circle-xo-public-profile-layout :account="$account">
    <section class="py-16">
        <div class="container max-w-screen-xl px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="w-full h-full flex flex-col justify-between bg-zinc-800 rounded-lg border border-zinc-700 mb-6 py-5 px-4 transition-all">
                <div>
                    <div class="w-full border-b border-zinc-700 pb-4">
                        <h4 class="text-zinc-100 font-bold">{{ $note->title }}</h4>
                    </div>
                    <p class="text-zinc-100 text-sm">
                        <x-tomato-markdown-viewer style="background-color: rgb(39 39 42 / var(--tw-bg-opacity)) !important;" :content="$note->content" />
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-circle-xo-public-profile-layout>
