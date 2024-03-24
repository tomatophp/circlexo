<?php

namespace Modules\TomatoNotifications\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class UserNotificationTable extends AbstractTable
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
        return \Modules\TomatoNotifications\App\Models\UserNotification::query();
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
                each: fn (\Modules\TomatoNotifications\App\Models\UserNotification $model) => $model->delete(),
                after: fn () => Toast::danger(trans('tomato-notifications::global.notifications.delete'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id','desc')
            ->column(key: "id", label: trans('tomato-notifications::global.templates.id'), sortable: true)
            ->column(key: "model.name", label: trans('tomato-notifications::global.notifications.model_type'), sortable: true)
            ->column(key: "title", label: trans('tomato-notifications::global.templates.title'), sortable: true)
            ->column(key: "type", label: trans('tomato-notifications::global.templates.type'), sortable: true)
            ->column(key: "privacy", label: trans('tomato-notifications::global.notifications.privacy'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
