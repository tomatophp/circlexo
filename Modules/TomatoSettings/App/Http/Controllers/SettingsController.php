<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\SitesSettings;

class SettingsController extends Setting
{
    public string $setting = SitesSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('tomato-settings::index');
    }
}
