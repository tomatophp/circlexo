<?php

namespace Modules\TomatoLocations\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\TomatoLocations\App\Http\Requests\Settings\LocationsSettingsRequest;
use Modules\TomatoLocations\App\Models\Country;
use Modules\TomatoLocations\App\Settings\LocationsSettings;
use Modules\TomatoSettings\App\Http\Requests\Settings\GoogleSettingsRequest;
use Modules\TomatoSettings\App\Http\Requests\Settings\SiteSettingsRequest;
use Modules\TomatoSettings\App\Services\Setting;
use Modules\TomatoSettings\App\Settings\GoogleSettings;

class LocationSettingsController extends Setting
{
    public string $setting = LocationsSettings::class;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->get(request: $request, view:'tomato-locations::settings.location');
    }

    /**
     * @param LocationsSettingsRequest $request
     * @return RedirectResponse
     */
    public function store(LocationsSettingsRequest $request): RedirectResponse
    {
        return $this->save(request: $request, redirect: "admin.settings.locations.index");
    }
}
