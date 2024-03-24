<?php

namespace Modules\TomatoSettings\App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class GoogleSettingsRequest extends FormRequest
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
            "google_api_key" => "nullable|string|max:255",
            "google_firebase_cr" => "nullable|max:255",
            "google_firebase_database_url" => "nullable|string|max:255",
            "google_firebase_vapid" => "nullable|string|max:255",
            "google_recaptcha_key" => "nullable|string|max:255",
            "google_recaptcha_secret" => "nullable|string|max:255",
        ];
    }
}
