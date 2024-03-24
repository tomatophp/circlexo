<?php

namespace Modules\TomatoNotifications\App\Http\Requests\UserHasNotification;

use Illuminate\Foundation\Http\FormRequest;

class UserHasNotificationUpdateRequest extends FormRequest
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
                        'model_type' => 'sometimes|max:255|string',
            'model_id' => 'sometimes',
            'provider' => 'nullable|max:255|string'
        ];
    }
}
