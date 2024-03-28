<x-tomato-admin-container :label="__('Ticket') . ' #'. $model->code">
    <x-slot:buttons>
        @if(config('tomato-support.actions'))
            @include(config('tomato-support.actions'), ['model' => $model])
        @endif
    </x-slot:buttons>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <x-tomato-admin-row :label="__('Status')" :value="$model->type?->name" type="text" />

        <x-tomato-admin-row :label="__('Account')" :value="$model->accountable?->name" type="string" />

        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="string" />

        <x-tomato-admin-row :label="__('Phone')" :value="$model->phone" type="tel" />

        <x-tomato-admin-row :label="__('Code')" :value="$model->code" type="string" />

        <x-tomato-admin-row :label="__('Is closed')" :value="$model->is_closed" type="bool" />

    </div>

    <x-slot:body>
        @if(!$model->is_closed)
        <div
            class="mt-8 rounded-xl bg-white  border pt-2 pb-3 sm:pt-4 sm:pb-6 dark:bg-slate-900 dark:border-gray-700">
            <div class=" px-4 sm:px-6 ">

                <div class="relative">
                    <x-splade-form action="{{route('admin.tickets.send', $model->id)}}" method="post"
                            :default="[
                                'ticket_id' => $model->id,
                                'accountable_type' => \App\Models\User::class,
                                'accountable_id' => auth()->user()->id,
                                'is_closed' => false
                            ]" class="flex flex-col gap-4"

                    >
                        <x-splade-checkbox name="is_closed"  label="{{__('Close This Ticket')}}"/>
                        <x-splade-textarea name="response" placeholder="{{__('Add Comment')}}" autosize/>
                        <x-tomato-admin-submit label="{{__('Add Comment')}}" :spinner="true"/>
                    </x-splade-form>
                    <!-- End Toolbar -->
                </div>
                <!-- End Input -->
            </div>
        </div>
        @endif


        <ul class="my-8 bg-white dark:bg-slate-900 border rounded-xl divide-y-[1px] dark:divide-gray-700">


            <li>
                <div class="flex">
                    <div class="px-4 sm:px-6 py-4 ltr:border-r-[1px] rtl:border-l-[1px] dark:border-gray-700 min-w-[250px] max-w-[20%] flex flex-col gap-2">
                            <span class="font-medium  dark:text-white h-[2.375rem] w-[2.375rem] rounded-full bg-gray-600 flex justify-center items-center text-white">
                                {{substr($model->account?->name,0,1)}}
                            </span>
                        <h2 class="font-medium text-gray-800 dark:text-white">
                            {{$model->accountable?->name}}
                        </h2>
                        <p class="text-gray-400 dark:text-slate-600">
                            {{  $model->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div class="grow space-y-3 p-3 py-4 relative w-[90%]">

                        <div class="space-y-1.5">
                            <p class="text-gray-800 dark:text-gray-200">
                                {{ $model->subject }} : {{  $model->message }}
                            </p>
                        </div>
                    </div>
                </div>
            </li>

            @foreach($model->ticketComments as $key=>$item)

                 <hr>
                @if($item->accountable_type == \App\Models\User::class)
                    <!-- Chat Bubble -->
                    <li>
                        <div class="flex">
                            <div class="px-4 sm:px-6 py-4 ltr:border-r-[1px] rtl:border-l-[1px] dark:border-gray-700 min-w-[250px] max-w-[20%] flex flex-col gap-2">
                                @php
                                    $logo_admin=explode(" ",$item->accountable_type::find($item->accountable_id)?->name);
                                @endphp
                                <span class="font-medium  dark:text-white h-[2.375rem] w-[2.375rem] rounded-full bg-yellow-300 flex justify-center items-center text-white">
                                {{isset($logo_admin[0][0]) ? $logo_admin[0][0] : null}}{{isset($logo_admin[1][0]) ? $logo_admin[1][0] : null}}
                            </span>
                                <h2 class="font-medium text-gray-800 dark:text-white">
                                    {{$item->accountable_type::find($item->accountable_id)?->name}}
                                </h2>
                                <p class="text-gray-400 dark:text-slate-600">
                                    {{$item->created_at->diffForHumans()}}
                                </p>
                            </div>

                            <div class="grow space-y-3 p-3 py-4 relative w-[90%]">
                                <h2 class="font-medium text-gray-800 dark:text-white">
                                    {{__('Support Messages')}}
                                </h2>
                                <div class="space-y-1.5">
                                    <p class="text-gray-800 dark:text-gray-200">
                                        {{$item->response}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <!-- Chat Bubble -->
                    <li>
                        <div class="flex">
                            <div class="px-4 sm:px-6 py-4 ltr:border-r-[1px] rtl:border-l-[1px] dark:border-gray-700 min-w-[250px] max-w-[20%] flex flex-col gap-2">
                                @php
                                    $logo_admin=explode(" ",$item->accountable_type::find($item->accountable_id)?->name);
                                @endphp
                                <span class="font-medium  dark:text-white h-[2.375rem] w-[2.375rem] rounded-full bg-gray-600 flex justify-center items-center text-white">
                                {{substr($item->accountable_type::find($item->accountable_id)?->name,0,1)}}
                            </span>
                                <h2 class="font-medium text-gray-800 dark:text-white">
                                    {{$item->accountable_type::find($item->accountable_id)?->name}}
                                </h2>
                                <p class="text-gray-400 dark:text-slate-600">
                                    {{$item->created_at->diffForHumans()}}
                                </p>
                            </div>

                            <div class="grow space-y-3 p-3 py-4 relative w-[90%]">
                                <h2 class="font-medium text-gray-800 dark:text-white">
                                    {{__('Customer Messages')}}
                                </h2>
                                <div class="space-y-1.5">
                                    <p class="text-gray-800 dark:text-gray-200">
                                        {{$item->response}}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>

    </x-slot:body>
</x-tomato-admin-container>
