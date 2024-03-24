<?php

namespace Modules\TomatoCrm\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class LocationTable extends AbstractTable
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
            $this->query = \Modules\TomatoCrm\App\Models\Location::query();
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
            return auth('web')->user()->can('admin.locations.index');
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','account.name',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoCrm\App\Models\Location $model) => $model->delete(),
                after: fn () => Toast::danger(__('Location Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->selectFilter(
                key:'account_id',
                option_label: "name",
                option_value: "id",
                remote_root: "data",
                remote_url: route('admin.accounts.api')
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'account.name',
                label: __('Account'),
                sortable: false,
                searchable: true)
            ->column(
                key: 'street',
                label: __('Street'),
                sortable: true)
            ->column(
                key: 'area.name',
                label: __('Area'),
                sortable: false)
            ->column(
                key: 'city.name',
                label: __('City'),
                sortable: false)
            ->column(
                key: 'country.name',
                label: __('Country'),
                sortable: false)
            ->column(
                key: 'is_main',
                label: __('Is Main?'),
                sortable: false)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
