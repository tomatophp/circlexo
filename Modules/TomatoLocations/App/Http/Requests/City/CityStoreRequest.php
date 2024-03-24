<?php

namespace Modules\TomatoLocations\App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
                        'name' => 'required|max:255|string',
            'price' => 'nullable',
            'shipping' => 'nullable',
            'country_id' => 'required',
            'lat' => 'nullable|max:255|string',
            'lang' => 'nullable|max:255|string'
        ];
    }
}
