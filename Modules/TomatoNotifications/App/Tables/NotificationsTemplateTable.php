<?php

namespace Modules\TomatoNotifications\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class NotificationsTemplateTable extends AbstractTable
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
        return \Modules\TomatoNotifications\App\Models\NotificationsTemplate::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','key'])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoNotifications\App\Models\NotificationsTemplate $model) => $model->delete(),
                after: fn () => Toast::danger(trans('tomato-notifications::global.templates.delete'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: 'id', label: trans('tomato-notifications::global.templates.id'), sortable: true)
            ->column(key: 'key',label: trans('tomato-notifications::global.templates.key'), sortable: true)
            ->column(key: 'name',label: trans('tomato-notifications::global.templates.name'), sortable: true)
            ->column(key: 'type',label: trans('tomato-notifications::global.templates.type'), sortable: true)
            ->column(key: 'action',label: trans('tomato-notifications::global.templates.action'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
