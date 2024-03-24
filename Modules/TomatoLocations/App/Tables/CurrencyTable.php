<?php

namespace Modules\TomatoLocations\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CurrencyTable extends AbstractTable
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
        return \Modules\TomatoLocations\App\Models\Currency::query();
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
                each: fn (\Modules\TomatoLocations\App\Models\Currency $model) => $model->delete(),
                after: fn () => Toast::danger(trans('tomato-locations::global.currency.message.delete'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-locations::global.currency.id'), sortable: true)
            ->column(key: "name",label: trans('tomato-locations::global.currency.name'), sortable: true)
            ->column(key: "symbol",label: __('Symbol'), sortable: true)
            ->column(key: "exchange_rate",label: __('Exchange Rate'), sortable: true)
            ->column(key: "iso",label: trans('tomato-locations::global.currency.iso'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
