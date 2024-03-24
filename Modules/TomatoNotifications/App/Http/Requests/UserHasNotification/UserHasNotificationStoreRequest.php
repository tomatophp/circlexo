<?php

namespace Modules\TomatoNotifications\App\Http\Requests\UserHasNotification;

use Illuminate\Foundation\Http\FormRequest;

class UserHasNotificationStoreRequest extends FormRequest
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
                        'model_type' => 'required|max:255|string',
            'model_id' => 'required',
            'provider' => 'nullable|max:255|string'
        ];
    }
}
