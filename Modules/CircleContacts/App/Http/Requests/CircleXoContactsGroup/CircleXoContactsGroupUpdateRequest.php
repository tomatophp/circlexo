<?php

namespace Modules\CircleContacts\App\Http\Requests\CircleXoContactsGroup;

use Illuminate\Foundation\Http\FormRequest;

class CircleXoContactsGroupUpdateRequest extends FormRequest
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
                        'name' => 'sometimes|max:255|string',
            'description' => 'sometimes',
            'icon' => 'nullable|max:255|string',
            'color' => 'nullable|max:255|string'
        ];
    }
}
