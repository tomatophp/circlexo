<?php

namespace Modules\CircleContacts\App\Http\Requests\CircleXoContact;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoContactStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return has_app('circle-contacts');
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
            'name' => 'required|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'phone' => 'required|max:255|string|min:12',
            'address' => 'nullable',
            'company' => 'nullable|max:255|string'
        ];
    }
}
