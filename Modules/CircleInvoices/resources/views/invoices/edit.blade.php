@extends('circle-xo::layouts.app')

@section('title', __('Edit Invoice') . ' #' . $model->id)

@section('content')
    <x-splade-form class="flex flex-col space-y-4" action="{{route('profile.invoices.update', $model->id)}}" method="post" :default="array_merge($model->toArray(), [
         'billed_from' => auth('accounts')->user()->meta('billed_from') ?: auth('accounts')->user()->name . PHP_EOL . auth('accounts')->user()->address . PHP_EOL . auth('accounts')->user()->email

    ])">

        <div class="grid grid-cols-12 w-full">
            <div class="col-span-12 lg:col-span-3 flex flex-col justify-start gap-4 w-full">
                <x-splade-file preview filepond name="logo" :label="__('Logo')" />
                <x-splade-textarea autosize name="billed_from" :label="__('Billed From')" type="text"  :placeholder="__('Billed From')" />
                <x-splade-select choices name="contact_id" remote-root="data" :remote-url="route('profile.contacts.api')" option-value="id" option-label="name" :label="__('Contact')" :placeholder="__('Contact')" />
                <x-splade-textarea  autosize name="billed_to" :label="__('Billed To')" @input="form.shipped_to = form.billed_to" type="text"  :placeholder="__('Billed To')" />
                <x-splade-textarea  autosize name="shipped_to" :label="__('Shipped To')" type="text"  :placeholder="__('Shipped To')" />
            </div>
            <div class="col-span-12 lg:col-span-5 w-full">

            </div>
            <div class="col-span-12 lg:col-span-4 w-full">
                <div class="flex justify-end w-full">
                    <div class="flex flex-col gap-2 w-full my-4">
                        <h1 class="text-4xl">{{__('INVOICE')}}</h1>
                        <x-splade-input name="uuid" type="text"  :placeholder="__('S.N')">
                            <x-slot:prepend>
                                #
                            </x-slot:prepend>
                        </x-splade-input>

                        <div class="mt-16 flex flex-col gap-2">
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Date')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-input date name="invoice_date" type="text"  :placeholder="__('Date')" />
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Due Date')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-input date name="due_date" type="date"  :placeholder="__('Due Date')" />
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Paid Amount')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-input name="paid_amount" type="number"  :placeholder="__('Paid Amount')" />
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Shipping Price')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-input name="shipping" type="number"  :placeholder="__('Shipping Price')" />
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Payment Method')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-select choices name="payment_method" type="date" class="w-full"  :placeholder="__('Payment Method')">
                                        <option value="cash">{{__('Cash')}}</option>
                                        <option value="bank">{{__('Bank')}}</option>
                                        <option value="cheque">{{__('Cheque')}}</option>
                                        <option value="credit_card">{{__('Credit Card')}}</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Payment Status')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-select choices name="status" type="date" class="w-full"  :placeholder="__('Payment Status')">
                                        <option value="pending">{{__('Pending')}}</option>
                                        <option value="active">{{__('Active')}}</option>
                                        <option value="paid">{{__('Paid')}}</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Invoice Type')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-select choices name="type" type="date" class="w-full"  :placeholder="__('Invoice Type')">
                                        <option value="push">{{__('Push')}}</option>
                                        <option value="sell">{{__('Sell')}}</option>
                                        <option value="offer">{{__('Offer')}}</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Currency')}}</div>
                                <div class="flex justify-end w-full">
                                    @php $currencies = \Modules\TomatoLocations\App\Models\Currency::all(); @endphp
                                    <x-splade-select choices name="currency" class="w-full" :placeholder="__('Currency')">
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->iso}}">
                                                {{$currency->name}}
                                            </option>
                                        @endforeach
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Invoice Template')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-select choices name="template" type="date" class="w-full" :placeholder="__('Invoice Template')">
                                        <option value="invoice-1">{{__('Invoice 1')}}</option>
                                    </x-splade-select>
                                </div>
                            </div>
                            <div class="flex justify-start gap-4">
                                <div class="flex flex-col justify-center items-start w-full">{{__('Invoice Template')}}</div>
                                <div class="flex justify-end w-full">
                                    <x-splade-checkbox name="is_public" :label="__('Public?')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-tomato-items :options="['item'=>'', 'price'=>0, 'discount'=>0, 'tax'=>0, 'qty'=>1,'total'=>0]" name="items">
            <div class="grid grid-cols-12 w-full my-4 bg-zinc-700 p-4 font-bold">
                <div class="col-span-12 lg:col-span-5">
                    {{__('Item')}}
                </div>
                <div class="col-span-12 lg:col-span-1">
                    {{__('Price')}}
                </div>
                <div class="col-span-12 lg:col-span-1">
                    {{__('Discount')}}
                </div>
                <div class="col-span-12 lg:col-span-1">
                    {{__('Tax')}}
                </div>
                <div class="col-span-12 lg:col-span-1">
                    {{__('QTY')}}
                </div>
                <div class="col-span-12 lg:col-span-1">
                    {{__('Total')}}
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <div class="grid grid-cols-12 gap-4" v-for="(item, key) in items.main">
                    <div class="col-span-12 lg:col-span-5 flex justify-between gap-4">
                        <div class="w-full">
                            <x-splade-input
                                type="text"
                                :placeholder="__('Item Name')"
                                v-model="items.main[key].item"
                                required
                            />
                        </div>
                    </div>
                    <x-splade-input
                        class="col-span-12 lg:col-span-1"
                        type="number"
                        :placeholder="__('Price')"
                        v-model="items.main[key].price"
                        @input="items.updateTotal(key)"
                    />
                    <x-splade-input
                        class="col-span-12 lg:col-span-1"
                        type="number"
                        :placeholder="__('Discount')"
                        v-model="items.main[key].discount"
                        @input="items.updateTotal(key)"
                    />
                    <x-splade-input
                        class="col-span-12 lg:col-span-1"
                        type="number"
                        :placeholder="__('Tax')"
                        v-model="items.main[key].tax"
                        @input="items.updateTotal(key)"
                    />

                    <x-splade-input
                        class="col-span-12 lg:col-span-1"
                        type="number"
                        :placeholder="__('QTY')"
                        v-model="items.main[key].qty"
                        @input="items.updateTotal(key)"
                    />
                    <x-splade-input
                        class="col-span-12 lg:col-span-1"
                        type="text"
                        :placeholder="__('Total')"
                        v-model="items.main[key].total"
                        @input="items.updateTotal(key)"
                    />
                    <button @click.prevent="items.addItem" class="col-span-12 lg:col-span-1 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 text-white border-transparent">
                        <i class="bx bx-plus"></i>
                    </button>
                    <button @click.prevent="items.removeItem(item)" class="col-span-12 lg:col-span-1 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm shadow-sm focus:ring-white filament-page-button-action bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 text-white border-transparent">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-4 mt-4">
                <div class="flex justify-between gap-4  bg-zinc-700 p-4">
                    <div>
                        {{__('Tax')}}
                    </div>
                    <div>
                        @{{ items.tax }}
                    </div>
                </div>
                <div class="flex justify-between gap-4 p-4 ">
                    <div>
                        {{__('Sub Total')}}
                    </div>
                    <div>
                        @{{ items.price }}
                    </div>
                </div>
                <div class="flex justify-between gap-4 p-4 bg-zinc-700">
                    <div>
                        {{__('Discount')}}
                    </div>
                    <div>
                        @{{ items.discount }}
                    </div>
                </div>
                <div class="flex justify-between gap-4 p-4">
                    <div>
                        {{__('Total')}}
                    </div>
                    <div>
                        @{{ items.total }}
                    </div>
                </div>
            </div>
        </x-tomato-items>
        <x-splade-textarea autosize class="w-full my-4" name="notes" :placeholder="__('Notes')" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button warning label="{{__('Print')}}" :href="route('profile.invoices.print', $model->id)"/>
            <x-tomato-admin-button danger :href="route('profile.invoices.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('profile.invoices.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
@endsection
