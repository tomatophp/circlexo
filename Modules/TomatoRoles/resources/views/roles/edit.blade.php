<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{trans('tomato-roles::global.roles.single')}} #{{$model['id']}}">
    <x-splade-form class="flex flex-col space-y-4 mb-4" action="{{route('admin.roles.update', $model->id)}}" method="post" :default="$model">

        <div class="flex justify-between">
            <x-splade-input class="w-full mr-2 rtl:ml-2" name="name" type="text" :label="trans('tomato-roles::global.roles.name')"  placeholder="{{trans('tomato-roles::global.roles.name')}}" />
            <x-splade-input class="w-full" name="guard_name" type="text" :label="trans('tomato-roles::global.roles.guard_name')"  placeholder="{{trans('tomato-roles::global.roles.guard_name')}}" />
        </div>

        <x-splade-data
            :default="['permissions' => $permissionNames, 'table' => []]"
        >
            <div>
                <label class="flex items-center">
                    <input
                           type="checkbox"
                           :checked="form.permissions.length? true : false"
                           class="dark:bg-zinc-700 dark:border-zinc-600 rounded border-zinc-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                           @change="form.permissions = form.permissions.length? [] : data.permissions"
                    >
                    <span class="ml-2 rtl:mr-2 rtl:ml-0 dark:text-zinc-200">{{__('Select All')}}</span>
                </label>
            </div>
            <div class="grid grid-cols-1 gap-4">
                @foreach($perm as $permissionTable)
                    <div>
                        <div class="flex justifiy-between gap-4">
                            <div class="w-full">
                                <h3 class="text-md font-bold">{{\Illuminate\Support\Str::of($permissionTable[0]['table'])->replace('_', ' ')->ucfirst()}}</h3>
                            </div>
                            <div class="flex justifiy-end">
                                @php
                                    $collectPermissionTableName = collect($permissionTable)->map(fn($item) => $item['name'])->toArray();
                                    $collectPermissionTable = collect($permissionTable)->map(fn($item) => $item['name'])->toArray();
                                @endphp
                                <label class="flex items-center">
                                    <input
                                        type="checkbox"
                                        v-model="data.table['{{$permissionTable[0]['table']}}']"
                                        :checked="form.permissions.includes({{ str_replace(']', '', str_replace('[','', json_encode($collectPermissionTableName))) }}) ? true : false"
                                        class="dark:bg-zinc-700 dark:border-zinc-600 rounded border-zinc-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50"
                                        @change="
                                            let perm = @js($collectPermissionTable);

                                            if(!data.table['{{$permissionTable[0]['table']}}']){
                                                for(let i=0; i<perm.length; i++){
                                                    form.permissions.splice(form.permissions.indexOf(perm[i]), 1)
                                                }
                                            }else{
                                                for(let i=0; i<perm.length; i++){
                                                    form.permissions.push(perm[i])
                                                }
                                            }
                                        "
                                    >

                                </label>
                            </div>

                        </div>
                        <x-splade-group name="permissions" >
                            <div class="border p-4 rounded-lg grid grid-cols-2 gap-2 mt-2 shadow-sm">
                                @foreach($permissionTable as $permission)
                                    @php
                                        $name = \Illuminate\Support\Str::of($permission['name'])
                                            ->remove('admin.')
                                            ->remove($permission['table'] . '.')
                                             ->replace('-', ' ')
                                             ->ucfirst()
                                            ->explode('.')
                                            ->implode(' ');
                                    @endphp
                                    <x-splade-checkbox
                                        label="{{$name}}"
                                        name="permissions[]"
                                        value="{{$permission['name']}}"
                                    />
                                @endforeach
                            </div>
                        </x-splade-group>
                    </div>
                @endforeach
            </div>

        </x-splade-data>

        <div class="flex justify-start gap-2">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button danger :href="route('admin.roles.destroy', $model->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            <x-tomato-admin-button secondary :href="route('admin.roles.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
