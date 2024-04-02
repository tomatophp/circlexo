@extends('circle-docs::layouts.doc', ['model' => $doc])

@section('title', $doc->name)
@section('icon')
    @if($doc->getMedia('icon')->first())
        <img src="{{$doc->getMedia('icon')->first()->getUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
    @else
        <i class="bx bxs-file-doc"></i>
    @endif
@endsection

@section('content')
    <div class="bg-zinc-800 p-4">
        <x-splade-form class="grid grid-cols-3 gap-4" :default="['doc_id' => $doc->id]" action="{{route('profile.docs-pages.store')}}" method="post">

            <x-splade-file filepond preview class="col-span-3" :label="__('Cover')" :placeholder="__('Cover')"  name="cover" />
            <x-splade-input class="col-span-3" :label="__('Group')" :placeholder="__('Group')" type='text' name="group" />
            <x-tomato-admin-icon :label="__('Icon')" :placeholder="__('Icon')" name="icon" />
            <div class="col-span-2 flex justify-start gap-4">
                <x-splade-input class="w-full" :label="__('Title')" @input="form.slug = form.title.replaceAll(' ', '-')" name="title" type="text"  :placeholder="__('Title')" />
                <x-tomato-admin-color :label="__('Color')" :placeholder="__('Color')" name="color" />
            </div>
            <x-splade-input class="col-span-3"  :label="__('Slug')" name="slug" type="text"  :placeholder="__('Slug')" />
            <x-splade-textarea autosize class="col-span-3" :label="__('Description')" name="description" type="text"  :placeholder="__('Description')" />
            <div class="col-span-3">
                <x-tomato-markdown-editor :label="__('Body')" name="body" :placeholder="__('Body')" />
            </div>


            <div class="flex justify-start gap-2 pt-3 col-span-3">
                <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
                <x-tomato-admin-button secondary :href="route('profile.docs.show', $doc->id)" label="{{__('Cancel')}}"/>
            </div>
        </x-splade-form>
    </div>
@endsection
