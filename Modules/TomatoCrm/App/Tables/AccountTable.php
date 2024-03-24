<?php

namespace Modules\TomatoCrm\App\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoCategory\App\Models\Type;
use Modules\TomatoRoles\App\Services\TomatoRoles;

class AccountTable extends AbstractTable
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
       if(!$this->query){
           $this->query = config('tomato-crm.model')::query();
       }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            return auth('web')->user()->can('admin.accounts.index');
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','username','email', 'phone'])
            ->selectFilter('type',
                remote_url: route('admin.types.api', [
                    "for" => "accounts",
                    "type" => "type"
                ]),
                option_label: 'name.'.app()->getLocale(),
                option_value: 'key',
                label: __('Type'))
            ->boolFilter(
                key: 'is_active',
                label: __('Activated')
            )
            ->defaultSort('id')
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'type',
                label: __('Type'),
                sortable: true)
            ->column(
                key: 'email',
                label: __('Email'),
                sortable: true,
                searchable: true,
                hidden: true
            )
            ->column(
                key: 'phone',
                label: __('Phone'),
                searchable: true,
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'is_active',
                label: __('Activated'),
                sortable: true);


        foreach (\Modules\TomatoCrm\App\Facades\TomatoCrm::getTableCols() as $key=>$item){
            $table->column(
                key: $key,
                label: $item,
                sortable: false,
            );
        }

        $table->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
        ->paginate(15);

        if(auth('web')->user() && class_exists(TomatoRoles::class)){
            if(auth('web')->user()->can('admin.accounts.export')){
                $table->export();
            }
            if(auth('web')->user()->can('admin.accounts.destroy')){
                $table->bulkAction(
                    label: trans('tomato-admin::global.crud.delete'),
                    each: function ($model){
                        $model = config('tomato-crm.model')::find($model->id);
                        $model->groups()->detach();
                        $model->delete();
                    },
                    after: fn () => Toast::danger(__('Account Has Been Deleted'))->autoDismiss(2),
                    confirm: true

                );

                $table->bulkAction(
                    label: __('Attach to group'),
                    type: 'modal',
                    href: route('admin.accounts.groups'),
                    style: "primary"
                );
            }
        }
        else {
            $table->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function ($model){
                    $model = config('tomato-crm.model')::find($model->id);
                    $model->groups()->detach();
                    $model->delete();
                },
                after: fn () => Toast::danger(__('Account Has Been Deleted'))->autoDismiss(2),
                confirm: true
            );
            $table->bulkAction(
                label: __('Attach to group'),
                type: 'modal',
                href: route('admin.accounts.groups'),
                style: "primary"
            );
            $table->export();
        }
    }
}
