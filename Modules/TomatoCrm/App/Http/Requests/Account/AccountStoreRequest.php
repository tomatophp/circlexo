<?php

namespace Modules\TomatoCrm\App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
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
        return array_merge([
            'type' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'phone' => 'required|max:255|string|unique:accounts,phone',
            'email' => 'required|max:255|string|email|unique:accounts,email',
            'loginBy' => 'required|max:255|string',
            'address' => 'nullable|max:65535',
            'password' => 'nullable|max:255|confirmed|min:6',
            'is_login' => 'nullable|boolean',
            'is_active' => 'nullable|boolean'
        ], \Modules\TomatoCrm\App\Facades\TomatoCrm::getValidationCreate());
    }
}
