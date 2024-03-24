<?php

namespace Modules\TomatoSettings\App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;

class Setting extends Controller
{
    public string $setting;

    /**
     * @return mixed
     */
    public function loadSettings(): array
    {
        return app($this->setting)->toArray();
    }


    /**
     * @param Request $request
     * @param string $view
     * @return Factory|View|Application
     */
    public function get(Request $request, string $view): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view($view, [
            "settings" => $this->loadSettings()
        ]);
    }


    /**
     * @param FormRequest $request
     * @param string $redirect
     * @param array|null $media
     * @return RedirectResponse
     */
    public function save(FormRequest $request, string $redirect, array|null $media= null): \Illuminate\Http\RedirectResponse
    {
        $media ??= [];
        $setting = new $this->setting();

        //Save Data
        foreach ($request->all() as $key => $value) {
            if($value !== null){
                $setting->{$key} = $value;
            }
        }

        //Save Media
        foreach ($media as $item) {
            if ($request->hasFile($item)) {
                $filePath = storage_path('public/settings/'. $item .  '.'.$request->file($item)->extension());
                $checkIfExist = File::exists($filePath);
                if($checkIfExist){
                    File::delete($filePath);
                }
                $request->file($item)->storeAs('public/settings', $item .  '.'.$request->file($item)->extension());
                $setting->{$item} = url('storage/settings/'.$item .'.'.$request->file($item)->extension());
            }
        }

        $setting->save();

        Toast::title(trans('tomato-settings::global.message.success'))->success()->autoDismiss(2);
        return redirect()->route($redirect);
    }

}
