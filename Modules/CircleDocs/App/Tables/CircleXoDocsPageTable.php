<?php

namespace Modules\CircleDocs\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CircleXoDocsPageTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public $query=null)
    {
        if(!$query){
            $this->query = \Modules\CircleDocs\App\Models\CircleXoDocsPage::query();
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
                columns: ['id',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\CircleDocs\App\Models\CircleXoDocsPage $model) => $model->delete(),
                after: fn () => Toast::danger(__('CircleXoDocsPage Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'title',
                label: __('Title'),
                sortable: true
            )
            ->column(
                key: 'description',
                label: __('Description'),
                sortable: true
            )
            ->column(
                key: 'body',
                label: __('Body'),
                sortable: true
            )
            ->column(
                key: 'parent_id',
                label: __('Parent id'),
                sortable: true
            )
            ->column(
                key: 'icon',
                label: __('Icon'),
                sortable: true
            )
            ->column(
                key: 'color',
                label: __('Color'),
                sortable: true
            )
            ->column(
                key: 'slug',
                label: __('Slug'),
                sortable: true
            )
            ->column(
                key: 'doc_id',
                label: __('Doc id'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
