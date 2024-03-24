<?php

namespace Modules\TomatoNotifications\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoNotifications\App\Http\Requests\NotificationsTemplate\NotificationsTemplateStoreRequest;
use Modules\TomatoNotifications\App\Http\Requests\NotificationsTemplate\NotificationsTemplateUpdateRequest;
use Modules\TomatoNotifications\App\Models\NotificationsTemplate;
use Modules\TomatoNotifications\App\Services\SendNotification;
use Modules\TomatoNotifications\App\Tables\NotificationsTemplateTable;

class NotificationsTemplateController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = NotificationsTemplate::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-notifications::notifications-templates.index',
            table: NotificationsTemplateTable::class,
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
            model: NotificationsTemplate::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-notifications::notifications-templates.create',
        );
    }

    /**
     * @param NotificationsTemplateStoreRequest $request
     * @return RedirectResponse
     */
    public function store(NotificationsTemplateStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: NotificationsTemplate::class,
            message: 'NotificationsTemplate created successfully',
            redirect: 'admin.notifications-templates.index',
            hasMedia: (request()->hasFile('image')) ? true : false,
            collection: [
                'image' => false
            ],
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param NotificationsTemplate $model
     * @return View
     */
    public function show(NotificationsTemplate $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-notifications::notifications-templates.show',
            hasMedia: true,
            collection: ['image'],
        );
    }

    /**
     * @param NotificationsTemplate $model
     * @return View
     */
    public function edit(NotificationsTemplate $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-notifications::notifications-templates.edit',
            hasMedia: true,
            collection: [
                'image' => false
            ],
        );
    }

    /**
     * @param NotificationsTemplateUpdateRequest $request
     * @param NotificationsTemplate $model
     * @return RedirectResponse
     */
    public function update(NotificationsTemplateUpdateRequest $request, NotificationsTemplate $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: 'NotificationsTemplate updated successfully',
            redirect: 'admin.notifications-templates.index',
            hasMedia: (request()->hasFile('image')) ? true : false,
            collection: [
                'image' => false
            ],
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param NotificationsTemplate $model
     * @return RedirectResponse
     */
    public function destroy(NotificationsTemplate $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: 'NotificationsTemplate deleted successfully',
            redirect: 'admin.notifications-templates.index',
            collection: [
                'image' => false
            ],
        );

        if ($response instanceof JsonResponse) {
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param NotificationsTemplate $template
     * @return RedirectResponse
     */
    public function send(NotificationsTemplate $template): RedirectResponse
    {
        $matchesTitle = array();
        preg_match('/{.*?}/', $template->title, $matchesTitle);
        $titleFill = [];
        foreach ($matchesTitle as $titleItem) {
            $titleFill[] = "test-title";
        }
        $matchesBody = array();
        preg_match('/{.*?}/', $template->body, $matchesBody);
        $titleBody = [];
        foreach ($matchesBody as $bodyItem) {
            $titleBody[] = "test-body";
        }

        try {
            SendNotification::make($template->providers)
                ->template($template->key)
                ->findTitle($matchesTitle)
                ->replaceTitle($titleFill)
                ->findBody($matchesBody)
                ->replaceBody($titleBody)
                ->model(User::class)
                ->id(User::first()->id)
                ->privacy('private')
                ->fire();

        }catch (\Exception $exception){
            Toast::danger(__('Please Check Your Provider Settings'))->autoDismiss(2);
            return back();
        }
        Toast::title(trans('tomato-notifications::global.templates.send_message'))->success()->autoDismiss(2);
        return back();
    }
}
