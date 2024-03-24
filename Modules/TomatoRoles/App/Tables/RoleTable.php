<?php

namespace Modules\TomatoRoles\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\Permission\Models\Role;

class RoleTable extends AbstractTable
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
        return Role::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function (Role $model) {
                    $model->syncPermissions([]);
                    $model->delete();
                },
                after: fn () => Toast::danger(trans('tomato-roles::global.roles.message.deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-roles::global.roles.id'), sortable: true)
            ->column(key: "name",label: trans('tomato-roles::global.roles.name'), sortable: true)
            ->column(key: 'guard_name', label: trans('tomato-roles::global.roles.guard_name'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-roles::global.roles.actions'))
            ->paginate(15);
    }
}
