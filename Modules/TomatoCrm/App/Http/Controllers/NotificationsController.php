<?php

namespace Modules\TomatoCrm\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\TomatoCrm\App\Models\Account;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Services\SendNotification;

class NotificationsController extends Controller
{
    public function index(Request $request){
        return view('tomato-crm::accounts.notifications', [
            "templates" => NotificationsTemplate::where('action', 'manual')->get()
        ]);
    }

    public function user(Request $request, $model){
        $model = config('tomato-crm.model')::find($model);

        return view('tomato-crm::accounts.notifications', [
            "templates" => NotificationsTemplate::where('action', 'manual')->get(),
            "model" => $model
        ]);
    }

    public function send(Request $request){

        if($request->has('use_template') && $request->get('use_template')){
            $request->validate([
                "template_id" => "required|exists:notifications_templates,id",
                "privacy" => "required",
                "providers" => "required|array",
                "providers.*" => "required",
            ]);
            $template = NotificationsTemplate::find($request->get('template_id'));

            if($request->get('privacy') === 'customer'){
                SendNotification::make($request->get('providers'))
                    ->template($template->key)
                    ->model(config('tomato-crm.model'))
                    ->id($request->get('account_id'))
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->privacy('private')
                    ->database(true)
                    ->fire();
            }
            else if($request->get('privacy') === 'group'){
                $group = $request->get('group_id');
                $accounts = config('tomato-crm.model')::whereHas('groups', function ($q) use ($group){
                    $q->where('id', $group);
                })->get();

                foreach($accounts as $account){
                    SendNotification::make($request->get('providers'))
                        ->template($template->key)
                        ->model(config('tomato-crm.model'))
                        ->id($account->id)
                        ->icon('bx bx-user')
                        ->url(url('/'))
                        ->privacy('private')
                        ->database(true)
                        ->fire();
                }
            }
            else {
                SendNotification::make($request->get('providers'))
                    ->template($template->key)
                    ->model(config('tomato-crm.model'))
                    ->privacy('public')
                    ->database(true)
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->fire();
            }

        }
        else {
            $request->validate([
                "privacy" => "required",
                "providers" => "required|array",
                "providers.*" => "required",
                "image" => "required|file",
                "title" => "required|string|max:255",
                "body" => "required|string|max:255",
            ]);

            if($request->hasFile('image')){
                $path = $request->file('image')->store('/notifications/images');
            }
            else {
                $path = null;
            }

            if($request->get('privacy') === 'customer'){
                SendNotification::make($request->get('providers'))
                    ->title($request->get('title'))
                    ->message($request->get('body'))
                    ->type($request->get('type'))
                    ->database(true)
                    ->image($path)
                    ->model(config('tomato-crm.model'))
                    ->id($request->get('account_id'))
                    ->privacy('private')
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->fire();
            }
            else if($request->get('privacy') === 'group'){
                $group = $request->get('group_id');
                $accounts = config('tomato-crm.model')::whereHas('groups', function ($q) use ($group){
                    $q->where('id', $group);
                })->get();

                foreach($accounts as $account){
                    SendNotification::make($request->get('providers'))
                        ->title($request->get('title'))
                        ->message($request->get('body'))
                        ->type($request->get('type'))
                        ->image($path)
                        ->model(config('tomato-crm.model'))
                        ->database(true)
                        ->id($account->id)
                        ->icon('bx bx-user')
                        ->url(url('/'))
                        ->privacy('private')
                        ->fire();
                }
            }
            else {
                SendNotification::make($request->get('providers'))
                    ->title($request->get('title'))
                    ->message($request->get('body'))
                    ->type($request->get('type'))
                    ->image($path)
                    ->model(config('tomato-crm.model'))
                    ->icon('bx bx-user')
                    ->url(url('/'))
                    ->database(true)
                    ->privacy('public')
                    ->fire();
            }
        }


        Toast::title(trans('tomato-notifications::global.templates.send_message'))->success()->autoDismiss(2);
        return back();
    }

}
