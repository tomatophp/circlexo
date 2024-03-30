<?php

namespace Modules\CircleContacts\App\Http\Requests\CircleXoContact;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CircleContacts\App\Models\CircleXoContact;

class CircleXoContactUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return has_app('circle-contacts', $this->model['account_id']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'email' => 'nullable|max:255|string|email',
            'phone' => 'sometimes|max:255|string',
            'address' => 'nullable',
            'company' => 'nullable|max:255|string'
        ];
    }
}
