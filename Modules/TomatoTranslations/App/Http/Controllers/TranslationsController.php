<?php

namespace Modules\TomatoTranslations\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoTranslations\App\Exports\TranslationsExport;
use Modules\TomatoTranslations\App\Imports\TranslationsImport;
use Modules\TomatoTranslations\App\Models\Translation;
use Modules\TomatoTranslations\App\Services\SaveScan;
use Modules\TomatoTranslations\App\Tables\TranslationTable;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TranslationsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('tomato-translations::index', [
            "table"=> TranslationTable::class
        ]);
    }

    /**
     * @param Translation $model
     * @return Application|Factory|View
     */
    public function edit(Translation $model): Application|Factory|View
    {
        return view('tomato-translations::edit', compact('model'));
    }

    /**
     * @return Application|Factory|View
     */
    public function importView(): Application|Factory|View
    {
        return view('tomato-translations::import');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            "key" => "required|string"
        ]);

        $jsonFolder = File::files(lang_path());
        foreach($jsonFolder as $getLangName){
            $fileContent = json_decode(File::get(lang_path($getLangName->getFilename())));
            $fileContent->{$request->get('key')} = $request->get(str_replace('.json', '', $getLangName->getFilename()));
            File::put(lang_path($getLangName->getFilename()), json_encode($fileContent, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }

        Toast::title(trans('tomato-translations::global.message.update'))->success()->autoDismiss(2);
        return redirect()->route('admin.translations.index');
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function export(Request $request): BinaryFileResponse
    {
        $response = Excel::download(new TranslationsExport, 'translations.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        return $response;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            "excel" => "required",
        ]);

        Excel::import(new TranslationsImport, $request->file('excel'));

        Toast::title(trans('tomato-translations::global.message.import'))->success()->autoDismiss(2);
        return redirect()->route('admin.translations.index');
    }

    /**
     * @return RedirectResponse
     */
    public function auto(): RedirectResponse
    {
        $data = Translation::all();

        $getLocals = config('tomato-translations.locals');

        $translate = new TranslateClient([
            'key' => config('tomato-translations.google_key')
        ]);

        foreach ($data as $item) {
            $key = $item->key;
            $translation = Translation::where('key', $key)->first();

            try {
                if ($translation) {
                    foreach ($getLocals as $lang => $value) {
                        $trans = $translate->translate($key, [
                            'target' => $lang
                        ]);
                        if (is_array($trans)) {
                            $text = $trans['text'];
                        } else {
                            $text = $key;
                        }
                        $translation->{$lang} = $text;
                        $translation->save();
                    }
                }
            } catch (\Exception $e) {
                Toast::title(trans('tomato-translations::global.message.auto_error'))->danger()->autoDismiss(10);
                return redirect()->route('admin.translations.index');
            }
        }

        Toast::title(trans('tomato-translations::global.message.auto'))->success()->autoDismiss(2);
        return redirect()->route('admin.translations.index');

    }

    /**
     * @return RedirectResponse
     */
    public function scan(): RedirectResponse
    {
        $scan = new SaveScan();
        $scan->save();

        Toast::title(trans('tomato-translations::global.message.scan'))->success()->autoDismiss(2);
        return redirect()->route('admin.translations.index');

    }
}
