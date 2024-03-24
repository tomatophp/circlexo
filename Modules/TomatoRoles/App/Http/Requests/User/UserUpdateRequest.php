<?php

namespace Modules\TomatoRoles\App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'sometimes|max:255|string|email|unique:users,email,' . $this->route()->parameters()['model']->id,
            'password' => 'nullable|max:255|confirmed|min:6',
            'roles' => 'nullable|array'
        ];
    }
}
