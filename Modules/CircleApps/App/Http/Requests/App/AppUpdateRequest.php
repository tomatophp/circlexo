<?php

namespace Modules\CircleApps\App\Http\Requests\App;

use Illuminate\Foundation\Http\FormRequest;

class AppUpdateRequest extends FormRequest
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
             'account_id' => 'nullable|exists:accounts,id',
            'name' => 'sometimes|max:255|string',
            'description' => 'nullable|max:255|string',
            'key' => 'sometimes|string',
            'readme' => 'nullable',
            'homepage' => 'nullable|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'docs' => 'nullable|max:255|string',
            'github' => 'nullable|max:255|string',
            'privacy' => 'nullable|max:255|string',
            'faq' => 'nullable|max:255|string',
            'status' => 'nullable|max:255|string',
            'is_active' => 'nullable',
            'price' => 'nullable',
            'price_per' => 'nullable|max:255|string',
            'discount' => 'nullable',
            'discount_to' => 'nullable',
            'is_free' => 'nullable'
        ];
    }
}
