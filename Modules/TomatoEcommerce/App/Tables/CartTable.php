<?php

namespace Modules\TomatoEcommerce\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CartTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoEcommerce\App\Models\Cart::query();
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
                each: fn (\Modules\TomatoEcommerce\App\Models\Cart $model) => $model->delete(),
                after: fn () => Toast::danger(__('Cart Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'account_id',
                label: __('Account id'),
                sortable: true
            )
            ->column(
                key: 'product_id',
                label: __('Product id'),
                sortable: true
            )
            ->column(
                key: 'session_id',
                label: __('Session id'),
                sortable: true
            )
            ->column(
                key: 'item',
                label: __('Item'),
                sortable: true
            )
            ->column(
                key: 'price',
                label: __('Price'),
                sortable: true
            )
            ->column(
                key: 'discount',
                label: __('Discount'),
                sortable: true
            )
            ->column(
                key: 'vat',
                label: __('Vat'),
                sortable: true
            )
            ->column(
                key: 'qty',
                label: __('Qty'),
                sortable: true
            )
            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->column(
                key: 'note',
                label: __('Note'),
                sortable: true
            )
            ->column(
                key: 'options',
                label: __('Options'),
                sortable: true
            )
            ->column(
                key: 'is_active',
                label: __('Is active'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
