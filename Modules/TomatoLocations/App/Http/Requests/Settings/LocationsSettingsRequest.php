<?php

namespace Modules\TomatoLocations\App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class LocationsSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "local_country" => "nullable|string|max:255",
            "local_phone" => "nullable|string|max:255",
            "local_lang" => "nullable|string|max:255",
            "local_currency" => "nullable|string|max:255",
            "local_lat" => "nullable|string|max:255",
            "local_lng" => "nullable|string|max:255",
        ];
    }
}
