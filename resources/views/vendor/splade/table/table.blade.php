<TomatoTable {{ $attributes->except('class') }}
    :striped="@js($striped)"
    :columns="@js($table->columns())"
    :search-debounce="@js($searchDebounce)"
    :default-visible-toggleable-columns="@js($table->defaultVisibleToggleableColumns())"
    :items-on-this-page="@js($table->totalOnThisPage())"
    :items-on-all-pages="@js($table->totalOnAllPages())"
    :base-url="@js(request()->url())"
>
    <template #default="{!! $scope !!}">
        <div {{ $attributes->only('class') }} :class="{ 'opacity-50': table.isLoading }">
            @if($hasControls())
                @include('splade::table.controls')
            @endif

            @foreach($table->searchInputs() as $searchInput)
                @includeUnless($searchInput->key === 'global', 'splade::table.search-row')
            @endforeach

            @isset($header)
                {{ $header }}
            @endisset

            <x-splade-component is="table-wrapper" :customBody="$customBody">

            @if($customBody)
                  <div v-if="table.hasSelectedItems" class="bg-zinc-700 text-zinc-100 dark:bg-zinc-900 dark:text-zinc-100  border border-zinc-600 dark:border-zinc-800 rounded-lg mb-3">
                        <div colspan="{{ $table->columns()->count() + 1 }}">
                            <div class="flex justify-start gap-4 p-4">
                                <div class="flex flex-col items-center justify-center font-medium">
                                    <h3 v-if="table.hasSelectedItems">
                                            <span v-if="table.totalSelectedItems == 1">
                                                <span v-text="table.totalSelectedItems" /> {{ __('Item selected') }}
                                            </span>

                                        <span v-if="table.totalSelectedItems > 1">
                                                <span v-text="table.totalSelectedItems" /> {{ __('Items selected') }}
                                            </span>
                                    </h3>
                                </div>

                                <div class="flex justify-start gap-2">
                                    @foreach($table->getBulkActions() as $bulkAction)
                                        @if($bulkAction->type === 'action')
                                            <div class="flex flex-col items-center justify-center">
                                                <button
                                                    type="button"
                                                    class="text-sm px-2 py-1 rounded-lg bg-{{$bulkAction->style}}-500 text-white"
                                                    @click.prevent="table.performBulkAction(
                                                        @js($bulkAction->getUrl()),
                                                        @js($bulkAction->confirm),
                                                        @js($bulkAction->confirmText),
                                                        @js($bulkAction->confirmButton),
                                                        @js($bulkAction->cancelButton),
                                                        @js($bulkAction->cancelButton),
                                                        @js($bulkAction->requirePassword)
                                                    )"
                                                    dusk="action.{{ $bulkAction->getSlug() }}">
                                                    {{ $bulkAction->label }}
                                                </button>
                                            </div>
                                        @elseif($bulkAction->type === 'modal')
                                            <div class="flex flex-col items-center justify-center">
                                                <Link
                                                    class="text-sm px-2 py-1 rounded-lg bg-{{$bulkAction->style}}-500 text-white"
                                                    modal
                                                    v-bind:href="'{{$bulkAction->href}}?ids='+table.selectedItems"
                                                    v-if="table.hasSelectedItems"
                                                    v-bind:confirm="@js($bulkAction->confirm)"
                                                    v-bind:confirmText="@js($bulkAction->confirmText)"
                                                    v-bind:confirmButton="@js($bulkAction->confirmButton)"
                                                    v-bind:cancelButton="@js($bulkAction->cancelButton)"
                                                    v-bind:requirePassword="@js($bulkAction->requirePassword)"
                                                    dusk="action.{{ $bulkAction->getSlug() }}">
                                                    {{ $bulkAction->label }}
                                                </Link>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                  @include($customBodyView)
                @else
                    <table class="border-separate border-spacing-0 min-w-full divide-y divide-zinc-200 dark:divide-zinc-600 bg-white dark:bg-zinc-700">
                        @unless($headless)
                            @isset($head)
                                {{ $head }}
                            @elseif(count($table->resource))
                                @include('splade::table.head')
                            @endisset
                        @endunless

                        <tr v-if="table.hasSelectedItems" class="bg-zinc-700 dark:bg-zinc-900 dark:bg-zinc-200 text-zinc-100">
                            <td colspan="{{ $table->columns()->count() + 1 }}">
                                <div class="flex justify-start gap-4 p-4">
                                    <div class="flex flex-col items-center justify-center font-medium">
                                        <h3 v-if="table.hasSelectedItems">
                                            <span v-if="table.totalSelectedItems == 1">
                                                <span v-text="table.totalSelectedItems" /> {{ __('Item selected') }}
                                            </span>

                                            <span v-if="table.totalSelectedItems > 1">
                                                <span v-text="table.totalSelectedItems" /> {{ __('Items selected') }}
                                            </span>
                                        </h3>
                                    </div>

                                    <div class="flex justify-start gap-2">
                                        @foreach($table->getBulkActions() as $bulkAction)
                                            @if($bulkAction->type === 'action')
                                                <div class="flex flex-col items-center justify-center">
                                                    <button
                                                        type="button"
                                                        class="text-sm px-2 py-1 rounded-lg bg-{{$bulkAction->style}}-500 text-white"
                                                        @click.prevent="table.performBulkAction(
                                                        @js($bulkAction->getUrl()),
                                                        @js($bulkAction->confirm),
                                                        @js($bulkAction->confirmText),
                                                        @js($bulkAction->confirmButton),
                                                        @js($bulkAction->cancelButton),
                                                        @js($bulkAction->cancelButton),
                                                        @js($bulkAction->requirePassword)
                                                    )"
                                                        dusk="action.{{ $bulkAction->getSlug() }}">
                                                        {{ $bulkAction->label }}
                                                    </button>
                                                </div>
                                            @elseif($bulkAction->type === 'modal')
                                                <div class="flex flex-col items-center justify-center">
                                                <Link
                                                    class="text-sm px-2 py-1 rounded-lg bg-{{$bulkAction->style}}-500 text-white"
                                                    modal
                                                    v-bind:href="'{{$bulkAction->href}}?ids='+table.selectedItems"
                                                    v-if="table.hasSelectedItems"
                                                    v-bind:confirm="@js($bulkAction->confirm)"
                                                    v-bind:confirmText="@js($bulkAction->confirmText)"
                                                    v-bind:confirmButton="@js($bulkAction->confirmButton)"
                                                    v-bind:cancelButton="@js($bulkAction->cancelButton)"
                                                    v-bind:requirePassword="@js($bulkAction->requirePassword)"
                                                    dusk="action.{{ $bulkAction->getSlug() }}">
                                                    {{ $bulkAction->label }}
                                                </Link>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @isset($body)
                            {{ $body }}
                        @else
                            @include('splade::table.body')
                        @endisset
                    </table>
                @endif
            </x-splade-component>

            @if($showPaginator())
                {{ $table->resource->links($paginationView, ['table' => $table, 'hasPerPageOptions' => $hasPerPageOptions()]) }}
            @endif
        </div>
    </template>
</TomatoTable>
