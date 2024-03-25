<?php

namespace App\Tables;

use Illuminate\Http\Request;
use Modules\CircleXO\App\Models\AccountContact;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AccountContactTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(
        public int $accountId
    )
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
        return AccountContact::query()->where('account_id', $this->accountId)->orderBy('id','desc');
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
            ->withGlobalSearch(columns: ['id'])
            ->column('name', sortable: true)
            ->column('email', sortable: true)
            ->column('anonymous_message', sortable: true)
            ->rowModal(function ($item) {
                return route('profile.messages.show', $item);
            })
            ->export();
    }
}
