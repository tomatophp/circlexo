<?php

namespace Modules\TomatoForms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Database\Eloquent\Builder;

class FormRequestTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public Builder|null $query=null)
    {
        if(!$query){
            $this->query = \Modules\TomatoForms\App\Models\FormRequest::query();
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
                columns: ['id',]
            )
            ->selectFilter(key:'form_id', options: \Modules\TomatoForms\App\Models\Form::pluck('name', 'id')->toArray(), label: __('Filter By Form'))
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoForms\App\Models\FormRequest $model) => $model->delete(),
                after: fn () => Toast::danger(__('FormRequest Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->defaultSort('id', 'desc')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true
            )
            ->column(
                key: 'form.name',
                label: __('Form id'),
                sortable: true
            )
            ->column(
                key: 'user',
                label: __('User'),
                sortable: false
            )
            ->column(
                key: 'status',
                label: __('Status'),
                sortable: true
            )
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->export()
            ->paginate(10);
    }
}
