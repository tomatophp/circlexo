<div class="bg-zinc-900 text-white">
    <x-tomato-builder-toolbar :page="$page" />
</div>
@if(auth('accounts')->user())
    <x-splade-event private :channel="'accounts.'.auth('accounts')->user()->id" listen="UserEvent"/>
@endif
