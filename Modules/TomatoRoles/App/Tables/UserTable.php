<?php

namespace Modules\TomatoRoles\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\Permission\Models\Role;

class UserTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return \App\Models\User::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $roles = Role::all();

        $table
            ->selectFilter(
                key: 'roles.id',
                options: $roles->pluck('name', 'id')->toArray(),
                label: trans('tomato-roles::global.users.roles'),
                noFilterOption: true,
                noFilterOptionLabel: trans('tomato-roles::global.users.filters.roles')
            )
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','email',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function (\App\Models\User $model){
                    $model->roles()->sync([]);
                    $model->delete();
                },
                after: fn () => Toast::danger(trans('tomato-roles::global.users.messages.deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-roles::global.users.id'), sortable: true)
            ->column(key: "name",label: trans('tomato-roles::global.users.name'), sortable: true)
            ->column(key: "email",label: trans('tomato-roles::global.users.email'), sortable: true)
            ->column(key: 'roles.name', label: trans('tomato-roles::global.users.roles'), sortable: true)
            ->column(key: "actions",label:  trans('tomato-roles::global.users.actions'))
            ->paginate(15);
    }
}
