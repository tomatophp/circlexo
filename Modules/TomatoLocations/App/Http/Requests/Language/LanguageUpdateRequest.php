<?php

namespace Modules\TomatoLocations\App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageUpdateRequest extends FormRequest
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
                        'iso' => 'sometimes|max:255|string',
            'name' => 'sometimes|max:255|string',
            'arabic' => 'nullable|max:255|string'
        ];
    }
}
