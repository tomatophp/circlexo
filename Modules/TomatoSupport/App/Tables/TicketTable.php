<?php

namespace Modules\TomatoSupport\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class TicketTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoSupport\App\Models\Ticket::query();
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
                columns: ['id','name','phone','code',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoSupport\App\Models\Ticket $model) => $model->delete(),
                after: fn () => Toast::danger(__('Ticket Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,
                hidden: true
            )

            ->column(
                key: 'accountable.name',
                label: __('Account'),
                sortable: true
            )
            ->column(
                key: 'subject',
                label: __('Subject'),
                sortable: true
            )
            ->column(
                key: 'code',
                label: __('Code'),
                sortable: true
            )
            ->column(
                key: 'type.name',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'is_closed',
                label: __('Is closed'),
                sortable: true
            )

            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
