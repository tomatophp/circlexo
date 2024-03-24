<?php

namespace Modules\TomatoCrm\App\Tables;

use Illuminate\Http\Request;
use Modules\TomatoCrm\App\Models\Group;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class GroupTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query = null)
    {
        if(!$query){
            $this->query = Group::query();
        }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if(auth('web')->user()){
            return auth('web')->user()->can('admin.groups.index');
        }
        else {
            return true;
        }
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return $this->query;
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
                each: fn (\Modules\TomatoCrm\App\Models\Group $model) => $model->delete(),
                after: fn () => Toast::danger(__('Group Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'icon',
                label: __('Icon'),
                sortable: true)
            ->column(
                key: 'color',
                label: __('Color'),
                sortable: true)
            ->column(
                key: 'id',
                label: __('ID'),
                hidden: true,
                sortable: true)
            ->defaultSort('id', 'desc')
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))

            ->paginate(15);
    }
}
