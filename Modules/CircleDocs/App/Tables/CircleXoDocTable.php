<?php

namespace Modules\CircleDocs\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CircleXoDocTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public $query=null)
    {
        if(!$query){
            $this->query = \Modules\CircleDocs\App\Models\CircleXoDoc::query();
        }
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
            ->withGlobalSearch(
                label: trans('tomato-admin::global.search'),
                columns: ['id','name','package',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\CircleDocs\App\Models\CircleXoDoc $model) => $model->delete(),
                after: fn () => Toast::danger(__('CircleXoDoc Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true
            )
            ->column(
                key: 'package',
                label: __('Package'),
                sortable: true
            )
            ->column(
                key: 'about',
                label: __('About'),
                sortable: true
            )
            ->column(
                key: 'repository',
                label: __('Repository'),
                sortable: true
            )
            ->column(
                key: 'branch',
                label: __('Branch'),
                sortable: true
            )
            ->column(
                key: 'readme',
                label: __('Readme'),
                sortable: true
            )
            ->column(
                key: 'is_active',
                label: __('Is active'),
                sortable: true
            )
            ->column(
                key: 'is_public',
                label: __('Is public'),
                sortable: true
            )
            ->column(
                key: 'group',
                label: __('Group'),
                sortable: true
            )
            ->column(
                key: 'account_id',
                label: __('Account id'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
