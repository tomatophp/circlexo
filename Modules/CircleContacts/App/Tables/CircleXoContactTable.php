<?php

namespace Modules\CircleContacts\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class CircleXoContactTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public $query=null)
    {
        if(!$query){
            $this->query = \Modules\CircleContacts\App\Models\CircleXoContact::query();
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
                columns: ['id','name','email','phone']
            )
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function(\Modules\CircleContacts\App\Models\CircleXoContact $model){
                    $model->contactMeta()->delete();
                    $model->groups()->detach();
                    $model->delete();
                },
                after: fn () => Toast::danger(__('Contact Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                canBeHidden: false,
                sortable: true,

            )
            ->column(
                key: 'name',
                label: __('Name'),
                canBeHidden: false,
                sortable: true,
            )
            ->column(
                key: 'email',
                label: __('Email'),
                canBeHidden: false,
                sortable: true
            )
            ->column(
                key: 'phone',
                label: __('Phone'),
                canBeHidden: false,
                sortable: true
            )
            ->column(
                key: 'address',
                label: __('Address'),
                canBeHidden: false,
                sortable: true
            )
            ->column(
                key: 'company',
                label: __('Company'),
                canBeHidden: false,
                sortable: true
            )
            ->column(
                key: 'type',
                label: __('Type'),
                canBeHidden: false,
                sortable: true
            )
            ->export()
            ->paginate(8);
    }
}
