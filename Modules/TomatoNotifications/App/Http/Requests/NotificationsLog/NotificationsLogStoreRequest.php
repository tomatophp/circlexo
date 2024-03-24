<?php

namespace Modules\TomatoNotifications\App\Http\Requests\NotificationsLog;

use Illuminate\Foundation\Http\FormRequest;

class NotificationsLogStoreRequest extends FormRequest
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
                        'model_type' => 'nullable|max:255|string',
            'model_id' => 'nullable',
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:255|string',
            'type' => 'required|max:255|string',
            'provider' => 'required|max:255|string'
        ];
    }
}
