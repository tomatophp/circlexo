<?php

namespace Modules\TomatoCategory\App\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class TypeTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public mixed $query=null,
        public bool $withoutFilters=false
    )
    {
        if(!$this->query){
            $this->query = \Modules\TomatoCategory\App\Models\Type::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','name','key',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoCategory\App\Models\Type $model) => $model->delete(),
                after: fn () => Toast::danger(__('Type Has Been Deleted'))->autoDismiss(2),
                confirm: true
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
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'key',
                label: __('Key'),
                sortable: true)
            ->column(
                key: 'icon',
                label: __('Icon'),
                sortable: true)
            ->column(
                key: 'color',
                label: __('Color'),
                sortable: true)



            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);

        if(!$this->withoutFilters){
            $forArray = [];
            foreach (config('tomato-category.for') as $key => $value) {
                $forArray[$key] = $value[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? "";
            }
            $typesArray = [];
            foreach (config('tomato-category.types') as $key => $value) {
                $typesArray[$key] = $value[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()]  ?? "";
            }

            $table->selectFilter(
                key: 'for',
                label: __('Filter By For'),
                options: $forArray,
            )
            ->selectFilter(
                key: 'type',
                label: __('Filter By Type'),
                options: $typesArray,
            );
        }
    }
}
