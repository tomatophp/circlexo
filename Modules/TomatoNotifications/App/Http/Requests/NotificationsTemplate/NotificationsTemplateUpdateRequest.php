<?php

namespace Modules\TomatoNotifications\App\Http\Requests\NotificationsTemplate;

use Illuminate\Foundation\Http\FormRequest;

class NotificationsTemplateUpdateRequest extends FormRequest
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
            'key' => 'sometimes|max:255|string',
            'body' => 'sometimes|array',
            'title' => 'nullable|array',
            'url' => 'nullable|max:255|string',
            'icon' => 'nullable|max:255',
            'type' => 'nullable|max:255|string',
            'providers' => 'nullable|array',
            'action' => 'nullable|max:255|string'
        ];
    }
}
