<?php

namespace Modules\CircleXO\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Account;
use Modules\CircleXO\App\Models\AccountContact;
use Modules\CircleXO\App\Models\AccountListing;
use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Models\UserToken;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileActionsController extends Controller
{
    public function follow($account)
    {
        $account = Account::where('username', $account)->first();

        if($account){
            if($account->id == auth('accounts')->id()){
                Toast::danger('You cannot follow yourself')->autoDismiss(2);
                return back();
            }

            auth('accounts')->user()->follow($account);

            $account->notifyDB(
                message: __(auth('accounts')->user()->username . " " . __('is now following you')),
                title: __('New Follower'),
                url: url(auth('accounts')->user()->username)
            );

            Toast::success('You are now following ' . $account->name)->autoDismiss(2);
            return back();
        }
        else {
            abort(404);
        }
    }

    public function unfollow($account)
    {
        $account = Account::where('username', $account)->first();

        if($account){
            if($account->id == auth('accounts')->id()){
                Toast::danger('You cannot unfollow yourself')->autoDismiss(2);
                return back();
            }

            auth('accounts')->user()->unfollow($account);

            $account->notifyDB(
                message: __(auth('accounts')->user()->username . " " . __('is remove you from following list')),
                title: __('UnFollower'),
                url: url(auth('accounts')->user()->username)
            );

            Toast::success('You are now unfollowing ' . $account->name)->autoDismiss(2);
            return back();
        }
        else {
            abort(404);
        }
    }
}
