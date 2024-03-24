<?php

namespace Modules\TomatoCrm\App\Http\Requests\AccountsMeta;

use Illuminate\Foundation\Http\FormRequest;

class AccountsMetaUpdateRequest extends FormRequest
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
                        'account_id' => 'sometimes|exists:accounts,id',
            'model_id' => 'nullable',
            'model_type' => 'nullable|max:255|string',
            'key' => 'sometimes|max:255|string',
            'value' => 'nullable'
        ];
    }
}
