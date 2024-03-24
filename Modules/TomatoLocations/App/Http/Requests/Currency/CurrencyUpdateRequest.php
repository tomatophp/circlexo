<?php

namespace Modules\TomatoLocations\App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyUpdateRequest extends FormRequest
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
                        'arabic' => 'nullable|max:255|string',
            'name' => 'sometimes|max:255|string',
            'iso' => 'sometimes|max:255|string'
        ];
    }
}
