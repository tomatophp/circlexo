<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoPHP\Services\Tomato;
use Modules\TomatoSettings\App\Http\Requests\Settings\ServicesSettingsRequest;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\ServicesSettings;
use Modules\TomatoSettings\App\Settings\SitesSettings;

class SMSServicesSettingsController extends Setting
{
    public string $setting = ServicesSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-settings::settings.services-sms');
    }

    /**
     * @param ServicesSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(ServicesSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.services-sms.index", media:[]);
    }
}
