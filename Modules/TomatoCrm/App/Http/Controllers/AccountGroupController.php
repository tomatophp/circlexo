<?php

namespace Modules\TomatoCrm\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\TomatoCrm\App\Models\Account;
use Modules\TomatoCrm\App\Models\Group;
use ProtoneMedia\Splade\Facades\Toast;

class AccountGroupController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
        ]);

        // TODO:: check vendor here
        return view('tomato-crm::groups.index', [
            'accounts' => config('tomato-crm.model')::whereIn('id', $request->ids)->select('id', 'name')->get(),
            'groups' => Group::all(),
            'ids' => $request->ids,
        ]);
    }

    public function assign(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'group' => 'required',
        ]);

        $group = Group::where('id', $request->group)->firstOrFail();
        $group->accounts()->syncWithoutDetaching($request->ids);

        Toast::success(__('Accounts has been assigned successfully'))->autoDismiss(3);
        return to_route('admin.groups.index');
    }

    public function block(Account $account){
        $account->is_blocked = !$account->is_blocked;
        $account->save();

        Toast::success(__('Account status has been changed successfully'))->autoDismiss(3);
        return back();
    }
}
