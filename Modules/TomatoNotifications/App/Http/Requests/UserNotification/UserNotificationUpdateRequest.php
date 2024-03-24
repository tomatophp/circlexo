<?php

namespace Modules\TomatoNotifications\App\Http\Requests\UserNotification;

use Illuminate\Foundation\Http\FormRequest;

class UserNotificationUpdateRequest extends FormRequest
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
                        'created_by' => 'nullable',
            'model_type' => 'nullable|max:255|string',
            'model_id' => 'nullable',
            'title' => 'nullable|max:255|string',
            'url' => 'nullable|max:255|string',
            'icon' => 'nullable|max:255',
            'description' => 'nullable|max:255|string',
            'type' => 'sometimes|max:255|string',
            'privacy' => 'sometimes|max:255|string'
        ];
    }
}
