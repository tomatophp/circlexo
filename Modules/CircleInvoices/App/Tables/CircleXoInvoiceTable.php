<?php

namespace Modules\CircleInvoices\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CircleXoInvoiceTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public $query=null)
    {
        if(!$query){
            $this->query = \Modules\CircleInvoices\App\Models\CircleXoInvoice::query();
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
                columns: ['id','uuid','name','email','phone',]
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\CircleInvoices\App\Models\CircleXoInvoice $model) => $model->delete(),
                after: fn () => Toast::danger(__('CircleXoInvoice Has Been Deleted'))->autoDismiss(2),
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
                key: 'uuid',
                label: __('Uuid'),
                sortable: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true
            )
            ->column(
                key: 'email',
                label: __('Email'),
                sortable: true
            )
            ->column(
                key: 'phone',
                label: __('Phone'),
                sortable: true
            )
            ->column(
                key: 'address',
                label: __('Address'),
                sortable: true
            )
            ->column(
                key: 'company',
                label: __('Company'),
                sortable: true
            )
            ->column(
                key: 'contact_id',
                label: __('Contact id'),
                sortable: true
            )
            ->column(
                key: 'due_date',
                label: __('Due date'),
                sortable: true
            )
            ->column(
                key: 'invoice_date',
                label: __('Invoice date'),
                sortable: true
            )
            ->column(
                key: 'paid_amount',
                label: __('Paid amount'),
                sortable: true
            )
            ->column(
                key: 'payment_method',
                label: __('Payment method'),
                sortable: true
            )
            ->column(
                key: 'payment_method_details',
                label: __('Payment method details'),
                sortable: true
            )
            ->column(
                key: 'total',
                label: __('Total'),
                sortable: true
            )
            ->column(
                key: 'shipping',
                label: __('Shipping'),
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
                key: 'type',
                label: __('Type'),
                sortable: true
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(
                key: 'currency',
                label: __('Currency'),
                sortable: true
            )
            ->column(
                key: 'notes',
                label: __('Notes'),
                sortable: true
            )
            ->column(
                key: 'template',
                label: __('Template'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
