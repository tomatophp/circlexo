<?php

namespace Modules\TomatoCategory\App\Services\Contracts;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoCategory\App\Models\Type;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

trait LoadControllerFunctions
{
    public function index(string $for,string $type,string $label, string $back){
        return view('tomato-category::builder.index', [
            "for" => $for,
            "type" => $type,
            "label" => $label,
            "back" => $back,
        ]);
    }

    public function create(string $for,string $type,string $label){
        return view('tomato-category::builder.form', [
            "for" => $for,
            "type" => $type,
            "label" => $label,
        ]);
    }

    public function store(Request $request,string $for,string $type,string $label){
        $getItemIfExists = Type::where('key', $request->get('key'))->first();
        if($getItemIfExists){
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key,".$getItemIfExists->id,
            ]);

            $getItemIfExists->update([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }
        else {
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key",
            ]);

            Type::create([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'for' => $for,
                'type' => $type,
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }

        Toast::success($label . ' '. __('has been updated successfully'))->autoDismiss(2);
        return back();
    }

    public function edit(Type $item, string $for,string $type,string $label){
        return view('tomato-category::builder.form', [
            "item" => $item,
            "for" => $for,
            "type" => $type,
            "label" => $label,
        ]);
    }

    public function destroy(Type $item,string $label){
        $item->delete();

        Toast::success($label . ' ' . __('deleted successfully'))->autoDismiss(2);
        return back();
    }
}
