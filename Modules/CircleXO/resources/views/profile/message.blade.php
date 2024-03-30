@extends('circle-xo::layouts.app')

@section('title', __('Message Details'))

@section('content')
    <div class="my-4 text-white">
        {{ $message->message }}
    </div>
@endsection
