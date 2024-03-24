<?php

namespace Modules\TomatoNotifications\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoNotifications\App\Http\Requests\NotificationsLog\NotificationsLogStoreRequest;
use Modules\TomatoNotifications\App\Http\Requests\NotificationsLog\NotificationsLogUpdateRequest;
use Modules\TomatoNotifications\App\Models\NotificationsLogs;
use Modules\TomatoNotifications\App\Tables\NotificationsLogTable;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class NotificationsLogController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return Tomato::index(
            request: $request,
            model: NotificationsLogs::class,
            view: 'tomato-notifications::notifications-logs.index',
            table: NotificationsLogTable::class,
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
            model: NotificationsLogs::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-notifications::notifications-logs.create',
        );
    }

    /**
     * @param NotificationsLogStoreRequest $request
     * @return RedirectResponse
     */
    public function store(NotificationsLogStoreRequest $request): RedirectResponse
    {
        $response = Tomato::store(
            request: $request,
            model: NotificationsLogs::class,
            message: 'NotificationsLog created successfully',
            redirect: 'admin.notifications-logs.index',
        );

        return $response['redirect'];
    }

    /**
     * @param NotificationsLogs $model
     * @return View
     */
    public function show(NotificationsLogs $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-notifications::notifications-logs.show',
        );
    }

    /**
     * @param NotificationsLogs $model
     * @return View
     */
    public function edit(NotificationsLogs $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-notifications::notifications-logs.edit',
        );
    }

    /**
     * @param NotificationsLogUpdateRequest $request
     * @param NotificationsLogs $model
     * @return RedirectResponse
     */
    public function update(NotificationsLogUpdateRequest $request, NotificationsLogs $model): RedirectResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: 'NotificationsLog updated successfully',
            redirect: 'admin.notifications-logs.index',
        );

        return $response['redirect'];
    }

    /**
     * @param NotificationsLogs $model
     * @return RedirectResponse
     */
    public function destroy(NotificationsLogs $model): RedirectResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: 'NotificationsLog deleted successfully',
            redirect: 'admin.notifications-logs.index',
        );

        return $response->redirect;
    }

    public function clear(){
        NotificationsLogs::truncate();

        Toast::success(__('tomato-notifications::global.logs.delete'))->autoDismiss(2);
        return redirect()->back();
    }
}
