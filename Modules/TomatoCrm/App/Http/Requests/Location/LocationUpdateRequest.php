<?php

namespace Modules\TomatoCrm\App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class LocationUpdateRequest extends FormRequest
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
                        'account_id' => 'sometimes|exists:accounts,id',
            'street' => 'sometimes|max:255|string',
            'area' => 'nullable|max:255|string',
            'city' => 'nullable|max:255|string',
            'country' => 'nullable|max:255|string',
            'home_number' => 'nullable',
            'flat_number' => 'nullable',
            'floor_number' => 'nullable',
            'mark' => 'nullable|max:255|string',
            'map_url' => 'nullable|max:65535',
            'note' => 'nullable|max:255|string',
            'lat' => 'nullable|max:255|string',
            'lng' => 'nullable|max:255|string'
        ];
    }
}
