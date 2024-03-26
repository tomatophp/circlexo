<x-splade-component is="button-with-dropdown" dusk="filters-dropdown" class="w-full bg-white border border-zinc-200 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-zinc-700 hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:hover:bg-zinc-600  dark:bg-zinc-700 dark:border-zinc-600">
    <x-slot:button>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
            :class="{
                'text-zinc-400': !@js($table->hasFiltersEnabled()),
                'text-green-400': @js($table->hasFiltersEnabled()),
            }"
        >
            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
        </svg>
    </x-slot:button>

    <div
      role="menu"
      aria-orientation="horizontal"
      aria-labelledby="filter-menu"
    >
        <x-splade-form method="GET" :action="url()->current()" :default="['filter' => request()->get('filter') ?: []]">
            @foreach($table->filters() as $filter)
                <div>
                    <h3 class="text-xs uppercase tracking-wide bg-zinc-100 dark:bg-zinc-800 p-3">
                        {{ $filter->label }}
                    </h3>

                    <div class="p-2 dark:bg-zinc-600" style="width: 300px !important;">
                        @if($filter->type === 'select')
                            @if($filter->remote_url)
                                <x-tomato-admin-select
                                    name="filter[{{ $filter->key }}]"
                                    placeholder="{!! $filter->label !!}"
                                    option-label="{{$filter->option_label}}"
                                    option-value="{{$filter->option_value}}"
                                    remote-url="{!! $filter->remote_url !!}"
                                    remote-root="{{$filter->remote_root}}"
                                    paginated="{!! $filter->paginated !!}"
                                    query-by="{{$filter->queryBy}}"
                                    type="relation"
                                    multiple="{{$filter->mutli}}"
                                    @select="table.updateQuery('filter[{{ $filter->key }}]', $event)"
                                />
                            @else
                                <x-splade-select
                                    choices
                                    name="filter[{{ $filter->key }}]"
                                    placeholder="{!! $filter->label !!}"
                                    multiple="{{$filter->mutli}}"
                                    @change="table.updateQuery('filter[{{ $filter->key }}]', $event.target.value)"
                                >
                                    @foreach($filter->options() as $optionKey => $option)
                                        <option @selected($filter->hasValue() && $filter->value == $optionKey) value="{{ $optionKey }}">
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </x-splade-select>
                            @endif
                        @endif
                        @if($filter->type === 'bool')
                            <label class="relative inline-flex items-center cursor-pointer" @click.prevent="table.updateQuery('filter[{{ $filter->key }}]', {{request()->get('filter') && isset(request()->get('filter')[$filter->key]) && request()->get('filter')[$filter->key] == '1' ? '0' : '1'}} )">
                                <input type="checkbox" @if(request()->get('filter') && isset(request()->get('filter')[$filter->key]) && request()->get('filter')[$filter->key] == '1') checked="1" @endif class="sr-only peer">
                                <div class="w-11 h-6 bg-zinc-200
                                peer-focus:outline-none
                                peer-focus:ring-4
                                peer-focus:ring-primary-300
                                dark:peer-focus:ring-primary-800
                                rounded-full peer
                                dark:bg-zinc-700
                                peer-checked:after:translate-x-full
                                peer-checked:after:border-white
                                after:content-['']
                                after:absolute
                                after:top-[2px]
                                after:left-[2px]
                                after:bg-white
                                after:border-zinc-200
                                after:border after:rounded-full
                                after:h-5
                                after:w-5
                                after:transition-all
                                dark:border-zinc-600
                                peer-checked:bg-blue-600"
                                ></div>
                            </label>
                        @endif
                        @if($filter->type === 'date')
                                <x-splade-input
                                    date
                                    range
                                    name="filter[{{ $filter->key }}]"
                                    placeholder="{{__('Date Range')}}"
                                    @change="$event.target.value.includes('to') ? table.updateQuery('filter[{{ $filter->key }}]', $event.target.value) : null"
                                />
                        @endif
                    </div>
                </div>
            @endforeach
        </x-splade-form>
    </div>
</x-splade-component>
