
@extends('circle-xo::layouts.app')

@section('title', __('Show Invoice') . ' #' . $model->id)

@section('content')

    <div class="flex justify-between xl:gap-60 lg:gap-48 md:gap-16 sm:gap-8 sm:flex-row flex-col gap-4">
        <div class="w-full">
            <div>
                <div style="background-image: url('{{$model->getMedia('logo')->first()?->getUrl()}}')" class="bg-center bg-no-repeat bg-contain h-24 w-40">

                </div>
            </div>
            @if($model->billed_from)
                <div class="flex flex-col my-4">
                    <div class="text-sm text-gray-400">
                        {{__('Bill From')}}:
                    </div>
                    <pre class="text-lg font-bold mt-2" style="white-space: pre-line !important;">
                    {{$model->billed_from}}
                </pre>
                </div>
            @endif
            @if($model->billed_to)
                <div class="mt-8">
                    <div class="mt-4">
                        <div class="text-sm text-gray-400">
                            {{__('Bill To')}}:
                        </div>
                        <pre class="text-lg font-bold" style="white-space: pre-line !important;">
                        {{$model->billed_to}}
                    </pre>

                    </div>
                </div>
            @endif
        </div>
        <div class="w-full flex flex-col">
            <div class="flex justify-end font-bold">
                <div>
                    <div>
                        <h1 class="text-3xl">{{__('INVOICE')}}</h1>
                    </div>
                    <div>
                        {{__('Invoice')}}# {{$model->uuid}}
                    </div>
                </div>
            </div>
            <div class="flex justify-end h-full">
                <div class="flex flex-col justify-end">
                    <div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Issue Date')}} : </div>
                            <div>{{$model->invoice_date}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Due Date')}} : </div>
                            <div>{{$model->due_date}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Status')}} : </div>
                            <div>{{$model->status}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Type')}} : </div>
                            <div>{{$model->type}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <table class="w-full text-sm text-left rtl:text-right my-4">
            <thead class="text-xs text-white uppercase bg-zinc-700">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">{{__('Item')}}</th>
                <th class="px-6 py-4">{{__('Price')}}</th>
                <th class="px-6 py-4">{{__('Discount')}}</th>
                <th class="px-6 py-4">{{__('Tax')}}</th>
                <th class="px-6 py-4">{{__('QTY')}}</th>
                <th class="px-6 py-4">{{__('Total')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($model->items as $key=>$item)
                <tr class="bg-zinc-900 border-b border-zinc-700">
                    <td class="px-6 py-4">{{ $key+1 }}</td>
                    <td class="px-6 py-4">{{ $item->item }}</td>
                    <td class="px-6 py-4">{{ number_format($item->price, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->discount, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->tax, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->qty, 2) }}</td>
                    <td class="px-6 py-4">{{ number_format($item->total, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="flex justify-between mt-2">
            <div class="flex flex-col justify-end gap-4">

            </div>
            <div class="flex flex-col gap-2 mt-4  w-1/4">
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Sub Total')}}
                    </div>
                    <div>
                        {{ number_format(($model->total + $model->discount) - ($model->tax + $model->shipping), 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Tax')}}
                    </div>
                    <div>
                        {{ number_format($model->tax, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Discount')}}
                    </div>
                    <div>
                        {{ number_format($model->discount, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Paid')}}
                    </div>
                    <div>
                        {{ number_format($model->paid_amount, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-4">
                    <div class="font-bold">
                        {{__('Shipping')}}
                    </div>
                    <div>
                        {{ number_format($model->shipping, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between text-3xl font-bold">
                    <div>
                        {{__('Balance Due')}}
                    </div>
                    <div>
                        {{ number_format($model->total+$model->shipping, 2) }}<small class="text-md font-normal">{{ $model->currency }}</small>
                    </div>
                </div>
            </div>
        </div>

        @if($model->notes)
            <div class="border-b border-zinc-700 my-4"></div>
            <div class="my-4">
                <div class="mb-2 text-xl">
                    {{__('Notes')}}
                </div>
                <div class="text-sm text-gray-500" style="white-space: pre-line !important;">
                    {!! $model->notes !!}
                </div>
            </div>
        @endif
    </div>

    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button label="{{__('Print')}}" :href="route('profile.invoices.print', $model->id)"/>
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('profile.invoices.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('profile.invoices.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('profile.invoices.index')" label="{{__('Cancel')}}"/>
    </div>
@endsection
