<?php

namespace Modules\TomatoSettings\App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingsRequest extends FormRequest
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
            "mail_mailer" => "required|string|max:255",
            "mail_host" => "required|string|max:255",
            "mail_port" => "required|string|max:255",
            "mail_username" => "nullable|string|max:255",
            "mail_password" => "nullable|string|max:255",
            "mail_encryption" => "nullable|string|max:255",
            "mail_from_address" => "required|string|max:255",
            "mail_from_name" => "required|string|max:255",
        ];
    }
}
