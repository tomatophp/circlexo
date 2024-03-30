@extends('circle-invoices::layout.app')

@section('content')
    <div class="mx-8 md:mx-0 mt-6 mb-8">
        <x-splade-table :for="$table" custom-body custom-body-view="circle-invoices::invoices.list">

        </x-splade-table>
    </div>
@endsection
