<?php

namespace Modules\TomatoSettings\App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ServicesSettingsRequest extends FormRequest
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
            "sms_vendors" => "nullable|array",
            "sms_gate" => "nullable|string|max:255",
            "sms_active" => "required|bool",
            "shipping_active" => "nullable|bool",
            "shipping_vendors" => "nullable|array",
            "shipping_gate" => "nullable|string|max:255",
            "facebook_pixcel" => "nullable|string|max:255",
            "facebook_chat" => "nullable|string|max:255",
            "facebook_app" => "nullable|string|max:255",
            "addthis_key" => "nullable|string|max:255",
        ];
    }
}
