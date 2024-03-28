<?php

namespace Modules\TomatoNotifications\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoNotifications\App\Http\Requests\Settings\NotificationsSettingsRequest;
use Modules\TomatoNotifications\App\Settings\NotificationsSettings;
use Modules\TomatoSettings\App\Services\Setting;


class NotificationsSettingsController extends Setting
{
    public string $setting = NotificationsSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-notifications::settings.notifications');
    }

    /**
     * @param NotificationsSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(NotificationsSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.notifications.index", media:[]);
    }
}
