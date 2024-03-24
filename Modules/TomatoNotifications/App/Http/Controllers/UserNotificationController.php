<?php

namespace Modules\TomatoNotifications\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoNotifications\App\Http\Requests\UserNotification\UserNotificationStoreRequest;
use Modules\TomatoNotifications\App\Http\Requests\UserNotification\UserNotificationUpdateRequest;
use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Models\UserNotification;
use Modules\TomatoNotifications\App\Services\SendNotification;
use Modules\TomatoNotifications\App\Tables\UserNotificationTable;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class UserNotificationController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: UserNotification::class,
            view: 'tomato-notifications::user-notifications.index',
            table: UserNotificationTable::class,
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: UserNotification::class,
        );
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request, $model): mixed
    {
        $getModel = config('tomato-notifications.models')[$model];

        return $getModel::all()->pluck('name', 'id');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-notifications::user-notifications.create',
            data: [
                "templates" => NotificationsTemplate::all()
            ]
        );
    }

    /**
     * @param UserNotificationStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserNotificationStoreRequest $request): RedirectResponse
    {
        $request->validated();

        $template = NotificationsTemplate::find($request->get('template_id'));

        $notification = new UserNotification();
        $notification->title = $template->title;
        $notification->template_id = $template->id;
        $notification->description = $template->body;
        $notification->type = $template->type;
        $notification->privacy = $request->get('privacy');
        $notification->model_id = $request->get('model_id');
        $notification->model_type = config('tomato-notifications.models')[$request->get('model_type')];
        $notification->icon = $template->icon;
        $notification->url = $template->url;
        $notification->created_by = auth()->user()->id;
        $notification->save();

        SendNotification::make($template->providers)
            ->title($template->title)
            ->template($template->key)
            ->database(false)
            ->privacy($request->get('privacy'))
            ->model(config('tomato-notifications.models')[$request->get('model_type')])
            ->id($request->get('model_id'))
            ->fire();


        Toast::title(trans('tomato-notifications::global.notifications.success'))->success()->autoDismiss(2);
        return redirect()->route('admin.user-notifications.index');
    }

    /**
     * @param UserNotification $model
     * @return View
     */
    public function show(UserNotification $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-notifications::user-notifications.show',
        );
    }

    /**
     * @param UserNotification $model
     * @return RedirectResponse
     */
    public function destroy(UserNotification $model): RedirectResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: 'UserNotification deleted successfully',
            redirect: 'admin.user-notifications.index',
        );

        return back();
    }

    /**
     * @param UserNotification $model
     * @return RedirectResponse
     */
    public function resend(UserNotification $model):RedirectResponse
    {

        $template = NotificationsTemplate::find($model->template_id);

        $notification = new UserNotification();
        $notification->title = $template->title;
        $notification->template_id = $template->id;
        $notification->description = $template->body;
        $notification->type = $template->type;
        $notification->privacy = $model->privacy;
        $notification->model_id = $model->model_id;
        $notification->model_type = $model->model_type;
        $notification->icon = $template->icon;
        $notification->url = $template->url;
        $notification->created_by = auth()->user()->id;
        $notification->save();

        SendNotification::make($template->providers)
            ->title($template->title)
            ->template($template->key)
            ->database(false)
            ->privacy($model->privacy)
            ->model($model->model_type)
            ->id($model->model_id)
            ->fire();


        Toast::title(trans('tomato-notifications::global.notifications.success'))->success()->autoDismiss(2);
        return redirect()->route('admin.user-notifications.index');
    }
}
