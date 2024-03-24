<?php

namespace Modules\TomatoTranslations\App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\TomatoTranslations\App\Models\Translation;

class SaveScan
{
    private $paths;

    public function __construct()
    {
        $this->paths = config('tomato-translations.paths');
    }

    public function save()
    {
        $scanner = app(Scan::class);
        collect($this->paths)->each(function ($path) use ($scanner) {
            $scanner->addScannedPath($path);
        });

        list($trans, $__) = $scanner->getAllViewFilesWithTranslations();

        /** @var Collection $__ */

        $collectKeys = collect([]);
        $__->each(function ($default) use ($collectKeys) {
            if(((!str_contains($default, '{{')) && (!str_contains($default, '}}')) && (!str_contains($default, '::'))  && (!str_contains($default, '.$')))){
                $collectKeys->put($default, $default);
            }
        });

        $jsonFolder = File::files(lang_path());
        $moduleDirectory = File::directories(base_path('Modules'));
        $moduleLangPath = [];
        foreach ($moduleDirectory as $module){
            $langOnBaseDire = File::exists($module.'/lang');
            if(!$langOnBaseDire){
                $jsonFileExists = File::exists($module.'/resources/lang');
                if($jsonFileExists){
                    $moduleLangPath[] = $module.'/resources/lang';
                }
            }
            else {
                $moduleLangPath[] = $module.'/lang';
            }
        }
        foreach ($moduleLangPath as $langPath){
            $checkIfThisPathHasJson = File::files($langPath);
            foreach ($checkIfThisPathHasJson as $jsonLangFile){
                if(Str::contains($jsonLangFile, '.json')){
                    $jsonFolder[] = $jsonLangFile;
                }
            }
        }
        $collectiveJsonArray = [];
        foreach($jsonFolder as $getLangName){
            $currentLang = Str::remove('.json', $getLangName->getFilename());
            if(!isset($collectiveJsonArray[$currentLang])){
                $collectiveJsonArray[$currentLang] = [];
            }
            $fileContent = json_decode(File::get($getLangName->getRealPath()));
            $jsonCollection = collect($fileContent);
            $collectiveJsonArray[$currentLang] = array_merge($collectiveJsonArray[$currentLang], $jsonCollection->toArray());
        }

        foreach ($collectiveJsonArray as $lang=>$value){
            foreach ($collectKeys as $key=>$langItem){
                if(!isset($collectiveJsonArray[$lang][$key])){
                    $collectiveJsonArray[$lang][$key] = $key;
                }
            }

            File::put(lang_path($lang.'.json'), json_encode($collectiveJsonArray[$lang], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        }
    }

    public function getKeys(): array
    {
        $langCollection = collect([]);
        $jsonFolder = File::files(lang_path());
        $counter = 1;
        $langNames = [];
        foreach($jsonFolder as $getLangName){
            $langNames[] = str_replace('.json', '', $getLangName->getFilename());
        }
        foreach($jsonFolder as $getLang){
            $fetchLang = json_decode(File::get(lang_path($getLang->getFilename())));
            $lang = str_replace('.json', '', $getLang->getFilename());
            foreach($fetchLang as $index=>$langItem){
                if((!$langCollection->where('id', $counter)->first())){
                    $catchByKey = $langCollection->where('key', $index)->first();
                    if($catchByKey){
                        $catchByKey->put($lang, $langItem);
                    }
                    else {
                        $initCollection = collect([]);
                        $initCollection->put("id", $counter);
                        $initCollection->put("key", $index);
                        foreach($langNames as $item){
                            $initCollection->put($item, $langItem);
                        }
                        $langCollection->push($initCollection);
                    }

                    $counter++;
                }
            }
        }

        return $langCollection->toArray();
    }
}
