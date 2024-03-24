<?php

namespace Modules\TomatoCategory\App\Http\Requests\Type;

use Illuminate\Foundation\Http\FormRequest;

class TypeStoreRequest extends FormRequest
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
            'image' => 'nullable|file|image|max:1024',
            'name' => 'required|array|min:1',
            'name.*' => 'required|max:255|string',
            'description' => 'nullable|array',
            'description.*' => 'nullable|max:255|string',
            'key' => 'required|max:255|string',
            'color' => 'nullable|max:255|string',
            'icon' => 'nullable|max:255|string',
            'for' => 'required|max:255|string',
            'type' => 'required|max:255|string',
        ];
    }
}
