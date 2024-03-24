<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoSettings\App\Http\Requests\Settings\GoogleSettingsRequest;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\GoogleSettings;

class GoogleRecapSettingsController extends Setting
{
    public string $setting = GoogleSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-settings::settings.google-recap');
    }

    /**
     * @param GoogleSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(GoogleSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.google-recap.index", media:[
            'google_firebase_cr'
        ]);
    }
}
