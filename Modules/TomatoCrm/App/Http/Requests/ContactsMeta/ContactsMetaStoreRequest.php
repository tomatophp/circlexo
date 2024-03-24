<?php

namespace Modules\TomatoCrm\App\Http\Requests\ContactsMeta;

use Illuminate\Foundation\Http\FormRequest;

class ContactsMetaStoreRequest extends FormRequest
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
                        'contact_id' => 'required|exists:contacts,id',
            'model_id' => 'nullable',
            'model_type' => 'nullable|max:255|string',
            'key' => 'required|max:255|string',
            'value' => 'nullable'
        ];
    }
}
