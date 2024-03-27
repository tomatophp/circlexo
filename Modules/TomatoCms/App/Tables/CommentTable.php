<?php

namespace Modules\TomatoCms\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoCms\App\Models\Comment;

class CommentTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(mixed $query=null)
    {
        if($query){
            $this->query = $query;
        }
        else {
            $this->query = \Modules\TomatoCms\App\Models\Comment::query();
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
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','customer.id','post.title',])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: fn (Comment $model) => $model->delete(),
                after: fn () => Toast::danger(__('Comment Has Been Deleted'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(
                key: 'id',
                label: __('Id'),
                sortable: true)
            ->column(
                key: 'account.name',
                label: __('Customer'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'post.title',
                label: __('Post'),
                sortable: true,
                searchable: true)
            ->column(
                key: 'comment',
                label: __('Comment'),
                sortable: true)
            ->column(
                key: 'activated',
                label: __('Activated'),
                sortable: true)
            ->column(key: 'actions',label: trans('tomato-admin::global.crud.actions'))
            ->paginate(15);
    }
}
