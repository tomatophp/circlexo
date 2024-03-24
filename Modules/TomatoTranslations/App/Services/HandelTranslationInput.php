<?php

namespace Modules\TomatoTranslations\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait HandelTranslationInput
{
    public function translate(Request &$request): Request
    {
        $getRequestToArray = $request->toArray();
        $arrayValues = [];
        foreach ($getRequestToArray as $key=>$item){
            if(Str::contains($key, '_tomato_translations_')){
                $filterName = explode('-', str_replace('_tomato_translations_', '-', $key));
                $arrayValues[$filterName[0]] = [];
            }
        }

        foreach ($getRequestToArray as $key=>$item){
            if(Str::contains($key, '_tomato_translations_')){
                $filterName = explode('-', str_replace('_tomato_translations_', '-', $key));
                $arrayValues[$filterName[0]][$filterName[1]] = $item;
            }
        }

        foreach ($arrayValues as $index=>$value){
            $request->merge([
                $index => $value
            ]);
        }

        return $request;
    }

    public function loadTranslation(Model &$model, array $fileds): Model
    {
        foreach ($fileds as $filed){
            $model->{$filed.'_tomato_translations_ar'} = $model->getTranslation($filed, 'ar');
            $model->{$filed.'_tomato_translations_en'} = $model->getTranslation($filed, 'en');
        }

        return $model;
    }
}
