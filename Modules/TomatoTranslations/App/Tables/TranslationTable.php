<?php

namespace Modules\TomatoTranslations\App\Tables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoTranslations\App\Models\Translation;
use Spatie\Permission\Models\Role;

class TranslationTable extends AbstractTable
{
    /**
     * Create a new instan        $form .= "                      {{__('".Str::ucfirst(str_replace('_', ' ', $name))."')}}".PHP_EOL;
ce.
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
        return Translation::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','key',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function (Role $model) {
                    $model->syncPermissions([]);
                    $model->delete();
                },
                after: fn () => Toast::danger(trans('tomato-translations::global.message.deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-translations::global.id'), sortable: true, hidden: true)
            ->column(key: "key",label: trans('tomato-translations::global.key'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-roles::global.roles.actions'))
            ->paginate(15);
    }
}
