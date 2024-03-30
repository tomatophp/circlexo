<div class="bg-white">
    <div class="flex justify-between xl:gap-60 lg:gap-48 md:gap-16 sm:gap-8 sm:flex-row flex-col gap-4 bg-white">
        <div class="w-full">
            <div>
                <div style="background-image: url('{{$invoice->getMedia('logo')->first()?->getUrl()}}')" class="bg-center bg-no-repeat bg-contain h-24 w-40">

                </div>
            </div>
            @if($invoice->billed_from)
                <div class="flex flex-col my-4">
                    <div class="text-sm text-gray-400">
                        {{__('Bill From')}}:
                    </div>
                    <pre class="text-lg font-bold mt-2" style="white-space: pre-line !important;">
                    {{$invoice->billed_from}}
                </pre>
                </div>
            @endif
            @if($invoice->billed_to)
                <div class="mt-8">
                    <div class="mt-4">
                        <div class="text-sm text-gray-400">
                            {{__('Bill To')}}:
                        </div>
                        <pre class="text-lg font-bold" style="white-space: pre-line !important;">
                        {{$invoice->billed_to}}
                    </pre>

                    </div>
                </div>
            @endif
        </div>
        <div class="w-full flex flex-col">
            <div class="flex justify-end font-bold mt-6">
                <div>
                    <div>
                        <h1 class="text-3xl">{{__('INVOICE')}}</h1>
                    </div>
                    <div>
                        {{__('Invoice')}}# {{$invoice->uuid}}
                    </div>
                </div>
            </div>
            <div class="flex justify-end h-full">
                <div class="flex flex-col justify-end">
                    <div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Issue Date')}} : </div>
                            <div>{{$invoice->invoice_date}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Due Date')}} : </div>
                            <div>{{$invoice->due_date}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Status')}} : </div>
                            <div>{{$invoice->status}}</div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div class="text-gray-400">{{__('Type')}} : </div>
                            <div>{{$invoice->type}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white relative">
        <table class="w-full text-sm text-left rtl:text-right my-4">
            <thead class="text-xs text-gray-700 uppercase bg-zinc-300">
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
            @foreach($invoice->items as $key=>$item)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $key+1 }}</td>
                    <td class="px-6 py-4">{{ $item->item }}</td>
                    <td class="px-6 py-4">{{ number_format($item->price, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->discount, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->tax, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small></td>
                    <td class="px-6 py-4">{{ number_format($item->qty, 2) }}</td>
                    <td class="px-6 py-4">{{ number_format($item->total, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="flex justify-between mt-2">
            <div class="flex flex-col justify-end gap-4">

            </div>
            <div class="flex flex-col gap-2 mt-4  w-1/2">
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Sub Total')}}
                    </div>
                    <div>
                        {{ number_format(($invoice->total + $invoice->discount) - ($invoice->tax + $invoice->shipping), 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Tax')}}
                    </div>
                    <div>
                        {{ number_format($invoice->tax, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Discount')}}
                    </div>
                    <div>
                        {{ number_format($invoice->discount, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="font-bold">
                        {{__('Paid')}}
                    </div>
                    <div>
                        {{ number_format($invoice->paid_amount, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-4">
                    <div class="font-bold">
                        {{__('Shipping')}}
                    </div>
                    <div>
                        {{ number_format($invoice->shipping, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
                <div class="flex justify-between text-3xl font-bold">
                    <div>
                        {{__('Balance Due')}}
                    </div>
                    <div>
                        {{ number_format($invoice->total+$invoice->shipping, 2) }}<small class="text-md font-normal">{{ $invoice->currency }}</small>
                    </div>
                </div>
            </div>
        </div>


        @if($invoice->notes)
            <div class="border-b my-4"></div>

            <div>
                <div class="mb-2 text-xl">
                    {{__('Notes')}}
                </div>
                <div class="text-sm text-gray-500">
                    {!! $invoice->notes !!}
                </div>
            </div>
        @endif
    </div>

    <x-splade-script>
        setTimeout(function(){
        window.print();
        }, 1000);
    </x-splade-script>

</div>
