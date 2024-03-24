<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoSettings\App\Http\Requests\Settings\EmailSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\EmailSettings;

class EmailSettingsController extends Setting
{
    public string $setting = EmailSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-settings::settings.email');
    }

    /**
     * @param EmailSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(EmailSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.email.index", media:[]);
    }
}
