<?php

namespace Modules\TomatoSettings\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoPHP\Services\Tomato;
use Modules\TomatoSettings\App\Http\Requests\Settings\PaymentsSettingsRequest;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\PaymentsSettings;
use Modules\TomatoSettings\App\Settings\SitesSettings;

class PaymentsSettingsController extends Setting
{
    public string $setting = PaymentsSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-settings::settings.payments');
    }

    /**
     * @param PaymentsSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(PaymentsSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.payments.index", media:[]);
    }
}
