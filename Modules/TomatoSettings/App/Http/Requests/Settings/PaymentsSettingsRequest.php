<?php

namespace Modules\TomatoSettings\App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsSettingsRequest extends FormRequest
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
            "payment_gate" => "required|string|max:255",
            "payment_online" => "required|boolean",
            "payment_vendors" => "required|array|max:10",
        ];
    }
}
