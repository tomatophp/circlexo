<?php

namespace Modules\TomatoCrm\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class ContactTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public mixed $query = null
    )
    {
        if(!$query){
            $this->query = \Modules\TomatoCrm\App\Models\Contact::query();
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
            return auth('web')->user()->can('admin.contacts.index');
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','type.name','status.name','name','email','phone',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoCrm\App\Models\Contact $model) => $model->delete(),
                after: fn () => Toast::danger(__('Contact Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->boolFilter(
                label: __('Is Active?'),
                key: 'active',
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'type.name',
                label: __('Type'),
                sortable: false
            )
            ->column(
                key: 'status.name',
                label: __('Status'),
                sortable: false
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'subject',
                label: __('Subject'),
                sortable: true)
            ->column(
                key: 'active',
                label: __('Active'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
