<?php

namespace Modules\TomatoCrm\App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
                        'type_id' => 'sometimes|exists:types,id',
            'status_id' => 'sometimes|exists:status,id',
            'name' => 'sometimes|max:255|string',
            'email' => 'nullable|max:255|string|email',
            'phone' => 'nullable|max:255|min:12',
            'subject' => 'sometimes|max:255|string',
            'message' => 'sometimes|max:65535',
            'active' => 'nullable'
        ];
    }
}
