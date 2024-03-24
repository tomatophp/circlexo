<?php

namespace Modules\TomatoNotifications\App\Http\Requests\Settings;
use Illuminate\Foundation\Http\FormRequest;

class NotificationsSettingsRequest extends FormRequest
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
            "notifications_allow" => "required|bool",
            "fcm_apiKey" => "required|string",
            "fcm_authDomain" => "required|string",
            "fcm_projectId" => "required|string",
            "fcm_storageBucket" => "required|string",
            "fcm_messagingSenderId" => "required|string",
            "fcm_appId" => "required|string",
            "fcm_measurementId" => "required|string"
        ];
    }
}
