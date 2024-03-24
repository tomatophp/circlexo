<?php

namespace Modules\TomatoNotifications\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class NotificationsLogTable extends AbstractTable
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
        return \Modules\TomatoNotifications\App\Models\NotificationsLogs::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoNotifications\App\Models\NotificationsLogs $model) => $model->delete(),
                after: fn () => Toast::danger(trans('tomato-notifications::global.logs.delete'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->column(key: "Id",label: trans('tomato-notifications::global.logs.id'), sortable: true, hidden: true)
            ->column(key: "model.name",label: trans('tomato-notifications::global.notifications.model_type'), sortable: true)
            ->column(key: "title",label: trans('tomato-notifications::global.templates.title'), sortable: true)
            ->column(key: "description",label: trans('tomato-notifications::global.templates.body'), sortable: true)
            ->column(key: "type",label: trans('tomato-notifications::global.templates.type'), sortable: true)
            ->column(key: "provider",label: trans('tomato-notifications::global.logs.provider'), sortable: true)
            ->column(key: "created_at",label: trans('tomato-notifications::global.logs.since'), sortable: true)

            ->paginate(15);
    }
}
