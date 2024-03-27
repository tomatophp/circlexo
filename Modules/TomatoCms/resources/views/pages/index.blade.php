<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Pages') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :href="route('admin.pages.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Page')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped>
                <x-splade-cell color>
                    <x-tomato-admin-row table type="color" :value="$item->color" />
                </x-splade-cell>
                <x-splade-cell is_active>
                    <x-tomato-admin-row table type="bool" :value="$item->is_active" />
                </x-splade-cell>
                <x-splade-cell has_view>
                    <x-tomato-admin-row table type="bool" :value="$item->has_view" />
                </x-splade-cell>

                <x-splade-cell actions>
                    <div class="flex justify-start">
                        @if(class_exists(\Modules\TomatoThemes\App\Http\Controllers\BuilderController::class))
                            <x-tomato-admin-button type="icon" title="{{__('Page Builder')}}" :href="route('admin.pages.builder', $item->id)">
                                <x-heroicon-s-building-library class="h-6 w-6"/>
                            </x-tomato-admin-button>
                            <x-tomato-admin-button danger confirm method="POST" type="icon" title="{{__('Clear Builder')}}" href="{{route('admin.pages.clear', $item->id)}}">
                                <x-heroicon-s-archive-box-x-mark class="h-6 w-6"/>
                            </x-tomato-admin-button>
                        @endif
                        <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.pages.show', $item->id)">
                            <x-heroicon-s-eye class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" :href="route('admin.pages.edit', $item->id)">
                            <x-heroicon-s-pencil class="h-6 w-6"/>
                        </x-tomato-admin-button>
                        <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.pages.destroy', $item->id)"
                           confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                           confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                           confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                           cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                           method="delete"
                        >
                            <x-heroicon-s-trash class="h-6 w-6"/>
                        </x-tomato-admin-button>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
