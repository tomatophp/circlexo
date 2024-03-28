<?php

namespace Modules\TomatoThemes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoSettings\App\Settings\ThemesSettings;
use Modules\TomatoThemes\App\Generator\GenerateTheme;
use ZipArchive;

/**
 *
 */
class ThemesController extends Controller
{
    /**
     * @var ThemesSettings
     */
    private ThemesSettings $setting;

    /**
     *
     */
    public function __construct()
    {
        $this->setting = new ThemesSettings();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $getThemes = [];
        if(File::exists(base_path('Modules'))){
            $getThemes = collect(File::directories(base_path('Modules')));
            $getThemes = $getThemes->filter(function ($item) {
                $json = json_decode(File::get($item . "/module.json"));
                if (isset($json->type) && $json->type === 'theme'){
                    return true;
                }
                else {
                    return false;
                }
            })->transform(callback: static fn($item) => array(
                "name" => Str::of($item)->remove(base_path('Modules').'/')->ucfirst()->title()->toString(),
                "path" => $item,
                "info" => json_decode(File::get($item . "/module.json"), false),
            ));

            if($request->has('search') && !empty($request->get('search'))){
                $getThemes = $getThemes->where('name','like', $request->get('search'));
            }
        }

        return view('tomato-themes::themes.index', [
            'themes' => $getThemes
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('tomato-themes::themes.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required|string|max:100",
            "description" => "nullable|string|max:255",
        ]);

        if(File::exists(base_path('Themes'))) {
            $themes = File::directories(base_path('Themes'));
            $exists = Module::find($request->get('name'));
            if($exists){
                Toast::danger(__('Sorry Your Theme Name Already Exists'))->autoDismiss(2);
                return back();
            }
        }

        $generator = new GenerateTheme(
            themeName: $request->get('name'),
            themeDescription: $request->get('description')
        );
        $generator->generate();

        Toast::success(__('Your Theme Created Successfully'))->autoDismiss(2);
        return redirect()->route('admin.themes.index');
    }

    /**
     * @param string $theme
     * @return Application|Factory|View|RedirectResponse
     */
    public function custom(string $theme): Application|Factory|View|RedirectResponse
    {
        if(File::exists(base_path('Modules') . "/" . $theme))
        {
            $getTheme = [];
            $getTheme['name'] = $theme;
            $getTheme['info'] = json_decode(File::get(base_path('Modules').'/'.$theme . "/module.json"), false);

            $default = [];
            foreach ($getTheme['info']->settings as $key=>$setting) {
                $default[$key] = $setting->value;
            }
            $getSetting = new \Modules\TomatoSettings\App\Settings\ThemesSettings();
            $default['theme_main_color'] = $getSetting->theme_main_color;
            $default['theme_secandry_color'] = $getSetting->theme_secandry_color;
            $default['theme_sub_color'] = $getSetting->theme_sub_color;
            $default['theme_footer'] = $getSetting->theme_footer;
            $default['theme_css'] = $getSetting->theme_css;
            $default['theme_js'] = $getSetting->theme_js;
            $default['theme_copyright'] = $getSetting->theme_copyright;


            return view('tomato-themes::custom', [
                "theme" => $getTheme,
                "default" => $default
            ]);
        }

        Toast::danger(__('Sorry Your Theme Not Found'))->autoDismiss(2);
        return back();
    }

    /**
     * @param Request $request
     * @param string $theme
     * @return RedirectResponse
     */
    public function customSave(Request $request, string $theme): RedirectResponse
    {
        if(File::exists(base_path('Modules') . "/" . $theme)) {
            $filePath = base_path('Modules') . '/' . $theme . "/module.json";
            $info = json_decode(File::get($filePath, false));

            $rules = [];
            foreach ($info->settings as $key=>$setting) {
                $rules[$key] = $setting->required ? 'required' : 'nullable';
            }
            $request->validate($rules);

            foreach ($info->settings as $key=>$setting) {
                $info->settings->{$key}->value = $request->get($key);
            }

            File::put($filePath,  json_encode($info, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));


            $this->setting->theme_main_color = $request->get('theme_main_color') ?? "";
            $this->setting->theme_secandry_color = $request->get('theme_secandry_color')?? "";
            $this->setting->theme_sub_color = $request->get('theme_sub_color')?? "";
            $this->setting->theme_header = $request->get('theme_header')?? "";
            $this->setting->theme_footer = $request->get('theme_footer')?? "";
            $this->setting->theme_css = $request->get('theme_css')?? "";
            $this->setting->theme_js = $request->get('theme_js')?? "";
            $this->setting->theme_copyright = $request->get('theme_copyright')?? "";
            $this->setting->save();

            Toast::success(__('Your Theme Settings Has Been Updated Success'))->autoDismiss(2);
            return back();

        }

        Toast::danger(__('Sorry Your Theme Not Found'))->autoDismiss(2);
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function active(Request $request): RedirectResponse
    {
        $request->validate([
           "theme" => "required|string",
           "name" => "required|string"
        ]);

        $theme = $request->get("name");


        $findOldTheme = Module::find($this->setting->theme_name);
        if($findOldTheme){
            $findOldTheme->disable();
        }

        if(Module::find($theme)){
            $this->setting->theme_name = $theme;
            $this->setting->theme_path = $request->get('theme');
            $this->setting->save();

            $themes = File::directories(base_path('Modules'));
            foreach($themes as $item){
                $filePath = $item . "/module.json";
                $info = json_decode(File::get($filePath));

                if($info->name === $request->get('name')){
                    $info->active = true;
                }
                else {
                    $info->active = false;
                }

                File::put($filePath,  json_encode($info, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
            }

            $assetsFile = File::exists(public_path('themes') . $theme);
            if(!$assetsFile){
                File::copyDirectory(base_path('Modules') . '/' . $theme . '/resources/assets', storage_path('app/public/themes') . '/' . $theme);
            }

            Module::find($theme)->enable();

            Toast::success(__('Your Theme Activated Success!'))->autoDismiss(2);
            return back();
        }

        Toast::danger(__('Sorry This Theme Not Found!'))->autoDismiss(2);
        return back();
    }

    /**
     * @return Application|Factory|View
     */
    public function upload(): Application|Factory|View
    {
        return view('tomato-themes::themes.upload');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function uploadNew(Request $request): RedirectResponse
    {
        $request->validate([
           "theme" => "required|file|mimes:zip"
        ]);

        $zip = new ZipArchive;
        $res = $zip->open($request->file('theme'));

        if ($res === TRUE) {
            $zip->extractTo(base_path('Modules'));
            if(File::exists(base_path('Modules/__MACOSX'))){
                File::deleteDirectory(base_path('Modules/__MACOSX'));
            }

            $zip->close();

            Toast::success(__('Your Theme Has Been Added Success'))->autoDismiss(2);
            return back();
        }

        Toast::danger(__('Sorry Your File Uploaded Is Not Correct'))->autoDismiss(2);
        return back();
    }


    /**
     * @param string $theme
     * @return RedirectResponse
     */
    public function destroy(string $theme): RedirectResponse
    {
        if(File::exists(base_path('Modules') .'/'. $theme)){
            File::deleteDirectory(base_path('Modules') .'/'.  $theme);
            File::deleteDirectory(storage_path('app/public/themes') .'/'.  $theme);

            Toast::success(__('Your Theme Has Been Deleted Success'));
            return back();
        }

        Toast::danger(__('Sorry Your Theme Not Found'))->autoDismiss(2);
        return back();
    }

    /**
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return \Illuminate\View\View
     */
    public function edit(\Modules\TomatoCms\App\Models\Page $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-themes::themes.builder-page',
        );
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoCms\App\Models\Page $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoCms\App\Models\Page $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                'color' => 'nullable|max:255',
                'title' => 'sometimes|array',
                'title*' => 'sometimes|string|max:255',
                'short_description' => 'nullable|array',
                'slug' => 'sometimes|max:255|string',
                'body' => 'nullable|array',
                'is_active' => 'nullable',
                'has_view' => 'nullable',
                'view' => 'nullable|max:255|string'
            ],
            message: __('Page updated successfully'),
            redirect: 'admin.pages.index',
            hasMedia: true,
            collection: [
                "cover" => false,
                "gallery" => true,
            ]
        );

        return redirect()->back();
    }
}
