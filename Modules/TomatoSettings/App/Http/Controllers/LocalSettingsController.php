<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\SitesSettings;

class LocalSettingsController extends Setting
{
    public string $setting = SitesSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-settings::settings.location');
    }

    /**
     * @param SiteSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(SiteSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.local.index", media:[
            "site_profile",
            "site_logo"
        ]);
    }
}
