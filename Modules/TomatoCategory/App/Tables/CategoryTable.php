<?php

namespace Modules\TomatoCategory\App\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CategoryTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public ?Builder $query=null
    )
    {
        if(!$this->query){
            $this->query = \Modules\TomatoCategory\App\Models\Category::query();
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
        $typesArray = [];
        foreach (config('tomato-category.for') as $key => $value) {
            $typesArray[$key] = $value[\Illuminate\Support\Str::of(app()->getLocale())->remove(' ')->toString()] ?? "";
        }
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','parent.name','name','slug',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (\Modules\TomatoCategory\App\Models\Category $model) => $model->delete(),
                after: fn () => Toast::danger(__('Category Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->selectFilter(
                key: 'for',
                label: __('Filter By For'),
                options: $typesArray,
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('ID'),
                sortable: true,
                hidden: true
            )
            ->column(
                key: 'name',
                label: __('Name'),
                sortable: true)
            ->column(
                key: 'icon',
                label: __('Icon'),
                sortable: true)
            ->column(
                key: 'color',
                label: __('Color'),
                sortable: true)
            ->column(
                key: 'activated',
                label: __('Active?'),
                sortable: true)
            ->column(
                key: 'menu',
                label: __('Show On Menu'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
