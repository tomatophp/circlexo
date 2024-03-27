<?php

namespace Modules\TomatoCms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class PortfolioTable extends AbstractTable
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
        return \Modules\TomatoCms\App\Models\Portfolio::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','service.name',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\Cms\Entities\Portfolio $model) => $model->delete(),
                after: fn () => Toast::danger(__('Portfolio Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true)
            ->column(
                key: 'service.name',
                label: __('Service'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'title',
                label: __('Title'),
                sortable: true)
            ->column(
                key: 'activated',
                label: __('Activated'),
                sortable: true)
            ->column(
                key: 'views',
                label: __('Views'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
