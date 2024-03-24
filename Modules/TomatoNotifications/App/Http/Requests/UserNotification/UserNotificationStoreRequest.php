<?php

namespace Modules\TomatoNotifications\App\Http\Requests\UserNotification;

use Illuminate\Foundation\Http\FormRequest;

class UserNotificationStoreRequest extends FormRequest
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
            'template_id' => 'required|max:255|string',
            'model_type' => 'required|max:255|string',
            'model_id' => 'nullable',
            'privacy' => 'required|max:255|string'
        ];
    }
}
