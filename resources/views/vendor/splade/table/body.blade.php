<tbody class="divide-y divide-zinc-100 dark:divide-zinc-600 bg-white dark:bg-zinc-800">
    @forelse($table->resource as $itemKey => $item)
        <tr
            :class="{
                'bg-zinc-50 dark:bg-zinc-700 ': table.striped && @js($itemKey) % 2,
                'hover:bg-zinc-100 dark:hover:bg-zinc-800': table.striped,
                'hover:bg-zinc-50 dark:hover:bg-zinc-900 ': !table.striped
            }"
        >
            @if($hasBulkActions = $table->hasBulkActions())
                @php $itemPrimaryKey = $table->findPrimaryKey($item) @endphp
                <td width="64" class="text-xs px-6 py-4 border-b border-zinc-200 dark:border-zinc-500" :class="{'bg-zinc-200 dark:bg-zinc-600': table.itemIsSelected(@js($itemPrimaryKey))}">
                    <div class="h-full">
                        <input
                            @change="(e) => table.setSelectedItem(@js($itemPrimaryKey), e.target.checked)"
                            :checked="table.itemIsSelected(@js($itemPrimaryKey))"
                            :disabled="table.allItemsFromAllPagesAreSelected"
                            class="dark:bg-zinc-500 border-zinc-200 dark:border-zinc-600 rounded text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50"
                            name="table-row-bulk-action"
                            type="checkbox"
                            value="{{ $itemPrimaryKey }}"
                        />
                    </div>
                </td>
            @endif

            @foreach($table->columns() as $column)
                @if($column->key === 'actions')
                    <td
                        @if($table->rowLinks->has($itemKey))
                            @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
                        @endif
                        v-show="table.columnIsVisible(@js($column->key))"
                        :class="{
                            'bg-zinc-200 dark:bg-zinc-600': table.itemIsSelected(@js($itemPrimaryKey??null))}
                        "
                        class="table_action md:sticky w-0 last:before:hidden md:last:before:block md:last:before:h-full md:last:before:top-0 md:ltr:last:before:left-[-15px] md:rtl:last:before:right-[-15px] md:last:before:absolute md:last:before:w-[15px] md:ltr:last:before:shadow-[inset_-15px_0_15px_-17px_rgba(0,0,0,0.2)] md:rtl:last:before:shadow-[inset_15px_0_15px_-17px_rgba(0,0,0,0.2)] rtl:border-r border-l border-b border-zinc-200 dark:border-zinc-500 rtl:left-0 ltr:right-0 bg-white dark:bg-zinc-800 table_action_hover whitespace-nowrap ltr:capitalize text-sm @if($loop->first && $hasBulkActions) pr-6 @else px-6 @endif py-4 @if($column->highlight) text-zinc-900 dark:text-white font-medium text-left rtl:text-right @else text-zinc-500 dark:text-zinc-200 @endif @if($table->rowLinks->has($itemKey)) cursor-pointer @endif {{ $column->classes }}"
                    >
                        @isset(${'spladeTableCell' . $column->keyHash()})
                            {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                        @else
                            {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                        @endisset
                    </td>
                @else
                    <td
                        @if($table->rowLinks->has($itemKey))
                            @click="(event) => table.visit(@js($table->rowLinks->get($itemKey)), @js($table->rowLinkType), event)"
                        @endif
                        v-show="table.columnIsVisible(@js($column->key))"
                        :class="{'bg-zinc-200 dark:bg-zinc-600': table.itemIsSelected(@js($itemPrimaryKey??null))}"
                        class="border-b border-zinc-200 dark:border-zinc-500 table_action_hover whitespace-nowrap ltr:capitalize text-sm   @if($loop->first && $hasBulkActions) pr-6 @else px-6 @endif py-4 @if($column->highlight) text-zinc-900 dark:text-white font-medium text-left rtl:text-right @else text-zinc-500 dark:text-zinc-200 @endif @if($table->rowLinks->has($itemKey)) cursor-pointer @endif {{ $column->classes }}"
                    >
                        @isset(${'spladeTableCell' . $column->keyHash()})
                            {{ ${'spladeTableCell' . $column->keyHash()}($item, $itemKey) }}
                        @else
                            {!! nl2br(e($getColumnDataFromItem($item, $column))) !!}
                        @endisset
                    </td>
                @endif

            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ $table->columns()->count() }}" class="whitespace-nowrap">
                @if(isset($emptyState) && !!$emptyState)
                    {{ $emptyState }}
                @else
                    <div class="py-12">
                        <div class="flex flex-col justify-center items-center my-2 text-danger-500">
                            <x-heroicon-s-x-circle class="w-16 h-16" />
                        </div>
                        <p class="text-zinc-700 dark:text-zinc-200 px-6  font-medium text-sm text-center">
                            {{ __('There are no items to show.') }}
                        </p>
                    </div>
                @endif
            </td>
        </tr>
    @endforelse
</tbody>
