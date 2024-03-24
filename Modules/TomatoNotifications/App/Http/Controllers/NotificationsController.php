<?php

namespace Modules\TomatoNotifications\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Models\UserToken;

class NotificationsController extends Controller
{
    public function index()
    {
        $notification = UserNotification::where('model_type',User::class)
            ->where('model_id', auth()->user()->id)
            ->orWhere('model_id', null)
            ->orderBy('id', 'desc')
            ->paginate(5);

        foreach ($notification as $item) {
            $item->date = $item->created_at->diffForHumans();
            if ($item->template_id) {
                $template = NotificationsTemplate::find($item->template_id);
                $item->image = count($template->getMedia('image')) ? $template->getMedia('image')->first()->getUrl() : url('images/default.png');
            }
        }
        return view('tomato-notifications::user-notifications.user', [
            "notifications" => $notification
        ]);
    }

    public function show(UserNotification $model)
    {
        $model->read();
        $model->date = $model->created_at->diffForHumans();
        if ($model->template_id) {
            $template = NotificationsTemplate::find($model->template_id);
            $model->image = count($template->getMedia('image')) ? $template->getMedia('image')->first()->getUrl() : url('images/default.png');
        }
        return view('tomato-notifications::user-notifications.user-show', [
            "model" => $model
        ]);
    }

    public function clearUser(): \Illuminate\Http\RedirectResponse
    {
        UserNotification::where('model_type',User::class)
            ->where('model_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->take(10)->delete();

        Toast::title(trans('tomato-notifications::global.notifications.success'))->success()->autoDismiss(2);
        return redirect()->back();
    }

    public function read()
    {
        $notifications = UserNotification::where('model_type',User::class)
            ->where('model_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->take(10)->get();

        foreach ($notifications as $notification){
            $notification->read();
        }

        Toast::title(__('Notifications is marked as read'))->success()->autoDismiss(2);
        return redirect()->back();
    }

    public function readSelected(UserNotification $model)
    {
        $model->read();

        Toast::title(__('Notifications is marked as read'))->success()->autoDismiss(2);
        return redirect()->back();
    }

    public function destroy(UserNotification $model)
    {
        $model->delete();

        Toast::title(__('Notifications is marked as read'))->success()->autoDismiss(2);
        return redirect()->route('admin.notifications.index');
    }

    public function token(Request $request)
    {
        $request->validate([
            "token" => "required|string",
            "provider" => "required|string",
            "model" => "required|string",
            "model_id" => "required"
        ]);

        $checkEx = UserToken::where('model_type', $request->get('model'))
            ->where('model_id', $request->get('model_id'))
            ->where('provider', $request->get('provider'))
            ->first();

        if (!$checkEx) {
            $token = new UserToken();
            $token->model_type = $request->get('model');
            $token->model_id = $request->get('model_id');
            $token->provider = $request->get('provider');
            $token->provider_token = $request->get('token');
            $token->save();

            return back();
        } else {
            $checkEx->provider_token = $request->get('token');
            $checkEx->save();

            return back();
        }
    }
}
